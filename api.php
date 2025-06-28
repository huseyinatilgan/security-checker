<?php
/**
 * Güvenlik Kontrol API
 *
 * Sadece GET isteklerini kabul eder. Çıktı formatı ?o=json veya ?o=text ile seçilebilir.
 * Parametreler: target (zorunlu), port (opsiyonel), checks[] (opsiyonel), o (opsiyonel: json/text)
 * Rate limit, API anahtarı, CORS ve güvenlik kontrolleri içerir.
 *
 * Örnek:
 *   JSON: https://guvenliktarama.com/api.php?target=google.com&o=json
 *   TEXT: https://guvenliktarama.com/api.php?target=google.com&o=text
 */

// --- CORS ve Güvenlik Headerları ---
$allowedOrigins = [
    'http://localhost:8000',
    'http://localhost:3000',
    'https://guvenliktarama.com',
    'https://www.guvenliktarama.com'
];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
} else {
    header('Access-Control-Allow-Origin: null');
}
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Max-Age: 86400');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// --- Hata Mesajı Fonksiyonu ---
function apiError($message, $code = 400, $outputType = 'json', $extra = []) {
    http_response_code($code);
    if ($outputType === 'text') {
        header('Content-Type: text/plain; charset=utf-8');
        echo "Hata: $message";
    } else {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array_merge([
            'error' => true,
            'message' => $message
        ], $extra), JSON_UNESCAPED_UNICODE);
    }
    exit();
}

// --- Sadece GET Desteği ---
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $outputType = strtolower($_GET['o'] ?? 'json');
    apiError('Sadece GET istekleri kabul edilir', 405, $outputType);
}

// --- Parametreleri Al ---
$input = $_GET;
$target = $input['target'] ?? '';
$port = $input['port'] ?? null;
$checks = $input['checks'] ?? [];
$outputType = strtolower($input['o'] ?? 'json'); // o=json veya o=text

// --- Rate Limiting ---
function checkRateLimit($ip) {
    $cacheDir = sys_get_temp_dir() . '/security_api_rate_limit/';
    if (!is_dir($cacheDir)) mkdir($cacheDir, 0755, true);
    $cacheFile = $cacheDir . md5($ip) . '.json';
    $currentTime = time();
    $limit = 20; $window = 60;
    if (file_exists($cacheFile)) {
        $data = json_decode(file_get_contents($cacheFile), true);
        if ($data && ($currentTime - $data['timestamp']) < $window) {
            if ($data['count'] >= $limit) return false;
            $data['count']++;
        } else {
            $data = ['timestamp' => $currentTime, 'count' => 1];
        }
    } else {
        $data = ['timestamp' => $currentTime, 'count' => 1];
    }
    file_put_contents($cacheFile, json_encode($data));
    return true;
}
$clientIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!checkRateLimit($clientIP)) {
    apiError('Rate limit aşıldı. Lütfen daha sonra tekrar deneyin.', 429, $outputType, ['retry_after' => 60]);
}

// --- Parametre Validasyonu ---
function validateTarget($target) {
    if (empty($target) || strlen($target) > 253) return false;
    $dangerousChars = ['<', '>', '"', "'", '&', ';', '|', '`', '$', '(', ')', '{', '}', '[', ']'];
    foreach ($dangerousChars as $char) if (strpos($target, $char) !== false) return false;
    if (filter_var($target, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
        $parts = explode('.', $target);
        foreach ($parts as $part) if (strlen($part) > 63 || !preg_match('/^[a-zA-Z0-9\-]+$/', $part)) return false;
        return true;
    } elseif (filter_var($target, FILTER_VALIDATE_IP)) {
        return true;
    }
    return false;
}
if (empty($target)) {
    apiError('Target parameter is required', 400, $outputType, ['required_parameters' => ['target']]);
}
if (!validateTarget($target)) {
    apiError('Invalid target format. Use valid domain or IP address.', 400, $outputType, [
        'examples' => [
            'domains' => ['google.com', 'guvenliktarama.com', 'example.org'],
            'ips' => ['8.8.8.8', '1.1.1.1', '192.168.1.1']
        ]
    ]);
}
if ($port !== null) {
    $port = (int)$port;
    if ($port < 1 || $port > 65535) {
        apiError('Invalid port number. Must be between 1 and 65535.', 400, $outputType);
    }
}
$validChecks = ['dns', 'ssl', 'headers', 'ports', 'email', 'blacklist'];
if (!empty($checks)) {
    $invalidChecks = array_diff($checks, $validChecks);
    if (!empty($invalidChecks)) {
        apiError('Invalid check types: ' . implode(', ', $invalidChecks), 400, $outputType, [
            'valid_checks' => $validChecks
        ]);
    }
} else {
    $checks = ['dns', 'ssl', 'headers', 'ports'];
}

// --- Güvenlik Kontrolünü Çalıştır ---
require_once 'security_check.php';
$checker = new SecurityChecker($target, $port, $checks);
$results = $checker->runChecks();

// --- Yanıt ---
if ($outputType === 'text') {
    header('Content-Type: text/plain; charset=utf-8');
    $summary = $results['summary'] ?? [];
    $lines = [];
    $lines[] = "Güvenlik Kontrol Sonucu";
    $lines[] = "Hedef: $target";
    if ($port) $lines[] = "Port: $port";
    $lines[] = "";
    foreach ($results['results'] as $item) {
        $lines[] = "- {$item['title']}: {$item['status']}";
        $lines[] = "  {$item['description']}";
        $lines[] = "  Detay: " . (is_string($item['details']) ? $item['details'] : json_encode($item['details'], JSON_UNESCAPED_UNICODE));
        $lines[] = "";
    }
    $lines[] = "Toplam Test: " . ($summary['total'] ?? '-');
    $lines[] = "Başarılı: " . ($summary['passed'] ?? '-');
    $lines[] = "Uyarı: " . ($summary['warnings'] ?? '-');
    $lines[] = "Başarısız: " . ($summary['failed'] ?? '-');
    echo implode("\n", $lines);
    exit();
} else {
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => true,
        'timestamp' => date('Y-m-d H:i:s'),
        'request' => [
            'target' => $target,
            'port' => $port,
            'checks' => $checks
        ],
        'data' => $results
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

/**
 * --- API DOKÜMANTASYON ---
 *
 * Endpoint: https://guvenliktarama.com/api.php
 *
 * Parametreler:
 *   - target (zorunlu): Domain veya IP adresi
 *   - port (opsiyonel): Port numarası
 *   - checks[] (opsiyonel): Kontrol türleri (dns, ssl, headers, ports, email, blacklist)
 *   - o (opsiyonel): json (varsayılan) veya text
 *
 * Örnekler:
 *   https://guvenliktarama.com/api.php?target=google.com&o=json
 *   https://guvenliktarama.com/api.php?target=google.com&o=text
 *   https://guvenliktarama.com/api.php?target=8.8.8.8&port=53&checks[]=dns&checks[]=ports&o=text
 *
 * Yanıt:
 *   - JSON: Başarılı ve detaylı sonuçlar
 *   - TEXT: İnsan okunabilir özet
 *
 * Rate limit: Dakikada 20 istek
 * API anahtarı: (Opsiyonel, production için zorunlu)
 */
?> 