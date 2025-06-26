<?php
header('Content-Type: application/json; charset=utf-8');

// Güvenli CORS ayarları
$allowedOrigins = [
    'http://localhost:8000',
    'http://localhost:3000',
    'https://yourdomain.com', // Production domain'inizi buraya ekleyin
    'https://www.yourdomain.com'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
} else {
    // Güvenli olmayan origin'ler için CORS'u kapat
    header('Access-Control-Allow-Origin: null');
}

header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Max-Age: 86400'); // 24 saat

// Güvenlik headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// OPTIONS isteği için CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Güvenli API anahtarı kontrolü
function validateApiKey() {
    $apiKey = null;
    
    // Authorization header'dan al (önerilen yöntem)
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
        $apiKey = $matches[1];
    }
    
    // Eğer Authorization header yoksa, sadece demo modunda çalış
    if (!$apiKey) {
        // Production'da API anahtarı zorunlu olmalı
        if ($_SERVER['HTTP_HOST'] !== 'localhost:8000' && $_SERVER['HTTP_HOST'] !== 'localhost:3000') {
            return false;
        }
        return true; // Demo modu
    }
    
    // API anahtarlarını environment variable'dan al (production için)
    $validApiKeys = [];
    
    // Environment variable'dan API anahtarlarını al
    $envApiKeys = getenv('SECURITY_API_KEYS');
    if ($envApiKeys) {
        $validApiKeys = explode(',', $envApiKeys);
    }
    
    // Fallback için demo anahtarları (sadece localhost'ta)
    if (empty($validApiKeys) && in_array($_SERVER['HTTP_HOST'], ['localhost:8000', 'localhost:3000'])) {
        $validApiKeys = [
            'demo_key_12345',
            'test_api_key_67890'
        ];
    }
    
    return in_array($apiKey, $validApiKeys);
}

// Gelişmiş rate limiting
function checkRateLimit($ip) {
    // IP adresini doğrula
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        return false;
    }
    
    // Private IP'leri engelle (production'da)
    if (!in_array($_SERVER['HTTP_HOST'], ['localhost:8000', 'localhost:3000'])) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
    }
    
    $cacheDir = sys_get_temp_dir() . '/security_api_rate_limit/';
    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }
    
    $cacheFile = $cacheDir . md5($ip) . '.json';
    $currentTime = time();
    $limit = 20; // 1 dakikada maksimum 20 istek
    $window = 60; // 60 saniye
    
    if (file_exists($cacheFile)) {
        $data = json_decode(file_get_contents($cacheFile), true);
        if ($data && ($currentTime - $data['timestamp']) < $window) {
            if ($data['count'] >= $limit) {
                return false;
            }
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

// Gelişmiş input validation
function validateTarget($target) {
    // Boş kontrol
    if (empty($target)) {
        return false;
    }
    
    // Uzunluk kontrolü
    if (strlen($target) > 253) {
        return false;
    }
    
    // Tehlikeli karakterler
    $dangerousChars = ['<', '>', '"', "'", '&', ';', '|', '`', '$', '(', ')', '{', '}', '[', ']'];
    foreach ($dangerousChars as $char) {
        if (strpos($target, $char) !== false) {
            return false;
        }
    }
    
    // Domain/IP validasyonu
    if (filter_var($target, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
        // Domain validasyonu
        $parts = explode('.', $target);
        foreach ($parts as $part) {
            if (strlen($part) > 63 || !preg_match('/^[a-zA-Z0-9\-]+$/', $part)) {
                return false;
            }
        }
        return true;
    } elseif (filter_var($target, FILTER_VALIDATE_IP)) {
        // IP validasyonu
        return true;
    }
    
    return false;
}

// Ana API işlemi
try {
    // Rate limiting kontrolü
    $clientIP = $_SERVER['REMOTE_ADDR'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'unknown';
    if (!checkRateLimit($clientIP)) {
        http_response_code(429);
        echo json_encode([
            'error' => true,
            'message' => 'Rate limit exceeded. Please try again later.',
            'retry_after' => 60
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    // API anahtarı kontrolü
    if (!validateApiKey()) {
        http_response_code(401);
        echo json_encode([
            'error' => true,
            'message' => 'Invalid or missing API key. Use Authorization: Bearer YOUR_API_KEY header.'
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    // İstek metodunu kontrol et
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'error' => true,
            'message' => 'Method not allowed. Use POST.',
            'allowed_methods' => ['POST']
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    // JSON veya form data'dan parametreleri al
    $input = [];
    
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $input = json_decode(file_get_contents('php://input'), true) ?? [];
    } else {
        $input = $_POST;
    }
    
    $target = $input['target'] ?? '';
    $port = $input['port'] ?? null;
    $checks = $input['checks'] ?? [];
    
    // Gelişmiş parametre validasyonu
    if (empty($target)) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Target parameter is required',
            'required_parameters' => ['target'],
            'example' => [
                'target' => 'example.com',
                'port' => '443',
                'checks' => ['dns', 'ssl', 'headers']
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    // Target validasyonu
    if (!validateTarget($target)) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Invalid target format. Use valid domain or IP address.',
            'examples' => [
                'domains' => ['google.com', 'github.com', 'example.org'],
                'ips' => ['8.8.8.8', '1.1.1.1', '192.168.1.1']
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    // Port validasyonu
    if ($port !== null) {
        $port = (int)$port;
        if ($port < 1 || $port > 65535) {
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => 'Invalid port number. Must be between 1 and 65535.'
            ], JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
    
    // Checks validasyonu
    $validChecks = ['dns', 'ssl', 'headers', 'ports', 'whois', 'blacklist'];
    if (!empty($checks)) {
        $invalidChecks = array_diff($checks, $validChecks);
        if (!empty($invalidChecks)) {
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => 'Invalid check types: ' . implode(', ', $invalidChecks),
                'valid_checks' => $validChecks
            ], JSON_UNESCAPED_UNICODE);
            exit();
        }
    } else {
        $checks = ['dns', 'ssl', 'headers', 'ports']; // Varsayılan kontroller
    }
    
    // SecurityChecker sınıfını dahil et
    require_once 'security_check.php';
    
    // Güvenlik kontrolünü çalıştır
    $checker = new SecurityChecker($target, $port, $checks);
    $results = $checker->runChecks();
    
    // API yanıtını hazırla
    $response = [
        'success' => true,
        'timestamp' => date('Y-m-d H:i:s'),
        'request' => [
            'target' => $target,
            'port' => $port,
            'checks' => $checks
        ],
        'data' => $results
    ];
    
    // Başarılı yanıt
    http_response_code(200);
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    // Hata durumunda
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Internal server error',
        'timestamp' => date('Y-m-d H:i:s'),
        'request_id' => uniqid('api_', true)
    ], JSON_UNESCAPED_UNICODE);
}
?> 