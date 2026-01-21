<?php
/**
 * Güvenlik Konfigürasyon Dosyası
 * 
 * Bu dosya production ortamında güvenlik ayarlarını yönetir.
 * .env dosyası ile birlikte kullanılması önerilir.
 */

// Environment variables yükleme (dotenv kullanıyorsanız)
// require_once 'vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// Güvenlik konfigürasyonu
class SecurityConfig
{

    // API Anahtarları (production'da environment variable'dan alınmalı)
    public static function getApiKeys()
    {
        $envKeys = getenv('SECURITY_API_KEYS');
        if ($envKeys) {
            return explode(',', $envKeys);
        }

        // Demo anahtarları (sadece localhost'ta)
        if (self::isLocalhost()) {
            return [
                'demo_key_12345',
                'test_api_key_67890'
            ];
        }

        return [];
    }

    // İzin verilen origin'ler
    public static function getAllowedOrigins()
    {
        $envOrigins = getenv('SECURITY_ALLOWED_ORIGINS');
        if ($envOrigins) {
            return explode(',', $envOrigins);
        }

        return [
            'http://localhost:8000',
            'http://localhost:3000',
            'https://guvenliktarama.com',
            'https://www.guvenliktarama.com'
        ];
    }

    // Rate limiting ayarları
    public static function getRateLimitConfig()
    {
        return [
            'requests_per_minute' => (int) (getenv('SECURITY_RATE_LIMIT') ?: 20),
            'window_seconds' => 60,
            'max_ports_to_scan' => (int) (getenv('SECURITY_MAX_PORTS') ?: 10)
        ];
    }

    // Güvenlik ayarları
    public static function getSecuritySettings()
    {
        return [
            'enable_api_key_validation' => !self::isLocalhost(),
            'block_private_ips' => !self::isLocalhost(),
            'max_target_length' => 253,
            'timeout_seconds' => 10,
            'enable_logging' => (bool) (getenv('SECURITY_ENABLE_LOGGING') ?: false)
        ];
    }

    // Log dosyası yolu
    public static function getLogPath()
    {
        return getenv('SECURITY_LOG_PATH') ?: sys_get_temp_dir() . '/security_api.log';
    }

    // Localhost kontrolü
    private static function isLocalhost()
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        return in_array($host, ['localhost:8000', 'localhost:3000', '127.0.0.1:8000', '127.0.0.1:3000']);
    }

    // Production kontrolü
    public static function isProduction()
    {
        return !self::isLocalhost() && !self::isDevelopment();
    }

    // Development kontrolü
    public static function isDevelopment()
    {
        $env = getenv('APP_ENV') ?: 'production';
        return $env === 'development' || $env === 'dev';
    }

    // Güvenlik log'u
    public static function logSecurityEvent($event, $data = [])
    {
        if (!self::getSecuritySettings()['enable_logging']) {
            return;
        }

        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        if (self::isProduction()) {
            $ip = self::anonymizeIp($ip);
        }

        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'ip' => $ip,
            'event' => $event,
            'data' => $data
        ];

        $logPath = self::getLogPath();
        $logDir = dirname($logPath);

        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        file_put_contents($logPath, json_encode($logEntry) . "\n", FILE_APPEND | LOCK_EX);
    }

    // Güvenlik headers
    public static function setSecurityHeaders()
    {
        // Temel güvenlik headers
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');

        // CORS Handling
        $allowedOrigins = self::getAllowedOrigins();
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if (in_array($origin, $allowedOrigins)) {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Vary: Origin');
        }
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Production'da ek güvenlik headers
        if (self::isProduction()) {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
            // Strict CSP: removed unsafe-eval, added connect-src
            header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://unpkg.com https://www.googletagmanager.com; style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; connect-src 'self' https://www.google-analytics.com; img-src 'self' data: https:; font-src 'self' data:;");
            header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        }
    }

    // Input sanitization
    public static function sanitizeInput($input, $type = 'string')
    {
        switch ($type) {
            case 'domain':
                return filter_var(trim($input), FILTER_SANITIZE_STRING);
            case 'ip':
                return filter_var(trim($input), FILTER_VALIDATE_IP) ? trim($input) : false;
            case 'port':
                $port = (int) $input;
                return ($port >= 1 && $port <= 65535) ? $port : false;
            case 'array':
                if (!is_array($input)) {
                    return [];
                }
                return array_map('trim', $input);
            default:
                return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        }
    }

    // Güvenlik kontrolü
    public static function validateSecurity($target, $port = null, $checks = [])
    {
        $errors = [];

        // Target validasyonu ve SSRF koruması
        if (empty($target)) {
            $errors[] = 'Target parameter is required';
        } elseif (strlen($target) > self::getSecuritySettings()['max_target_length']) {
            $errors[] = 'Target is too long';
        } else {
            $validation = self::resolveAndValidate($target);
            if (!$validation['valid']) {
                $errors[] = $validation['error'];
            }
        }

        // Port validasyonu
        if ($port !== null) {
            $sanitizedPort = self::sanitizeInput($port, 'port');
            if ($sanitizedPort === false) {
                $errors[] = 'Invalid port number';
            }
        }

        // Checks validasyonu
        if (!empty($checks)) {
            $validChecks = ['dns', 'ssl', 'headers', 'ports', 'email', 'blacklist'];
            $invalidChecks = array_diff($checks, $validChecks);
            if (!empty($invalidChecks)) {
                $errors[] = 'Invalid check types: ' . implode(', ', $invalidChecks);
            }
        }

        return $errors;
    }

    /**
     * Target'ı çözümler ve SSRF kontrollerinden geçirir.
     * 
     * @param string $target
     * @return array ['valid' => bool, 'error' => string|null, 'ips' => array]
     */
    public static function resolveAndValidate($target)
    {
        $domain = self::extractDomainFromUrl($target);

        // 1. Karakter bazlı güvenlik kontrolü
        $dangerousChars = ['<', '>', '"', "'", '&', ';', '|', '`', '$', '(', ')', '{', '}', '[', ']'];
        foreach ($dangerousChars as $char) {
            if (strpos($domain, $char) !== false) {
                return ['valid' => false, 'error' => 'Invalid characters in target', 'ips' => []];
            }
        }

        // 2. IP veya Domain ayrımı ve çözümleme
        $ips = [];
        if (filter_var($domain, FILTER_VALIDATE_IP)) {
            $ips[] = $domain;
        } else {
            // Domain formatı kontrolü
            if (!filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
                return ['valid' => false, 'error' => 'Invalid domain format', 'ips' => []];
            }

            // DNS çözümleme (A ve AAAA kayıtları)
            $aRecords = @dns_get_record($domain, DNS_A);
            $aaaaRecords = @dns_get_record($domain, DNS_AAAA);

            if (empty($aRecords) && empty($aaaaRecords)) {
                // Alternatif olarak gethostbynamel dene
                $resolvedIps = @gethostbynamel($domain);
                if ($resolvedIps) {
                    $ips = $resolvedIps;
                }
            } else {
                if ($aRecords)
                    foreach ($aRecords as $r)
                        $ips[] = $r['ip'];
                if ($aaaaRecords)
                    foreach ($aaaaRecords as $r)
                        $ips[] = $r['ipv6'];
            }
        }

        if (empty($ips)) {
            return ['valid' => false, 'error' => 'Could not resolve target', 'ips' => []];
        }

        // 3. Her bir IP için SSRF kontrolü
        foreach ($ips as $ip) {
            if (!self::isValidIp($ip)) {
                return ['valid' => false, 'error' => 'Access to internal/private network is blocked', 'ips' => $ips];
            }
        }

        return ['valid' => true, 'error' => null, 'ips' => $ips];
    }

    /**
     * IP adresinin halka açık (public) olup olmadığını kontrol eder.
     */
    private static function isValidIp($ip)
    {
        // FILTER_FLAG_NO_PRIV_RANGE: RFC1918 (10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16)
        // FILTER_FLAG_NO_RES_RANGE: Reserved IPs and Loopback
        $flags = FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;

        if (!filter_var($ip, FILTER_VALIDATE_IP, $flags)) {
            return false;
        }

        // Ek manuel kontroller (bazı PHP versiyonlarında eksik olabilir)
        $privateRanges = [
            '10.0.0.0/8',
            '172.16.0.0/12',
            '192.168.0.0/16',
            '127.0.0.0/8',
            '169.254.0.0/16',  // Link-local
            '100.64.0.0/10',   // CGNAT
            '0.0.0.0/8',       // Current network
            '::1/128',         // IPv6 Loopback
            'fc00::/7',        // IPv6 ULA
            'fe80::/10',       // IPv6 Link-local
        ];

        foreach ($privateRanges as $range) {
            if (self::ipInRange($ip, $range)) {
                return false;
            }
        }

        return true;
    }

    /**
     * IP'nin CIDR bloğunda olup olmadığını kontrol eder.
     */
    private static function ipInRange($ip, $range)
    {
        $isIpv6 = (strpos($ip, ':') !== false);
        $rangeIsIpv6 = (strpos($range, ':') !== false);

        if ($isIpv6) {
            if (!$rangeIsIpv6)
                return false;
            list($subnet, $bits) = explode('/', $range);
            // IPv6 CIDR kontrolü için basit prefix check
            return (strpos(strtolower($ip), strtolower(rtrim($subnet, ':'))) === 0);
        }

        if ($rangeIsIpv6)
            return false;

        if (strpos($range, '/') === false) {
            $range .= '/32';
        }

        list($subnet, $bits) = explode('/', $range);
        $ip_long = ip2long($ip);
        $subnet_long = ip2long($subnet);

        if ($ip_long === false || $subnet_long === false)
            return false;

        if ($bits == 0)
            return true;

        $mask = ~((1 << (32 - $bits)) - 1);
        return ($ip_long & $mask) == ($subnet_long & $mask);
    }

    // Target validasyonu
    private static function isValidTarget($target)
    {
        $validation = self::resolveAndValidate($target);
        return $validation['valid'];
    }

    // URL'den domain çıkarma fonksiyonu
    private static function extractDomainFromUrl($url)
    {
        // URL'den domain kısmını çıkar
        $url = trim($url);

        // Eğer http:// veya https:// ile başlıyorsa
        if (preg_match('/^https?:\/\//', $url)) {
            $parsedUrl = parse_url($url);
            if (isset($parsedUrl['host'])) {
                return $parsedUrl['host'];
            }
        }

        // Eğer www. ile başlıyorsa
        if (strpos($url, 'www.') === 0) {
            return substr($url, 4);
        }

        // Eğer sadece domain ise
        return $url;
    }

    /**
     * Anonymize IP address (GDPR compliance)
     * IPv4: 192.168.1.100 -> 192.168.1.0
     * IPv6: 2001:db8:85a3:0:0:8a2e:370:7334 -> 2001:db8:85a3::
     */
    private static function anonymizeIp($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP))
            return 'unknown';
        if (strpos($ip, ':') !== false) {
            $parts = explode(':', $ip);
            return implode(':', array_slice($parts, 0, 3)) . '::';
        }
        return preg_replace('/[0-9]+$/', '0', $ip);
    }
}

// Güvenlik headers'ı otomatik olarak ayarla
SecurityConfig::setSecurityHeaders();
?>