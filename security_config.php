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
class SecurityConfig {
    
    // API Anahtarları (production'da environment variable'dan alınmalı)
    public static function getApiKeys() {
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
    public static function getAllowedOrigins() {
        $envOrigins = getenv('SECURITY_ALLOWED_ORIGINS');
        if ($envOrigins) {
            return explode(',', $envOrigins);
        }
        
        return [
            'http://localhost:8000',
            'http://localhost:3000',
            'https://yourdomain.com', // Production domain'inizi buraya ekleyin
            'https://www.yourdomain.com'
        ];
    }
    
    // Rate limiting ayarları
    public static function getRateLimitConfig() {
        return [
            'requests_per_minute' => (int)(getenv('SECURITY_RATE_LIMIT') ?: 20),
            'window_seconds' => 60,
            'max_ports_to_scan' => (int)(getenv('SECURITY_MAX_PORTS') ?: 10)
        ];
    }
    
    // Güvenlik ayarları
    public static function getSecuritySettings() {
        return [
            'enable_api_key_validation' => !self::isLocalhost(),
            'block_private_ips' => !self::isLocalhost(),
            'max_target_length' => 253,
            'timeout_seconds' => 10,
            'enable_logging' => (bool)(getenv('SECURITY_ENABLE_LOGGING') ?: false)
        ];
    }
    
    // Log dosyası yolu
    public static function getLogPath() {
        return getenv('SECURITY_LOG_PATH') ?: sys_get_temp_dir() . '/security_api.log';
    }
    
    // Localhost kontrolü
    private static function isLocalhost() {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        return in_array($host, ['localhost:8000', 'localhost:3000', '127.0.0.1:8000', '127.0.0.1:3000']);
    }
    
    // Production kontrolü
    public static function isProduction() {
        return !self::isLocalhost() && !self::isDevelopment();
    }
    
    // Development kontrolü
    public static function isDevelopment() {
        $env = getenv('APP_ENV') ?: 'production';
        return $env === 'development' || $env === 'dev';
    }
    
    // Güvenlik log'u
    public static function logSecurityEvent($event, $data = []) {
        if (!self::getSecuritySettings()['enable_logging']) {
            return;
        }
        
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
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
    public static function setSecurityHeaders() {
        // Temel güvenlik headers
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        // Production'da ek güvenlik headers
        if (self::isProduction()) {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
            header('Content-Security-Policy: default-src \'self\'; script-src \'self\' \'unsafe-inline\' https://cdn.tailwindcss.com https://unpkg.com; style-src \'self\' \'unsafe-inline\' https://cdn.tailwindcss.com;');
            header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        }
    }
    
    // Input sanitization
    public static function sanitizeInput($input, $type = 'string') {
        switch ($type) {
            case 'domain':
                return filter_var(trim($input), FILTER_SANITIZE_STRING);
            case 'ip':
                return filter_var(trim($input), FILTER_VALIDATE_IP) ? trim($input) : false;
            case 'port':
                $port = (int)$input;
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
    public static function validateSecurity($target, $port = null, $checks = []) {
        $errors = [];
        
        // Target validasyonu
        if (empty($target)) {
            $errors[] = 'Target parameter is required';
        } elseif (strlen($target) > self::getSecuritySettings()['max_target_length']) {
            $errors[] = 'Target is too long';
        } elseif (!self::isValidTarget($target)) {
            $errors[] = 'Invalid target format';
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
            $validChecks = ['dns', 'ssl', 'headers', 'ports', 'whois', 'blacklist'];
            $invalidChecks = array_diff($checks, $validChecks);
            if (!empty($invalidChecks)) {
                $errors[] = 'Invalid check types: ' . implode(', ', $invalidChecks);
            }
        }
        
        return $errors;
    }
    
    // Target validasyonu
    private static function isValidTarget($target) {
        // Tehlikeli karakterler
        $dangerousChars = ['<', '>', '"', "'", '&', ';', '|', '`', '$', '(', ')', '{', '}', '[', ']'];
        foreach ($dangerousChars as $char) {
            if (strpos($target, $char) !== false) {
                return false;
            }
        }
        
        // Domain/IP validasyonu
        if (filter_var($target, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            $parts = explode('.', $target);
            foreach ($parts as $part) {
                if (strlen($part) > 63 || !preg_match('/^[a-zA-Z0-9\-]+$/', $part)) {
                    return false;
                }
            }
            return true;
        } elseif (filter_var($target, FILTER_VALIDATE_IP)) {
            return true;
        }
        
        return false;
    }
}

// Güvenlik headers'ı otomatik olarak ayarla
SecurityConfig::setSecurityHeaders();
?> 