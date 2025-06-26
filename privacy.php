<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veri Gizliliği - Güvenlik Tarama</title>
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
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-6 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="index.php" class="flex items-center space-x-3 hover:opacity-80 transition-opacity">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i data-feather="shield" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">Güvenlik Tarama</h1>
                            <p class="text-blue-100">Domain ve IP güvenlik analizi</p>
                        </div>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="index.php" class="text-blue-100 hover:text-white transition-colors">Ana Sayfa</a>
                    <span class="text-blue-100">📄 Veri Gizliliği</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8 card-hover">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i data-feather="lock" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Veri Gizliliği Politikası</h1>
                        <p class="text-gray-600">Son güncelleme: <?php echo date('d.m.Y'); ?></p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    Bu veri gizliliği politikası, Güvenlik Tarama'nın kullanımı sırasında toplanan bilgilerin nasıl işlendiğini açıklar. 
                    Hizmetimizi kullanarak bu politikayı kabul etmiş sayılırsınız.
                </p>
            </div>

            <!-- Privacy Sections -->
            <div class="space-y-6">
                <!-- Data Collection -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="database" class="w-6 h-6 mr-3 text-blue-600"></i>
                        Veri Toplama
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>
                            Güvenlik Tarama, aşağıdaki bilgileri toplar ve işler:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li><strong>Girilen hedef bilgileri:</strong> Domain adları ve IP adresleri</li>
                            <li><strong>Teknik veriler:</strong> Tarayıcı bilgileri, IP adresiniz, istek zamanı</li>
                            <li><strong>Kullanım verileri:</strong> Hangi kontrollerin seçildiği, sonuçlar</li>
                        </ul>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-4">
                            <div class="flex items-start">
                                <i data-feather="alert-triangle" class="w-5 h-5 text-yellow-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="font-medium text-yellow-800">Önemli Not</p>
                                    <p class="text-yellow-700 text-sm mt-1">
                                        Girilen domain ve IP adresleri sadece güvenlik analizi için kullanılır ve kalıcı olarak saklanmaz.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Usage -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="activity" class="w-6 h-6 mr-3 text-blue-600"></i>
                        Veri Kullanımı
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Toplanan veriler aşağıdaki amaçlarla kullanılır:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Güvenlik analizi ve raporlama</li>
                            <li>Hizmet kalitesinin iyileştirilmesi</li>
                            <li>Teknik sorunların giderilmesi</li>
                            <li>Güvenlik ihlallerinin önlenmesi</li>
                        </ul>
                    </div>
                </div>

                <!-- Data Storage -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="hard-drive" class="w-6 h-6 mr-3 text-blue-600"></i>
                        Veri Saklama
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="font-medium text-green-800">Veri Saklanmaz</p>
                                    <p class="text-green-700 text-sm mt-1">
                                        Analiz sonuçları ve girilen bilgiler kalıcı olarak saklanmaz. 
                                        Tüm veriler işlem tamamlandıktan sonra otomatik olarak silinir.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p>
                            Sadece geçici log dosyaları, hizmet kalitesini iyileştirmek amacıyla 
                            maksimum 30 gün süreyle saklanabilir.
                        </p>
                    </div>
                </div>

                <!-- Data Sharing -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="share-2" class="w-6 h-6 mr-3 text-blue-600"></i>
                        Veri Paylaşımı
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Kişisel verileriniz üçüncü taraflarla paylaşılmaz, ancak:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Yasal zorunluluk durumunda yetkili makamlarla paylaşılabilir</li>
                            <li>Hizmet sağlayıcılarımızla sadece teknik amaçlarla paylaşılır</li>
                            <li>Kullanıcı onayı olmadan ticari amaçlarla kullanılmaz</li>
                        </ul>
                    </div>
                </div>

                <!-- User Rights -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="user-check" class="w-6 h-6 mr-3 text-blue-600"></i>
                        Kullanıcı Hakları
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>KVKK kapsamında aşağıdaki haklara sahipsiniz:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Kişisel verilerinizin işlenip işlenmediğini öğrenme</li>
                            <li>Kişisel verileriniz işlenmişse buna ilişkin bilgi talep etme</li>
                            <li>Kişisel verilerinizin işlenme amacını ve bunların amacına uygun kullanılıp kullanılmadığını öğrenme</li>
                            <li>Yurt içinde veya yurt dışında kişisel verilerinizin aktarıldığı üçüncü kişileri bilme</li>
                        </ul>
                    </div>
                </div>

                <!-- Disclaimer -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="alert-octagon" class="w-6 h-6 mr-3 text-red-600"></i>
                        Sorumluluk Reddi
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i data-feather="alert-triangle" class="w-5 h-5 text-red-600 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="font-medium text-red-800">Önemli Uyarı</p>
                                    <p class="text-red-700 text-sm mt-1">
                                        Bu araç sadece eğitim ve test amaçlıdır. Sonuçlar garanti edilmez ve 
                                        herhangi bir zarardan sorumluluk kabul edilmez.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Hizmet "olduğu gibi" sunulur, hiçbir garanti verilmez</li>
                            <li>Analiz sonuçları %100 doğru olmayabilir</li>
                            <li>Bu araçla yapılan işlemlerden doğacak zararlardan sorumluluk kabul edilmez</li>
                            <li>Üretim ortamında kullanmadan önce kapsamlı test yapılması önerilir</li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-feather="mail" class="w-6 h-6 mr-3 text-blue-600"></i>
                        İletişim
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>
                            Veri gizliliği ile ilgili sorularınız veya endişeleriniz için bizimle iletişime geçebilirsiniz:
                        </p>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i data-feather="mail" class="w-5 h-5 text-blue-600 mr-3"></i>
                                <div>
                                    <p class="font-medium text-blue-800">E-posta</p>
                                    <a href="mailto:privacy@guvendeyimdir.com" class="text-blue-600 hover:text-blue-800 transition-colors">
                                        privacy@guvendeyimdir.com
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">
                            E-posta gönderdiğinizde, en kısa sürede size dönüş yapacağız.
                        </p>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="text-center pt-8">
                    <a href="index.php" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                        <i data-feather="arrow-left" class="w-5 h-5 mr-2"></i>
                        Ana Sayfaya Dön
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-400">
                🔒 Güvenlik Kontrol Aracı - Ticari kullanım için değildir. Sonuçlar kesin olmayabilir.
            </p>
        </div>
    </footer>

    <script>
        // Initialize Feather icons
        feather.replace();
    </script>
</body>
</html> 