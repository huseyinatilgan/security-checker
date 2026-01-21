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

require_once 'bootstrap.php';

// --- Hata Mesajı Fonksiyonu ---
function apiError($message, $code = 400, $outputType = 'json', $extra = [])
{
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

// --- Parametreleri Al ---
$input = $_GET;
$target = $input['target'] ?? '';
$port = $input['port'] ?? null;
$checks = $input['checks'] ?? [];
$outputType = strtolower($input['o'] ?? 'json');

// --- Sadece GET Desteği ---
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    apiError('Sadece GET istekleri kabul edilir', 405, $outputType);
}

// --- Rate Limiting ---
handleRateLimit($outputType);

// --- Parametre Validasyonu ---
if (empty($target)) {
    apiError('Target parameter is required', 400, $outputType, ['required_parameters' => ['target']]);
}

$validationErrors = SecurityConfig::validateSecurity($target, $port, $checks);
if (!empty($validationErrors)) {
    apiError(implode(', ', $validationErrors), 400, $outputType, [
        'examples' => [
            'domains' => ['google.com', 'guvenliktarama.com'],
            'ips' => ['8.8.8.8', '1.1.1.1']
        ]
    ]);
}

if ($port !== null)
    $port = (int) $port;
if (empty($checks))
    $checks = ['dns', 'ssl', 'headers', 'ports'];

// --- Güvenlik Kontrolünü Çalıştır ---
require_once 'security_check.php';
try {
    $checker = new SecurityChecker($target, $port, $checks);
    $results = $checker->runChecks();
} catch (Exception $e) {
    apiError($e->getMessage(), 400, $outputType);
}

// --- Yanıt ---
if ($outputType === 'text') {
    header('Content-Type: text/plain; charset=utf-8');
    $summary = $results['summary'] ?? [];
    $lines = [];
    $lines[] = "Güvenlik Kontrol Sonucu";
    $lines[] = "Hedef: $target";
    if ($port)
        $lines[] = "Port: $port";
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
?>
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