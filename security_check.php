<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Güvenlik headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Hata raporlamayı kapat (production için)
error_reporting(0);
ini_set('display_errors', 0);

// Güvenlik fonksiyonları
class SecurityChecker {
    private $target;
    private $port;
    private $checks;
    private $results = [];
    private $summary = ['passed' => 0, 'warnings' => 0, 'failed' => 0, 'total' => 0];

    public function __construct($target, $port = null, $checks = []) {
        $this->target = $this->sanitizeInput($target);
        $this->port = $port ? (int)$port : null;
        $this->checks = $checks;
        
        // Güvenlik kontrolü
        if (!$this->validateTarget($this->target)) {
            throw new Exception('Geçersiz hedef formatı');
        }
    }

    private function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    private function validateTarget($target) {
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

    public function runChecks() {
        foreach ($this->checks as $check) {
            switch ($check) {
                case 'dns':
                    $this->checkDNS();
                    break;
                case 'ssl':
                    $this->checkSSL();
                    break;
                case 'headers':
                    $this->checkHTTPHeaders();
                    break;
                case 'ports':
                    $this->checkPorts();
                    break;
                case 'whois':
                    $this->checkWHOIS();
                    break;
                case 'blacklist':
                    $this->checkBlacklist();
                    break;
            }
        }

        $this->summary['total'] = count($this->results);
        return [
            'summary' => $this->summary,
            'results' => $this->results
        ];
    }

    private function addResult($title, $description, $status, $details) {
        $this->results[] = [
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'details' => $details
        ];

        switch ($status) {
            case 'success':
                $this->summary['passed']++;
                break;
            case 'warning':
                $this->summary['warnings']++;
                break;
            case 'error':
                $this->summary['failed']++;
                break;
        }
    }

    private function checkDNS() {
        $title = 'DNS Güvenlik Kontrolü';
        $description = 'DNS kayıtları ve güvenlik ayarları kontrol ediliyor';
        
        try {
            $details = "DNS Kontrol Sonuçları:\n\n";
            
            // A kaydı kontrolü
            $aRecords = dns_get_record($this->target, DNS_A);
            if (!empty($aRecords)) {
                $details .= "✓ A Kaydı bulundu\n";
                foreach ($aRecords as $record) {
                    $details .= "  IP: " . $record['ip'] . "\n";
                }
            } else {
                $details .= "⚠ A Kaydı bulunamadı\n";
            }

            // MX kaydı kontrolü
            $mxRecords = dns_get_record($this->target, DNS_MX);
            if (!empty($mxRecords)) {
                $details .= "✓ MX Kaydı bulundu\n";
                foreach ($mxRecords as $record) {
                    $details .= "  Mail Server: " . $record['target'] . " (Priority: " . $record['pri'] . ")\n";
                }
            }

            // TXT kaydı kontrolü (SPF, DKIM vb.)
            $txtRecords = dns_get_record($this->target, DNS_TXT);
            $hasSPF = false;
            $hasDMARC = false;
            
            foreach ($txtRecords as $record) {
                if (strpos($record['txt'], 'v=spf1') !== false) {
                    $hasSPF = true;
                    $details .= "✓ SPF Kaydı bulundu: " . $record['txt'] . "\n";
                }
                if (strpos($record['txt'], 'v=DMARC1') !== false) {
                    $hasDMARC = true;
                    $details .= "✓ DMARC Kaydı bulundu: " . $record['txt'] . "\n";
                }
            }

            if (!$hasSPF) {
                $details .= "⚠ SPF Kaydı bulunamadı (E-posta güvenliği için önerilir)\n";
            }
            if (!$hasDMARC) {
                $details .= "⚠ DMARC Kaydı bulunamadı (E-posta güvenliği için önerilir)\n";
            }

            // NS kaydı kontrolü
            $nsRecords = dns_get_record($this->target, DNS_NS);
            if (!empty($nsRecords)) {
                $details .= "✓ NS Kaydı bulundu\n";
                foreach ($nsRecords as $record) {
                    $details .= "  Name Server: " . $record['target'] . "\n";
                }
            }

            $status = ($hasSPF && $hasDMARC && !empty($aRecords)) ? 'success' : 'warning';
            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'DNS kontrolü sırasında hata: ' . $e->getMessage());
        }
    }

    private function checkSSL() {
        $title = 'SSL/TLS Güvenlik Kontrolü';
        $description = 'SSL sertifikası ve güvenlik protokolleri kontrol ediliyor';
        
        try {
            $details = "SSL/TLS Kontrol Sonuçları:\n\n";
            
            $context = stream_context_create([
                'ssl' => [
                    'capture_peer_cert' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);

            $port = $this->port ?: 443;
            $connection = @stream_socket_client(
                "ssl://{$this->target}:{$port}",
                $errno,
                $errstr,
                10,
                STREAM_CLIENT_CONNECT,
                $context
            );

            if ($connection) {
                $details .= "✓ SSL bağlantısı başarılı\n";
                
                $cert = stream_context_get_params($connection);
                if (isset($cert['options']['ssl']['peer_certificate'])) {
                    $certData = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
                    
                    if ($certData) {
                        $details .= "✓ Sertifika bulundu\n";
                        $details .= "  Konu: " . $certData['subject']['CN'] . "\n";
                        $details .= "  Yayınlayan: " . $certData['issuer']['CN'] . "\n";
                        $details .= "  Geçerlilik Başlangıcı: " . date('Y-m-d H:i:s', $certData['validFrom_time_t']) . "\n";
                        $details .= "  Geçerlilik Bitişi: " . date('Y-m-d H:i:s', $certData['validTo_time_t']) . "\n";
                        
                        // Sertifika geçerlilik kontrolü
                        $now = time();
                        if ($certData['validTo_time_t'] < $now) {
                            $details .= "⚠ Sertifika süresi dolmuş!\n";
                            $status = 'error';
                        } elseif ($certData['validTo_time_t'] < ($now + 30 * 24 * 60 * 60)) {
                            $details .= "⚠ Sertifika 30 gün içinde sona erecek\n";
                            $status = 'warning';
                        } else {
                            $details .= "✓ Sertifika geçerli\n";
                            $status = 'success';
                        }
                    }
                }
                
                fclose($connection);
            } else {
                $details .= "⚠ SSL bağlantısı kurulamadı\n";
                $details .= "  Hata: {$errstr} (Kod: {$errno})\n";
                $status = 'error';
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'SSL kontrolü sırasında hata: ' . $e->getMessage());
        }
    }

    private function checkHTTPHeaders() {
        $title = 'HTTP Güvenlik Headers Kontrolü';
        $description = 'HTTP güvenlik başlıkları kontrol ediliyor';
        
        try {
            $details = "HTTP Headers Kontrol Sonuçları:\n\n";
            
            $protocol = $this->port == 443 ? 'https' : 'http';
            $url = "{$protocol}://{$this->target}";
            
            $context = stream_context_create([
                'http' => [
                    'method' => 'HEAD',
                    'timeout' => 10,
                    'user_agent' => 'SecurityChecker/1.0'
                ]
            ]);

            $headers = @get_headers($url, 1, $context);
            
            if ($headers) {
                $details .= "✓ HTTP bağlantısı başarılı\n\n";
                
                $securityHeaders = [
                    'Strict-Transport-Security' => 'HSTS (HTTPS zorunluluğu)',
                    'X-Frame-Options' => 'Clickjacking koruması',
                    'X-Content-Type-Options' => 'MIME type sniffing koruması',
                    'X-XSS-Protection' => 'XSS koruması',
                    'Content-Security-Policy' => 'CSP (İçerik güvenlik politikası)',
                    'Referrer-Policy' => 'Referrer politikası',
                    'Permissions-Policy' => 'İzin politikası'
                ];

                $foundHeaders = 0;
                foreach ($securityHeaders as $header => $description) {
                    if (isset($headers[$header])) {
                        $details .= "✓ {$description}: {$headers[$header]}\n";
                        $foundHeaders++;
                    } else {
                        $details .= "⚠ {$description}: Bulunamadı\n";
                    }
                }

                // Server bilgisi
                if (isset($headers['Server'])) {
                    $details .= "\nServer: " . $headers['Server'] . "\n";
                }

                $status = ($foundHeaders >= 4) ? 'success' : 
                         (($foundHeaders >= 2) ? 'warning' : 'error');
                
            } else {
                $details .= "⚠ HTTP bağlantısı kurulamadı\n";
                $status = 'error';
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'HTTP headers kontrolü sırasında hata: ' . $e->getMessage());
        }
    }

    private function checkPorts() {
        $title = 'Port Tarama Kontrolü';
        $description = 'Yaygın portların durumu kontrol ediliyor';
        
        try {
            $details = "Port Tarama Sonuçları:\n\n";
            
            // Güvenli port listesi (sadece yaygın portlar)
            $commonPorts = [
                21 => 'FTP',
                22 => 'SSH',
                23 => 'Telnet',
                25 => 'SMTP',
                53 => 'DNS',
                80 => 'HTTP',
                110 => 'POP3',
                143 => 'IMAP',
                443 => 'HTTPS',
                993 => 'IMAPS',
                995 => 'POP3S',
                3306 => 'MySQL',
                3389 => 'RDP',
                5432 => 'PostgreSQL',
                8080 => 'HTTP Alt Port'
            ];

            // Port tarama limiti (güvenlik için)
            $maxPortsToScan = 10;
            $scannedPorts = 0;
            $openPorts = 0;
            $totalChecked = 0;

            foreach ($commonPorts as $port => $service) {
                if ($scannedPorts >= $maxPortsToScan) {
                    break; // Güvenlik limiti
                }
                
                $totalChecked++;
                $scannedPorts++;
                
                // Timeout ile güvenli bağlantı
                $connection = @fsockopen($this->target, $port, $errno, $errstr, 2);
                
                if ($connection) {
                    $details .= "⚠ Port {$port} ({$service}): AÇIK\n";
                    $openPorts++;
                    fclose($connection);
                } else {
                    $details .= "✓ Port {$port} ({$service}): KAPALI\n";
                }
            }

            $details .= "\nÖzet:\n";
            $details .= "  Toplam kontrol edilen port: {$totalChecked}\n";
            $details .= "  Açık port sayısı: {$openPorts}\n";
            $details .= "  Güvenlik: Maksimum {$maxPortsToScan} port tarandı\n";

            // Güvenlik değerlendirmesi
            if ($openPorts == 0) {
                $status = 'success';
                $details .= "  Durum: Tüm portlar kapalı (Güvenli)\n";
            } elseif ($openPorts <= 3) {
                $status = 'warning';
                $details .= "  Durum: Az sayıda port açık\n";
            } else {
                $status = 'error';
                $details .= "  Durum: Çok sayıda port açık (Güvenlik riski)\n";
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'Port tarama sırasında hata: ' . $e->getMessage());
        }
    }

    private function checkWHOIS() {
        $title = 'WHOIS Bilgi Kontrolü';
        $description = 'Domain kayıt bilgileri kontrol ediliyor';
        
        try {
            $details = "WHOIS Kontrol Sonuçları:\n\n";
            
            // Basit WHOIS kontrolü (gerçek WHOIS servisi için daha gelişmiş bir çözüm gerekir)
            $whoisServers = [
                'com' => 'whois.verisign-grs.com',
                'net' => 'whois.verisign-grs.com',
                'org' => 'whois.pir.org',
                'info' => 'whois.afilias.net',
                'biz' => 'whois.biz',
                'tr' => 'whois.nic.tr'
            ];

            $domain = $this->target;
            $tld = pathinfo($domain, PATHINFO_EXTENSION);
            
            if (isset($whoisServers[$tld])) {
                $details .= "✓ WHOIS sunucusu bulundu: {$whoisServers[$tld]}\n";
                $details .= "⚠ WHOIS sorgusu için gelişmiş bir servis gerekli\n";
                $details .= "  (Bu özellik için harici WHOIS API kullanılması önerilir)\n";
                $status = 'warning';
            } else {
                $details .= "⚠ WHOIS sunucusu bulunamadı\n";
                $details .= "  TLD: {$tld}\n";
                $status = 'warning';
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'WHOIS kontrolü sırasında hata: ' . $e->getMessage());
        }
    }

    private function checkBlacklist() {
        $title = 'Kara Liste Kontrolü';
        $description = 'IP adresinin kara listelerde olup olmadığı kontrol ediliyor';
        
        try {
            $details = "Kara Liste Kontrol Sonuçları:\n\n";
            
            // IP adresini al
            $ip = gethostbyname($this->target);
            
            if ($ip && $ip !== $this->target) {
                $details .= "✓ IP adresi çözümlendi: {$ip}\n\n";
                
                // Basit kara liste kontrolü (gerçek uygulamada daha gelişmiş servisler kullanılır)
                $blacklistChecks = [
                    'Spamhaus' => 'zen.spamhaus.org',
                    'Barracuda' => 'b.barracudacentral.org',
                    'Sorbs' => 'dnsbl.sorbs.net'
                ];

                $blacklistedCount = 0;
                foreach ($blacklistChecks as $service => $server) {
                    $reverseIP = implode('.', array_reverse(explode('.', $ip)));
                    $lookup = $reverseIP . '.' . $server;
                    
                    $result = gethostbyname($lookup);
                    
                    if ($result !== $lookup) {
                        $details .= "⚠ {$service}: Kara listede bulundu\n";
                        $blacklistedCount++;
                    } else {
                        $details .= "✓ {$service}: Temiz\n";
                    }
                }

                if ($blacklistedCount == 0) {
                    $status = 'success';
                    $details .= "\n✓ IP adresi tüm kara listelerde temiz\n";
                } else {
                    $status = 'error';
                    $details .= "\n⚠ IP adresi {$blacklistedCount} kara listede bulundu\n";
                }
                
            } else {
                $details .= "⚠ IP adresi çözümlenemedi\n";
                $status = 'warning';
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'Kara liste kontrolü sırasında hata: ' . $e->getMessage());
        }
    }
}

// Ana işlem
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Sadece POST istekleri kabul edilir');
    }

    $target = $_POST['target'] ?? '';
    $port = $_POST['port'] ?? null;
    $checks = $_POST['checks'] ?? [];

    if (empty($target)) {
        throw new Exception('Hedef belirtilmedi');
    }

    if (empty($checks)) {
        $checks = ['dns', 'ssl', 'headers', 'ports']; // Varsayılan kontroller
    }

    $checker = new SecurityChecker($target, $port, $checks);
    $results = $checker->runChecks();

    echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?> 