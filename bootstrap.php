<?php
/**
 * Application Bootstrap
 * 
 * Centralized logic for security, rate limiting, and shared utilities.
 */

// Define bootstrap constant to prevent direct file access to internal scripts
define('APP_BOOTSTRAPPED', true);

require_once 'security_config.php';

// Set common security headers (ensure no duplicates with .htaccess if possible)
SecurityConfig::setSecurityHeaders();

// Handle CORS Preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

/**
 * Handle Rate Limiting
 */
function handleRateLimit($outputType = 'json')
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    // Check for trusted proxy headers if in production
    if (SecurityConfig::isProduction()) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_REAL_IP'] ?? $ip;
    }

    $cacheDir = sys_get_temp_dir() . '/security_api_rate_limit/';
    if (!is_dir($cacheDir))
        @mkdir($cacheDir, 0755, true);
    $cacheFile = $cacheDir . md5($ip) . '.json';

    $currentTime = time();
    $config = SecurityConfig::getRateLimitConfig();
    $limit = $config['requests_per_minute'];
    $window = $config['window_seconds'];

    if (file_exists($cacheFile)) {
        $data = json_decode(@file_get_contents($cacheFile), true);
        if ($data && ($currentTime - $data['timestamp']) < $window) {
            if ($data['count'] >= $limit) {
                http_response_code(429);
                if ($outputType === 'text') {
                    die("Hata: Rate limit aşıldı. Lütfen 60 saniye bekleyin.");
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    die(json_encode([
                        'error' => true,
                        'message' => 'Rate limit aşıldı. Lütfen daha sonra tekrar deneyin.',
                        'retry_after' => 60
                    ]));
                }
            }
            $data['count']++;
        } else {
            $data = ['timestamp' => $currentTime, 'count' => 1];
        }
    } else {
        $data = ['timestamp' => $currentTime, 'count' => 1];
    }

    @file_put_contents($cacheFile, json_encode($data));
}
