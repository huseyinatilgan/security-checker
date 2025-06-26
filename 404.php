<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>Sayfa Bulunamadı - 404 | Güvenlik Tarama</title>
    <meta name="description" content="Aradığınız sayfa bulunamadı. Güvenlik tarama aracımızı kullanarak domain ve IP güvenlik analizi yapabilirsiniz.">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://guvenliktarama.com/404.php">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Sayfa Bulunamadı - 404">
    <meta property="og:description" content="Aradığınız sayfa bulunamadı. Güvenlik tarama aracımızı kullanın.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://guvenliktarama.com/404.php">
    
    <!-- CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-6 py-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                    <i data-feather="shield" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Güvenlik Tarama</h1>
                    <p class="text-blue-100">Güvenlik Kontrol Araçları</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <!-- 404 Icon -->
            <div class="mb-8">
                <div class="w-32 h-32 mx-auto bg-red-100 rounded-full flex items-center justify-center">
                    <i data-feather="alert-triangle" class="w-16 h-16 text-red-600"></i>
                </div>
            </div>

            <!-- Error Message -->
            <h2 class="text-4xl font-bold text-gray-800 mb-4">404</h2>
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Sayfa Bulunamadı</h3>
            <p class="text-gray-600 mb-8 text-lg">
                Aradığınız sayfa mevcut değil veya taşınmış olabilir. 
                Ana sayfaya dönerek güvenlik kontrol aracımızı kullanabilirsiniz.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/" 
                   class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-8 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span>Ana Sayfaya Dön</span>
                </a>
                <a href="/#api" 
                   onclick="if(window.parent && window.parent.showApiInfo) { window.parent.showApiInfo(); return false; }"
                   class="bg-gray-100 text-gray-700 font-semibold py-3 px-8 rounded-lg hover:bg-gray-200 transition-all duration-300 flex items-center justify-center space-x-2">
                    <i data-feather="code" class="w-5 h-5"></i>
                    <span>API Dokümantasyonu</span>
                </a>
            </div>

            <!-- Popular Pages -->
            <div class="mt-12">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Diğer Sayfalar</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="/" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 text-left">
                        <div class="flex items-center space-x-3">
                            <i data-feather="shield" class="w-6 h-6 text-blue-600"></i>
                            <div>
                                <h5 class="font-semibold text-gray-800">Güvenlik Kontrol Aracı</h5>
                                <p class="text-sm text-gray-600">Domain ve IP güvenlik analizi</p>
                            </div>
                        </div>
                    </a>
                    <a href="/privacy.php" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 text-left">
                        <div class="flex items-center space-x-3">
                            <i data-feather="file-text" class="w-6 h-6 text-green-600"></i>
                            <div>
                                <h5 class="font-semibold text-gray-800">Gizlilik Politikası</h5>
                                <p class="text-sm text-gray-600">Veri koruma ve gizlilik</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-400 mb-4">
                🔒 Güvenlik Kontrol Aracı - Ticari kullanım için değildir.
            </p>
            <div class="flex justify-center space-x-6 text-sm">
                <a href="/" class="text-gray-400 hover:text-white transition-colors duration-200">
                    Ana Sayfa
                </a>
                <span class="text-gray-600">|</span>
                <a href="/privacy.php" class="text-gray-400 hover:text-white transition-colors duration-200">
                    Gizlilik Politikası
                </a>
                <span class="text-gray-600">|</span>
                <a href="mailto:info@guvenliktarama.com" class="text-gray-400 hover:text-white transition-colors duration-200">
                    İletişim
                </a>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Feather icons
        feather.replace();
    </script>
</body>
</html> 