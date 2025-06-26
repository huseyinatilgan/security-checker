<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Güvenlik Kontrol Aracı</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .loading {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-6 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i data-feather="shield" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Güvenlik Kontrol Aracı</h1>
                        <p class="text-blue-100">Domain ve IP güvenlik analizi</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <span class="text-blue-100">🔒 Güvenli Analiz</span>
                    <span class="text-blue-100">⚡ Hızlı Sonuç</span>
                    <a href="#api" 
                       onclick="showApiInfo()" 
                       class="text-blue-100 hover:text-white transition-colors duration-200 flex items-center space-x-1 cursor-pointer">
                        <i data-feather="code" class="w-4 h-4"></i>
                        <span>API</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Input Form -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8 card-hover">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i data-feather="search" class="w-6 h-6 mr-3 text-blue-600"></i>
                    Güvenlik Analizi Başlat
                </h2>
                
                <form id="securityForm" class="space-y-6">
                    <div>
                        <label for="target" class="block text-sm font-medium text-gray-700 mb-2">
                            Hedef Domain veya IP Adresi
                        </label>
                        <div class="flex space-x-4">
                            <input type="text" 
                                   id="target" 
                                   name="target" 
                                   placeholder="örn: example.com veya 192.168.1.1" 
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   required>
                            <input type="text" 
                                   id="port" 
                                   name="port" 
                                   placeholder="Port (opsiyonel)" 
                                   class="w-32 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            IP adresi için port belirtmek isterseniz, port alanını kullanabilirsiniz.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="checks[]" value="dns" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">DNS Güvenliği</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="checks[]" value="ssl" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">SSL/TLS</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="checks[]" value="headers" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">HTTP Headers</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="checks[]" value="ports" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">Port Tarama</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="checks[]" value="whois" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">WHOIS Bilgisi</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="checks[]" value="blacklist" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">Kara Liste</span>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                        <i data-feather="play" class="w-5 h-5"></i>
                        <span>Güvenlik Analizi Başlat</span>
                    </button>
                </form>
            </div>

            <!-- Loading State -->
            <div id="loading" class="hidden bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="loading">
                        <i data-feather="loader" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Analiz yapılıyor...</h3>
                        <p class="text-gray-600">Lütfen bekleyin, güvenlik kontrolleri gerçekleştiriliyor.</p>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div id="results" class="hidden space-y-6">
                <!-- Summary Card -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i data-feather="bar-chart-2" class="w-6 h-6 mr-3 text-blue-600"></i>
                            Analiz Özeti
                        </h3>
                        <button onclick="toggleRawJson()" 
                                class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                            <i data-feather="code" class="w-4 h-4"></i>
                            <span id="rawJsonButtonText">RAW JSON Göster</span>
                        </button>
                    </div>
                    <div id="summary" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Summary will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Raw JSON Output -->
                <div id="rawJsonOutput" class="hidden bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i data-feather="file-text" class="w-6 h-6 mr-3 text-green-600"></i>
                            RAW JSON Çıktısı
                        </h3>
                        <button onclick="copyRawJson()" 
                                class="flex items-center space-x-2 px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition-colors duration-200"
                                title="JSON'i Kopyala">
                            <i data-feather="copy" class="w-4 h-4"></i>
                            <span>Kopyala</span>
                        </button>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <pre id="rawJsonContent" class="text-green-400 text-sm overflow-x-auto whitespace-pre-wrap"></pre>
                    </div>
                </div>

                <!-- Detailed Results -->
                <div id="detailedResults" class="space-y-4">
                    <!-- Results will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </main>

    <!-- API Info Modal -->
    <div id="apiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i data-feather="code" class="w-6 h-6 mr-3 text-blue-600"></i>
                        API Dokümantasyonu
                    </h3>
                    <button onclick="hideApiInfo()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i data-feather="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- API Endpoint -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">API Endpoint</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <code class="text-sm text-blue-600">POST /api.php</code>
                    </div>
                </div>

                <!-- Rate Limiting -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Rate Limiting</h4>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i data-feather="clock" class="w-5 h-5 text-yellow-600 mr-3 mt-0.5"></i>
                            <div>
                                <p class="font-medium text-yellow-800">İstek Sınırı</p>
                                <p class="text-yellow-700 text-sm mt-1">
                                    Dakikada maksimum <strong>20 istek</strong> gönderilebilir. API kullanımında bu sınırı göz önünde bulundurun.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Request Parameters -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">İstek Parametreleri</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium text-gray-700">target</span>
                                <span class="text-red-500">*</span>
                                <span class="text-gray-600">- Domain veya IP adresi (zorunlu)</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">port</span>
                                <span class="text-gray-600">- Port numarası (opsiyonel)</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">checks[]</span>
                                <span class="text-gray-600">- Kontrol türleri (opsiyonel, varsayılan: dns, ssl, headers, ports)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Checks -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Mevcut Kontroller</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">dns</span>
                            <span class="text-gray-600 text-sm">- DNS güvenlik kontrolü</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">ssl</span>
                            <span class="text-gray-600 text-sm">- SSL/TLS kontrolü</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">headers</span>
                            <span class="text-gray-600 text-sm">- HTTP güvenlik headers</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">ports</span>
                            <span class="text-gray-600 text-sm">- Port tarama</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">whois</span>
                            <span class="text-gray-600 text-sm">- WHOIS bilgisi</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">blacklist</span>
                            <span class="text-gray-600 text-sm">- Kara liste kontrolü</span>
                        </div>
                    </div>
                </div>

                <!-- Example Request -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Örnek İstek</h4>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-green-400 text-sm">cURL</span>
                            <button onclick="copyToClipboard(this)" 
                                    class="text-gray-400 hover:text-gray-200 transition-colors"
                                    title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-green-400 text-sm overflow-x-auto" data-content="curl -X POST https://yourdomain.com/api.php \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'target=google.com&checks[]=dns&checks[]=ssl&checks[]=headers'

# Not: Rate limiting - dakikada maksimum 20 istek">curl -X POST https://yourdomain.com/api.php \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'target=google.com&checks[]=dns&checks[]=ssl&checks[]=headers'

# Not: Rate limiting - dakikada maksimum 20 istek</pre>
                    </div>
                </div>

                <!-- Example Response -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Örnek Yanıt</h4>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-blue-400 text-sm">JSON Response (Web Arayüzü)</span>
                            <button onclick="copyToClipboard(this)" 
                                    class="text-gray-400 hover:text-gray-200 transition-colors"
                                    title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-blue-400 text-sm overflow-x-auto" data-content='{
  "summary": {
    "passed": 2,
    "warnings": 1,
    "failed": 0,
    "total": 3
  },
  "results": [
    {
      "title": "DNS Güvenlik Kontrolü",
      "description": "DNS kayıtları ve güvenlik ayarları kontrol ediliyor",
      "status": "success",
      "details": "DNS Kontrol Sonuçları:\n\n✓ A Kaydı bulundu\n  IP: 142.250.185.78\n✓ MX Kaydı bulundu\n  Mail Server: smtp.google.com (Priority: 10)\n✓ SPF Kaydı bulundu: v=spf1 include:_spf.google.com ~all\n✓ DMARC Kaydı bulundu: v=DMARC1; p=quarantine; rua=mailto:dmarc@google.com\n✓ NS Kaydı bulundu\n  Name Server: ns1.google.com"
    }
  ]
}'>{
  "summary": {
    "passed": 2,
    "warnings": 1,
    "failed": 0,
    "total": 3
  },
  "results": [
    {
      "title": "DNS Güvenlik Kontrolü",
      "description": "DNS kayıtları ve güvenlik ayarları kontrol ediliyor",
      "status": "success",
      "details": "DNS Kontrol Sonuçları:\n\n✓ A Kaydı bulundu\n  IP: 142.250.185.78\n✓ MX Kaydı bulundu\n  Mail Server: smtp.google.com (Priority: 10)\n✓ SPF Kaydı bulundu: v=spf1 include:_spf.google.com ~all\n✓ DMARC Kaydı bulundu: v=DMARC1; p=quarantine; rua=mailto:dmarc@google.com\n✓ NS Kaydı bulundu\n  Name Server: ns1.google.com"
    }
  ]
}</pre>
                    </div>
                    
                    <div class="mt-4 bg-gray-900 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-green-400 text-sm">JSON Response (API Endpoint)</span>
                            <button onclick="copyToClipboard(this)" 
                                    class="text-gray-400 hover:text-gray-200 transition-colors"
                                    title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-green-400 text-sm overflow-x-auto" data-content='{
  "success": true,
  "timestamp": "2024-01-15 14:30:25",
  "request": {
    "target": "google.com",
    "port": null,
    "checks": ["dns", "ssl", "headers"]
  },
  "data": {
    "summary": {
      "passed": 2,
      "warnings": 1,
      "failed": 0,
      "total": 3
    },
    "results": [
      {
        "title": "DNS Güvenlik Kontrolü",
        "description": "DNS kayıtları ve güvenlik ayarları kontrol ediliyor",
        "status": "success",
        "details": "DNS Kontrol Sonuçları:\n\n✓ A Kaydı bulundu\n  IP: 142.250.185.78\n✓ MX Kaydı bulundu\n  Mail Server: smtp.google.com (Priority: 10)\n✓ SPF Kaydı bulundu: v=spf1 include:_spf.google.com ~all\n✓ DMARC Kaydı bulundu: v=DMARC1; p=quarantine; rua=mailto:dmarc@google.com\n✓ NS Kaydı bulundu\n  Name Server: ns1.google.com"
      }
    ]
  }
}'>{
  "success": true,
  "timestamp": "2024-01-15 14:30:25",
  "request": {
    "target": "google.com",
    "port": null,
    "checks": ["dns", "ssl", "headers"]
  },
  "data": {
    "summary": {
      "passed": 2,
      "warnings": 1,
      "failed": 0,
      "total": 3
    },
    "results": [
      {
        "title": "DNS Güvenlik Kontrolü",
        "description": "DNS kayıtları ve güvenlik ayarları kontrol ediliyor",
        "status": "success",
        "details": "DNS Kontrol Sonuçları:\n\n✓ A Kaydı bulundu\n  IP: 142.250.185.78\n✓ MX Kaydı bulundu\n  Mail Server: smtp.google.com (Priority: 10)\n✓ SPF Kaydı bulundu: v=spf1 include:_spf.google.com ~all\n✓ DMARC Kaydı bulundu: v=DMARC1; p=quarantine; rua=mailto:dmarc@google.com\n✓ NS Kaydı bulundu\n  Name Server: ns1.google.com"
      }
    ]
  }
}</pre>
                    </div>
                </div>

                <!-- Status Codes -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">HTTP Durum Kodları</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <span class="font-medium text-green-700">200 OK</span>
                            <span class="text-green-600 text-sm">- Başarılı istek</span>
                        </div>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                            <span class="font-medium text-red-700">400 Bad Request</span>
                            <span class="text-red-600 text-sm">- Geçersiz parametreler</span>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <span class="font-medium text-yellow-700">429 Too Many Requests</span>
                            <span class="text-yellow-600 text-sm">- Rate limit aşıldı (20 istek/dakika)</span>
                        </div>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                            <span class="font-medium text-red-700">401 Unauthorized</span>
                            <span class="text-red-600 text-sm">- Geçersiz API anahtarı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <p class="text-gray-400 mb-4">
                    🔒 Güvenlik Kontrol Aracı - Profesyonel güvenlik analizi için geliştirilmiştir
                </p>
                <div class="flex justify-center space-x-6 text-sm">
                    <a href="privacy.php" class="text-gray-400 hover:text-white transition-colors duration-200">
                        📄 Veri Gizliliği
                    </a>
                    <span class="text-gray-600">|</span>
                    <a href="mailto:privacy@guvendeyimdir.com" class="text-gray-400 hover:text-white transition-colors duration-200">
                        📧 İletişim
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Feather icons
        feather.replace();

        // Global değişkenler
        let currentRawData = null;

        // Form submission
        document.getElementById('securityForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const target = formData.get('target');
            const port = formData.get('port');
            const checks = formData.getAll('checks[]');

            if (!target.trim()) {
                alert('Lütfen bir hedef girin!');
                return;
            }

            // Show loading
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('results').classList.add('hidden');
            document.getElementById('rawJsonOutput').classList.add('hidden');

            try {
                const response = await fetch('security_check.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                
                // Hide loading
                document.getElementById('loading').classList.add('hidden');
                
                // Store raw data
                currentRawData = result;
                
                // Show results
                displayResults(result);
                document.getElementById('results').classList.remove('hidden');
                
            } catch (error) {
                console.error('Hata:', error);
                alert('Analiz sırasında bir hata oluştu!');
                document.getElementById('loading').classList.add('hidden');
            }
        });

        function displayResults(data) {
            // Display summary
            const summary = document.getElementById('summary');
            summary.innerHTML = `
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-green-600">${data.summary.passed}</div>
                    <div class="text-sm text-green-700">Başarılı Test</div>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-yellow-600">${data.summary.warnings}</div>
                    <div class="text-sm text-yellow-700">Uyarı</div>
                </div>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-red-600">${data.summary.failed}</div>
                    <div class="text-sm text-red-700">Başarısız Test</div>
                </div>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-blue-600">${data.summary.total}</div>
                    <div class="text-sm text-blue-700">Toplam Test</div>
                </div>
            `;

            // Display raw JSON
            const rawJsonContent = document.getElementById('rawJsonContent');
            rawJsonContent.textContent = JSON.stringify(data, null, 2);

            // Display detailed results
            const detailedResults = document.getElementById('detailedResults');
            detailedResults.innerHTML = '';

            data.results.forEach(result => {
                const statusColor = result.status === 'success' ? 'green' : 
                                  result.status === 'warning' ? 'yellow' : 'red';
                const statusIcon = result.status === 'success' ? 'check-circle' : 
                                 result.status === 'warning' ? 'alert-triangle' : 'x-circle';

                const resultCard = document.createElement('div');
                resultCard.className = 'bg-white rounded-xl shadow-lg p-6 card-hover';
                resultCard.innerHTML = `
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-${statusColor}-100 rounded-lg flex items-center justify-center">
                                <i data-feather="${statusIcon}" class="w-5 h-5 text-${statusColor}-600"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">${result.title}</h4>
                                <p class="text-sm text-gray-600">${result.description}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-${statusColor}-100 text-${statusColor}-800">
                            ${result.status === 'success' ? 'Başarılı' : 
                              result.status === 'warning' ? 'Uyarı' : 'Başarısız'}
                        </span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Detaylar</span>
                            <button onclick="copyToClipboard(this)" 
                                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded"
                                    title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-sm text-gray-700 whitespace-pre-wrap" data-content="${result.details}">${result.details}</pre>
                    </div>
                `;
                detailedResults.appendChild(resultCard);
            });

            // Re-initialize Feather icons
            feather.replace();
        }

        // Kopyalama fonksiyonu
        function copyToClipboard(button) {
            const preElement = button.closest('.bg-gray-50').querySelector('pre');
            const content = preElement.getAttribute('data-content') || preElement.textContent;
            
            // Modern clipboard API kullan
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(content).then(() => {
                    showCopySuccess(button);
                }).catch(err => {
                    console.error('Kopyalama başarısız:', err);
                    fallbackCopyTextToClipboard(content, button);
                });
            } else {
                // Fallback için eski yöntem
                fallbackCopyTextToClipboard(content, button);
            }
        }

        // Fallback kopyalama fonksiyonu
        function fallbackCopyTextToClipboard(text, button) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    showCopySuccess(button);
                } else {
                    showCopyError(button);
                }
            } catch (err) {
                console.error('Fallback kopyalama başarısız:', err);
                showCopyError(button);
            }
            
            document.body.removeChild(textArea);
        }

        // Kopyalama başarı animasyonu
        function showCopySuccess(button) {
            const icon = button.querySelector('i');
            const originalIcon = icon.getAttribute('data-feather');
            
            // İkonu geçici olarak değiştir
            icon.setAttribute('data-feather', 'check');
            feather.replace();
            
            // Buton rengini değiştir
            button.classList.remove('text-gray-400', 'hover:text-gray-600');
            button.classList.add('text-green-500');
            
            // Tooltip göster
            button.setAttribute('title', 'Kopyalandı!');
            
            // 2 saniye sonra geri al
            setTimeout(() => {
                icon.setAttribute('data-feather', originalIcon);
                feather.replace();
                button.classList.remove('text-green-500');
                button.classList.add('text-gray-400', 'hover:text-gray-600');
                button.setAttribute('title', 'Kopyala');
            }, 2000);
        }

        // Kopyalama hata animasyonu
        function showCopyError(button) {
            const icon = button.querySelector('i');
            const originalIcon = icon.getAttribute('data-feather');
            
            // İkonu geçici olarak değiştir
            icon.setAttribute('data-feather', 'x');
            feather.replace();
            
            // Buton rengini değiştir
            button.classList.remove('text-gray-400', 'hover:text-gray-600');
            button.classList.add('text-red-500');
            
            // Tooltip göster
            button.setAttribute('title', 'Kopyalama başarısız!');
            
            // 2 saniye sonra geri al
            setTimeout(() => {
                icon.setAttribute('data-feather', originalIcon);
                feather.replace();
                button.classList.remove('text-red-500');
                button.classList.add('text-gray-400', 'hover:text-gray-600');
                button.setAttribute('title', 'Kopyala');
            }, 2000);
        }

        // API Modal fonksiyonları
        function showApiInfo() {
            document.getElementById('apiModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Scroll'u engelle
            feather.replace();
        }

        function hideApiInfo() {
            document.getElementById('apiModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Scroll'u geri aç
        }

        // Modal dışına tıklayınca kapat
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('apiModal');
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    hideApiInfo();
                }
            });

            // ESC tuşu ile kapat
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    hideApiInfo();
                }
            });
        });

        // RAW JSON toggle fonksiyonu
        function toggleRawJson() {
            const rawJsonOutput = document.getElementById('rawJsonOutput');
            const buttonText = document.getElementById('rawJsonButtonText');
            
            if (rawJsonOutput.classList.contains('hidden')) {
                rawJsonOutput.classList.remove('hidden');
                buttonText.textContent = 'RAW JSON Gizle';
            } else {
                rawJsonOutput.classList.add('hidden');
                buttonText.textContent = 'RAW JSON Göster';
            }
        }

        // RAW JSON kopyalama fonksiyonu
        function copyRawJson() {
            const rawJsonContent = document.getElementById('rawJsonContent');
            const content = rawJsonContent.textContent || rawJsonContent.innerText;
            
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(content).then(() => {
                    showCopySuccess(document.querySelector('[onclick="copyRawJson()"]'));
                }).catch(err => {
                    console.error('Kopyalama başarısız:', err);
                    fallbackCopyTextToClipboard(content, document.querySelector('[onclick="copyRawJson()"]'));
                });
            } else {
                fallbackCopyTextToClipboard(content, document.querySelector('[onclick="copyRawJson()"]'));
            }
        }
    </script>
</body>
</html>