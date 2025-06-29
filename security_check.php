<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
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
                case 'email':
                    $this->checkEmailSecurity();
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
            
            // Timeout ayarı
            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'timeout' => 10
                ]
            ]);
            
            // SSL bağlantısı kur
            $socket = @stream_socket_client(
                "ssl://{$this->target}:443", 
                $errno, 
                $errstr, 
                10, 
                STREAM_CLIENT_CONNECT, 
                $context
            );
            
            if (!$socket) {
                $this->addResult($title, $description, 'error', 'SSL bağlantısı kurulamadı: ' . $errstr);
                return;
            }
            
            // Sertifika bilgilerini al
            $cert = stream_context_get_params($socket);
            $certData = stream_get_meta_data($socket);
            
            if (isset($certData['crypto'])) {
                $details .= "✓ SSL/TLS bağlantısı başarılı\n";
                $details .= "  Protokol: " . $certData['crypto']['protocol'] . "\n";
                $details .= "  Cipher: " . $certData['crypto']['cipher_name'] . "\n";
                $details .= "  Key Exchange: " . $certData['crypto']['key_exchange'] . "\n";
            }
            
            // Sertifika bilgilerini al
            $certInfo = stream_context_get_params($socket);
            if (isset($certInfo['options']['ssl']['peer_certificate'])) {
                $cert = openssl_x509_parse($certInfo['options']['ssl']['peer_certificate']);
                
                if ($cert) {
                    $details .= "\n📋 Sertifika Bilgileri:\n";
                    $details .= "  Konu: " . $cert['subject']['CN'] . "\n";
                    $details .= "  Yayınlayan: " . $cert['issuer']['CN'] . "\n";
                    $details .= "  Geçerlilik Başlangıcı: " . date('Y-m-d', $cert['validFrom_time_t']) . "\n";
                    $details .= "  Geçerlilik Bitişi: " . date('Y-m-d', $cert['validTo_time_t']) . "\n";
                    
                    // Sertifika geçerlilik kontrolü
                    $currentTime = time();
                    if ($currentTime < $cert['validFrom_time_t']) {
                        $details .= "  ⚠ Sertifika henüz geçerli değil\n";
                        $status = 'warning';
                    } elseif ($currentTime > $cert['validTo_time_t']) {
                        $details .= "  ✗ Sertifika süresi dolmuş\n";
                        $status = 'error';
                    } else {
                        $daysLeft = floor(($cert['validTo_time_t'] - $currentTime) / 86400);
                        $details .= "  ✓ Sertifika geçerli (Kalan gün: {$daysLeft})\n";
                        
                        if ($daysLeft < 30) {
                            $details .= "  ⚠ Sertifika yakında sona erecek\n";
                            $status = 'warning';
                        } else {
                            $status = 'success';
                        }
                    }
                    
                    // Güvenlik protokolleri kontrolü
                    $details .= "\n🔒 Güvenlik Protokolleri:\n";
                    $supportedProtocols = [];
                    
                    // TLS versiyonlarını test et
                    $tlsVersions = ['tlsv1.3', 'tlsv1.2', 'tlsv1.1', 'tlsv1.0'];
                    foreach ($tlsVersions as $version) {
                        $testContext = stream_context_create([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'timeout' => 5,
                                'crypto_method' => constant('STREAM_CRYPTO_METHOD_' . strtoupper($version))
                            ]
                        ]);
                        
                        $testSocket = @stream_socket_client(
                            "ssl://{$this->target}:443", 
                            $errno, 
                            $errstr, 
                            5, 
                            STREAM_CLIENT_CONNECT, 
                            $testContext
                        );
                        
                        if ($testSocket) {
                            $supportedProtocols[] = $version;
                            fclose($testSocket);
                        }
                    }
                    
                    if (in_array('tlsv1.3', $supportedProtocols)) {
                        $details .= "  ✓ TLS 1.3 destekleniyor (En güvenli)\n";
                    } elseif (in_array('tlsv1.2', $supportedProtocols)) {
                        $details .= "  ✓ TLS 1.2 destekleniyor (Güvenli)\n";
                    } else {
                        $details .= "  ⚠ Eski TLS versiyonları kullanılıyor\n";
                    }
                    
                    if (in_array('tlsv1.0', $supportedProtocols) || in_array('tlsv1.1', $supportedProtocols)) {
                        $details .= "  ⚠ Eski TLS versiyonları (1.0/1.1) destekleniyor\n";
                        if ($status === 'success') $status = 'warning';
                    }
                    
                } else {
                    $details .= "⚠ Sertifika bilgileri alınamadı\n";
                    $status = 'warning';
                }
            } else {
                $details .= "⚠ SSL sertifikası bulunamadı\n";
                $status = 'error';
            }
            
            fclose($socket);
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
            
            // Protokol belirleme
            $protocol = 'http';
            $port = $this->port ?: 80;
            
            // HTTPS kontrolü
            if ($port == 443 || $port == 8443) {
                $protocol = 'https';
            } else {
                // SSL kontrolü yap
                $sslContext = stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'timeout' => 5
                    ]
                ]);
                
                $sslConnection = @stream_socket_client(
                    "ssl://{$this->target}:{$port}",
                    $errno,
                    $errstr,
                    5,
                    STREAM_CLIENT_CONNECT,
                    $sslContext
                );
                
                if ($sslConnection) {
                    $protocol = 'https';
                    fclose($sslConnection);
                }
            }
            
            $url = "{$protocol}://{$this->target}";
            $details .= "🔗 Test URL: {$url}\n\n";
            
            // İlk bağlantı - redirect'leri kontrol et
            $context = stream_context_create([
                'http' => [
                    'method' => 'HEAD',
                    'timeout' => 10,
                    'user_agent' => 'SecurityChecker/1.0',
                    'follow_location' => false,
                    'max_redirects' => 0
                ]
            ]);

            $headers = @get_headers($url, 1, $context);
            
            if ($headers && is_array($headers)) {
                $details .= "✓ HTTP bağlantısı başarılı\n";
                
                // HTTP durum kodu kontrolü
                $statusLine = $headers[0] ?? '';
                if (preg_match('/HTTP\/\d\.\d\s+(\d+)/', $statusLine, $matches)) {
                    $httpCode = $matches[1];
                    $details .= "📊 HTTP Durum Kodu: {$httpCode}\n";
                    
                    // Redirect kontrolü
                    if ($httpCode >= 300 && $httpCode < 400) {
                        $details .= "🔄 Redirect tespit edildi\n";
                        
                        // Location header'ını bul
                        $location = null;
                        foreach ($headers as $key => $value) {
                            if (strcasecmp($key, 'Location') === 0) {
                                $location = is_array($value) ? $value[0] : $value;
                                break;
                            }
                        }
                        
                        if ($location) {
                            $details .= "📍 Yönlendirilen URL: {$location}\n\n";
                            
                            // Final URL'den header'ları al
                            $finalContext = stream_context_create([
                                'http' => [
                                    'method' => 'HEAD',
                                    'timeout' => 10,
                                    'user_agent' => 'SecurityChecker/1.0',
                                    'follow_location' => false,
                                    'max_redirects' => 0
                                ]
                            ]);
                            
                            $finalHeaders = @get_headers($location, 1, $finalContext);
                            
                            if ($finalHeaders && is_array($finalHeaders)) {
                                $finalStatusLine = $finalHeaders[0] ?? '';
                                if (preg_match('/HTTP\/\d\.\d\s+(\d+)/', $finalStatusLine, $matches)) {
                                    $finalHttpCode = $matches[1];
                                    $details .= "📊 Final HTTP Durum Kodu: {$finalHttpCode}\n";
                                    
                                    if ($finalHttpCode >= 400) {
                                        $details .= "⚠ Final URL'de HTTP hatası: {$finalStatusLine}\n";
                                    }
                                }
                                
                                $headers = $finalHeaders; // Final header'ları kullan
                            } else {
                                $details .= "⚠ Final URL'den header'lar alınamadı\n";
                            }
                        }
                    } elseif ($httpCode >= 400) {
                        $details .= "⚠ HTTP hatası: {$statusLine}\n";
                    }
                }
                
                $details .= "\n🔒 Güvenlik Headers Kontrolü:\n";
                
                $securityHeaders = [
                    'Strict-Transport-Security' => 'HSTS (HTTPS zorunluluğu)',
                    'X-Frame-Options' => 'Clickjacking koruması',
                    'X-Content-Type-Options' => 'MIME type sniffing koruması',
                    'X-XSS-Protection' => 'XSS koruması',
                    'Content-Security-Policy' => 'CSP (İçerik güvenlik politikası)',
                    'Referrer-Policy' => 'Referrer politikası',
                    'Permissions-Policy' => 'İzin politikası',
                    'X-Permitted-Cross-Domain-Policies' => 'Cross-domain politikası'
                ];

                $foundHeaders = 0;
                $totalHeaders = count($securityHeaders);
                
                foreach ($securityHeaders as $header => $description) {
                    $headerValue = null;
                    
                    // Case-insensitive header arama
                    foreach ($headers as $key => $value) {
                        if (strcasecmp($key, $header) === 0) {
                            $headerValue = is_array($value) ? $value[0] : $value;
                            break;
                        }
                    }
                    
                    if ($headerValue !== null) {
                        $details .= "✓ {$description}: {$headerValue}\n";
                        $foundHeaders++;
                    } else {
                        $details .= "⚠ {$description}: Bulunamadı\n";
                    }
                }

                // Server bilgisi
                $serverInfo = null;
                foreach ($headers as $key => $value) {
                    if (strcasecmp($key, 'Server') === 0) {
                        $serverInfo = is_array($value) ? $value[0] : $value;
                        break;
                    }
                }
                
                if ($serverInfo) {
                    $details .= "\n🖥️ Server: {$serverInfo}\n";
                }

                // Güvenlik değerlendirmesi
                $securityScore = ($foundHeaders / $totalHeaders) * 100;
                $details .= "\n📊 Güvenlik Skoru: {$foundHeaders}/{$totalHeaders} (%" . round($securityScore, 1) . ")\n";
                
                if ($securityScore >= 80) {
                    $status = 'success';
                    $details .= "✓ Mükemmel güvenlik headers yapılandırması\n";
                } elseif ($securityScore >= 60) {
                    $status = 'warning';
                    $details .= "⚠ İyi güvenlik headers, iyileştirme önerilir\n";
                } else {
                    $status = 'error';
                    $details .= "⚠ Yetersiz güvenlik headers yapılandırması\n";
                }
                
            } else {
                $details .= "⚠ HTTP bağlantısı kurulamadı\n";
                $details .= "  Olası nedenler:\n";
                $details .= "  • Domain erişilebilir değil\n";
                $details .= "  • Port kapalı veya yanlış\n";
                $details .= "  • Firewall engeli\n";
                $status = 'error';
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'HTTP headers kontrolü sırasında hata: ' . $e->getMessage());
        }
    }

    private function checkPorts() {
        $title = 'Port Tarama Kontrolü';
        $description = 'Açık portlar ve servisler kontrol ediliyor';
        
        try {
            $details = "Port Tarama Sonuçları:\n\n";
            
            // Güvenlik limitleri
            $maxPorts = 10; // Maksimum 10 port taranabilir
            $timeout = 3; // 3 saniye timeout
            
            // Varsayılan portlar
            $commonPorts = [21, 22, 23, 25, 53, 80, 110, 143, 443, 993, 995, 3306, 5432, 8080];
            
            // Eğer özel port belirtilmişse, sadece o portu tara
            if ($this->port !== null) {
                $portsToScan = [$this->port];
            } else {
                $portsToScan = array_slice($commonPorts, 0, $maxPorts);
            }
            
            $openPorts = [];
            $closedPorts = [];
            
            foreach ($portsToScan as $port) {
                // Port numarası validasyonu
                if ($port < 1 || $port > 65535) {
                    continue;
                }
                
                $connection = @fsockopen($this->target, $port, $errno, $errstr, $timeout);
                
                if ($connection) {
                    $openPorts[] = $port;
                    $serviceName = $this->getServiceName($port);
                    $details .= "✓ Port {$port} açık ({$serviceName})\n";
                    fclose($connection);
                } else {
                    $closedPorts[] = $port;
                    $details .= "✗ Port {$port} kapalı\n";
                }
            }
            
            $details .= "\n📊 Port Tarama Özeti:\n";
            $details .= "  • Açık portlar: " . count($openPorts) . "\n";
            $details .= "  • Kapalı portlar: " . count($closedPorts) . "\n";
            $details .= "  • Toplam taranan: " . count($portsToScan) . "\n";
            
            // Güvenlik değerlendirmesi
            $dangerousPorts = [21, 23, 25, 110, 143]; // FTP, Telnet, SMTP, POP3, IMAP
            $openDangerousPorts = array_intersect($openPorts, $dangerousPorts);
            
            if (!empty($openDangerousPorts)) {
                $details .= "\n⚠ Güvenlik Uyarısı:\n";
                foreach ($openDangerousPorts as $port) {
                    $serviceName = $this->getServiceName($port);
                    $details .= "  • Port {$port} ({$serviceName}) güvenlik riski oluşturabilir\n";
                }
                $status = 'warning';
            } elseif (empty($openPorts)) {
                $details .= "\n✓ Tüm taranan portlar kapalı (güvenli)\n";
                $status = 'success';
            } else {
                $details .= "\n✓ Açık portlar güvenlik riski oluşturmuyor\n";
                $status = 'success';
            }
            
            $this->addResult($title, $description, $status, $details);
            
        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'Port tarama sırasında hata: ' . $e->getMessage());
        }
    }
    
    private function getServiceName($port) {
        $services = [
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
            5432 => 'PostgreSQL',
            8080 => 'HTTP-Alt'
        ];
        
        return $services[$port] ?? 'Unknown';
    }

    private function checkEmailSecurity() {
        $title = 'E-posta Güvenlik Kontrolü';
        $description = 'E-posta güvenlik ayarları kontrol ediliyor';
        
        try {
            $details = "E-posta Güvenlik Kontrol Sonuçları:\n\n";
            
            // SPF, DKIM, DMARC kontrolleri
            $spfStatus = $this->checkSPF();
            $dkimStatus = $this->checkDKIM();
            $dmarcStatus = $this->checkDMARC();
            $mxStatus = $this->checkMXRecords();
            $reverseDNSStatus = $this->checkReverseDNS();
            
            // Özet
            $totalChecks = 5;
            $passedChecks = 0;
            
            if ($spfStatus['status'] === 'success') $passedChecks++;
            if ($dkimStatus['status'] === 'success') $passedChecks++;
            if ($dmarcStatus['status'] === 'success') $passedChecks++;
            if ($mxStatus['status'] === 'success') $passedChecks++;
            if ($reverseDNSStatus['status'] === 'success') $passedChecks++;
            
            $details .= $spfStatus['details'];
            $details .= $dkimStatus['details'];
            $details .= $dmarcStatus['details'];
            $details .= $mxStatus['details'];
            $details .= $reverseDNSStatus['details'];
            
            $details .= "\n📊 E-posta Güvenlik Skoru: {$passedChecks}/{$totalChecks}\n";
            
            if ($passedChecks >= 4) {
                $status = 'success';
                $details .= "✓ E-posta güvenlik ayarları mükemmel\n";
            } elseif ($passedChecks >= 3) {
                $status = 'warning';
                $details .= "⚠ E-posta güvenlik ayarları iyi, iyileştirme önerilir\n";
            } else {
                $status = 'error';
                $details .= "⚠ E-posta güvenlik ayarları yetersiz\n";
            }

            $this->addResult($title, $description, $status, $details);

        } catch (Exception $e) {
            $this->addResult($title, $description, 'error', 'E-posta güvenlik kontrolü sırasında hata: ' . $e->getMessage());
        }
    }
    
    private function checkSPF() {
        $details = "🔍 SPF (Sender Policy Framework) Kontrolü:\n";
        
        try {
            $txtRecords = dns_get_record($this->target, DNS_TXT);
            $spfRecord = null;
            
            foreach ($txtRecords as $record) {
                if (strpos($record['txt'], 'v=spf1') !== false) {
                    $spfRecord = $record['txt'];
                    break;
                }
            }
            
            if ($spfRecord) {
                $details .= "✓ SPF kaydı bulundu: {$spfRecord}\n";
                
                // SPF kaydı analizi
                if (strpos($spfRecord, '~all') !== false) {
                    $details .= "  ⚠ Soft fail (~all) kullanılıyor\n";
                    return ['status' => 'warning', 'details' => $details];
                } elseif (strpos($spfRecord, '-all') !== false) {
                    $details .= "  ✓ Hard fail (-all) kullanılıyor (En güvenli)\n";
                    return ['status' => 'success', 'details' => $details];
                } elseif (strpos($spfRecord, '?all') !== false) {
                    $details .= "  ⚠ Neutral (?all) kullanılıyor\n";
                    return ['status' => 'warning', 'details' => $details];
                } else {
                    $details .= "  ⚠ Mechanism belirtilmemiş\n";
                    return ['status' => 'warning', 'details' => $details];
                }
            } else {
                $details .= "⚠ SPF kaydı bulunamadı\n";
                $details .= "  Önerilen: v=spf1 -all\n";
                return ['status' => 'error', 'details' => $details];
            }
        } catch (Exception $e) {
            $details .= "⚠ SPF kontrolü sırasında hata: " . $e->getMessage() . "\n";
            return ['status' => 'error', 'details' => $details];
        }
    }
    
    private function checkDKIM() {
        $details = "🔍 DKIM (DomainKeys Identified Mail) Kontrolü:\n";
        
        try {
            // DKIM selector'ları kontrol et
            $dkimSelectors = ['default', 'google', 'selector1', 'selector2'];
            $dkimFound = false;
            
            foreach ($dkimSelectors as $selector) {
                $dkimRecord = dns_get_record("{$selector}._domainkey.{$this->target}", DNS_TXT);
                
                foreach ($dkimRecord as $record) {
                    if (strpos($record['txt'], 'v=DKIM1') !== false) {
                        $details .= "✓ DKIM kaydı bulundu (Selector: {$selector})\n";
                        $details .= "  " . substr($record['txt'], 0, 50) . "...\n";
                        $dkimFound = true;
                        break 2;
                    }
                }
            }
            
            if (!$dkimFound) {
                $details .= "⚠ DKIM kaydı bulunamadı\n";
                $details .= "  Önerilen: DKIM sertifikası oluşturun\n";
                return ['status' => 'error', 'details' => $details];
            }
            
            return ['status' => 'success', 'details' => $details];
            
        } catch (Exception $e) {
            $details .= "⚠ DKIM kontrolü sırasında hata: " . $e->getMessage() . "\n";
            return ['status' => 'error', 'details' => $details];
        }
    }
    
    private function checkDMARC() {
        $details = "🔍 DMARC (Domain-based Message Authentication) Kontrolü:\n";
        
        try {
            $dmarcRecords = dns_get_record("_dmarc.{$this->target}", DNS_TXT);
            $dmarcRecord = null;
            
            foreach ($dmarcRecords as $record) {
                if (strpos($record['txt'], 'v=DMARC1') !== false) {
                    $dmarcRecord = $record['txt'];
                    break;
                }
            }
            
            if ($dmarcRecord) {
                $details .= "✓ DMARC kaydı bulundu: {$dmarcRecord}\n";
                
                // DMARC policy kontrolü
                if (preg_match('/p=reject/', $dmarcRecord)) {
                    $details .= "  ✓ Reject policy kullanılıyor (En güvenli)\n";
                    return ['status' => 'success', 'details' => $details];
                } elseif (preg_match('/p=quarantine/', $dmarcRecord)) {
                    $details .= "  ⚠ Quarantine policy kullanılıyor\n";
                    return ['status' => 'warning', 'details' => $details];
                } elseif (preg_match('/p=none/', $dmarcRecord)) {
                    $details .= "  ⚠ None policy kullanılıyor (Sadece izleme)\n";
                    return ['status' => 'warning', 'details' => $details];
                } else {
                    $details .= "  ⚠ Policy belirtilmemiş\n";
                    return ['status' => 'warning', 'details' => $details];
                }
            } else {
                $details .= "⚠ DMARC kaydı bulunamadı\n";
                $details .= "  Önerilen: v=DMARC1; p=reject; rua=mailto:dmarc@{$this->target}\n";
                return ['status' => 'error', 'details' => $details];
            }
            
        } catch (Exception $e) {
            $details .= "⚠ DMARC kontrolü sırasında hata: " . $e->getMessage() . "\n";
            return ['status' => 'error', 'details' => $details];
        }
    }
    
    private function checkMXRecords() {
        $details = "🔍 MX (Mail Exchange) Kayıtları Kontrolü:\n";
        
        try {
            $mxRecords = dns_get_record($this->target, DNS_MX);
            
            if (!empty($mxRecords)) {
                $details .= "✓ MX kayıtları bulundu:\n";
                foreach ($mxRecords as $record) {
                    $details .= "  • {$record['target']} (Priority: {$record['pri']})\n";
                }
                
                // MX kayıtlarının güvenlik kontrolü
                $secureMX = false;
                foreach ($mxRecords as $record) {
                    if (strpos($record['target'], 'google') !== false || 
                        strpos($record['target'], 'outlook') !== false ||
                        strpos($record['target'], 'microsoft') !== false) {
                        $secureMX = true;
                        break;
                    }
                }
                
                if ($secureMX) {
                    $details .= "  ✓ Güvenli mail servisi kullanılıyor\n";
                    return ['status' => 'success', 'details' => $details];
                } else {
                    $details .= "  ⚠ Mail servisi güvenlik kontrolü önerilir\n";
                    return ['status' => 'warning', 'details' => $details];
                }
            } else {
                $details .= "⚠ MX kaydı bulunamadı\n";
                return ['status' => 'error', 'details' => $details];
            }
            
        } catch (Exception $e) {
            $details .= "⚠ MX kontrolü sırasında hata: " . $e->getMessage() . "\n";
            return ['status' => 'error', 'details' => $details];
        }
    }
    
    private function checkReverseDNS() {
        $details = "🔍 Reverse DNS (PTR) Kontrolü:\n";
        
        try {
            $ip = gethostbyname($this->target);
            
            if ($ip && $ip !== $this->target) {
                $ptrRecord = gethostbyaddr($ip);
                
                if ($ptrRecord && $ptrRecord !== $ip) {
                    $details .= "✓ PTR kaydı bulundu: {$ptrRecord}\n";
                    
                    // PTR kaydının domain ile uyumluluğu
                    if (strpos($ptrRecord, $this->target) !== false) {
                        $details .= "  ✓ PTR kaydı domain ile uyumlu\n";
                        return ['status' => 'success', 'details' => $details];
                    } else {
                        $details .= "  ⚠ PTR kaydı domain ile uyumlu değil\n";
                        return ['status' => 'warning', 'details' => $details];
                    }
                } else {
                    $details .= "⚠ PTR kaydı bulunamadı\n";
                    return ['status' => 'error', 'details' => $details];
                }
            } else {
                $details .= "⚠ IP adresi çözümlenemedi\n";
                return ['status' => 'error', 'details' => $details];
            }
            
        } catch (Exception $e) {
            $details .= "⚠ Reverse DNS kontrolü sırasında hata: " . $e->getMessage() . "\n";
            return ['status' => 'error', 'details' => $details];
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
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Sadece GET istekleri kabul edilir');
    }

    $target = $_GET['target'] ?? '';
    $port = $_GET['port'] ?? null;
    $checks = $_GET['checks'] ?? [];

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