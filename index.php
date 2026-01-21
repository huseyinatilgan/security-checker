<?php require_once 'bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>Güvenlik Kontrol Aracı - Domain ve IP Güvenlik Analizi | guvenliktarama.com</title>
    <meta name="title" content="Güvenlik Kontrol Aracı - Domain ve IP Güvenlik Analizi | guvenliktarama.com">
    <meta name="description"
        content="Ücretsiz domain ve IP adresi güvenlik kontrol aracı. DNS, SSL/TLS, HTTP headers, port tarama, e-posta güvenliği ve kara liste kontrollerini gerçekleştirin. Güvenlik zaafiyetlerini tespit edin.">
    <meta name="keywords"
        content="güvenlik kontrol, domain güvenliği, IP güvenliği, SSL kontrol, DNS güvenliği, port tarama, güvenlik analizi, web güvenliği, siber güvenlik, güvenlik testi">
    <meta name="author" content="Güvenlik Tarama">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="language" content="Turkish">
    <meta name="revisit-after" content="7 days">
    <meta name="distribution" content="global">
    <meta name="rating" content="general">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.guvenliktarama.com/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.guvenliktarama.com/">
    <meta property="og:title" content="Güvenlik Tarama - Domain ve IP Güvenlik Analizi">
    <meta property="og:description"
        content="Ücretsiz domain ve IP adresi güvenlik kontrol aracı. DNS, SSL/TLS, HTTP headers, port tarama ve güvenlik kontrollerini gerçekleştirin.">
    <meta property="og:image" content="https://www.guvenliktarama.com/images/security-checker-og.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Güvenlik Tarama - Güvenlik Analizi">
    <meta property="og:site_name" content="Güvenlik Tarama">
    <meta property="og:locale" content="tr_TR">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.guvenliktarama.com/">
    <meta property="twitter:title" content="Güvenlik Tarama - Domain ve IP Güvenlik Analizi">
    <meta property="twitter:description"
        content="Ücretsiz domain ve IP adresi güvenlik kontrol aracı. Güvenlik zaafiyetlerini tespit edin.">
    <meta property="twitter:image" content="https://www.guvenliktarama.com/images/security-checker-twitter.jpg">
    <meta property="twitter:image:alt" content="Güvenlik Tarama">

    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#667eea">
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Güvenlik Kontrol">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://unpkg.com">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Güvenlik Tarama",
        "description": "Ücretsiz domain ve IP adresi güvenlik kontrol aracı. DNS, SSL/TLS, HTTP headers, port tarama ve güvenlik kontrollerini gerçekleştirin.",
        "url": "https://www.guvenliktarama.com/",
        "applicationCategory": "SecurityApplication",
        "operatingSystem": "Web Browser",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "TRY"
        },
        "author": {
            "@type": "Organization",
            "name": "Güvenlik Tarama",
            "url": "https://www.guvenliktarama.com/"
        },
        "creator": {
            "@type": "Organization",
            "name": "Güvenlik Tarama"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Güvenlik Tarama",
            "url": "https://www.guvenliktarama.com/"
        },
        "datePublished": "2024-01-15",
        "dateModified": "2024-01-15",
        "inLanguage": "tr-TR",
        "isAccessibleForFree": true,
        "featureList": [
            "DNS Güvenlik Kontrolü",
            "SSL/TLS Sertifika Analizi",
            "HTTP Güvenlik Headers",
            "Port Tarama",
            "E-posta Güvenlik Kontrolü",
            "Kara Liste Kontrolü"
        ],
        "screenshot": "https://www.guvenliktarama.com/images/security-checker-screenshot.jpg",
        "softwareVersion": "1.0.0"
    }
    </script>

    <!-- Additional Structured Data for Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Güvenlik Tarama",
        "url": "https://www.guvenliktarama.com/",
        "logo": "https://www.guvenliktarama.com/images/logo.png",
        "description": "Güvenlik kontrol araçları ve siber güvenlik çözümleri",
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "email": "info@guvenliktarama.com"
        },
        "sameAs": [
            "https://www.guvenliktarama.com"
        ]
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-slate-50 text-slate-900 font-sans antialiased;
            }
            h1, h2, h3, h4 {
                @apply font-display;
            }
        }
        @layer components {
            .glass-card {
                @apply bg-white/80 backdrop-blur-md border border-white/20 shadow-xl;
            }
            .glass-header {
                @apply sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-slate-200;
            }
            .btn-primary {
                @apply bg-brand-600 hover:bg-brand-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg shadow-brand-500/20 active:scale-[0.98];
            }
            .input-field {
                @apply w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all outline-none;
            }
            .nav-link {
                @apply px-4 py-2 text-slate-600 hover:text-brand-600 font-medium transition-colors;
            }
        }
        .loading-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6JMFXNNE2Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-6JMFXNNE2Q');
    </script>
</head>

<body class="bg-slate-50 min-h-screen font-sans selection:bg-brand-100 selection:text-brand-900">
    <!-- Header -->
    <header class="glass-header" role="banner" aria-label="Site başlığı">
        <div class="container mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3 group cursor-pointer" onclick="window.location.href='/'">
                <div class="w-10 h-10 bg-brand-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:bg-brand-700 transition-all duration-300"
                    aria-hidden="true">
                    <i data-feather="shield" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-950">Güvenlik<span
                            class="text-brand-600">Tarama</span></h1>
                    <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 -mt-1">Enterprise Guard</p>
                </div>
            </div>

            <nav class="flex items-center space-x-2" role="navigation" aria-label="Ana navigasyon">
                <a href="#api" onclick="showApiInfo()" class="nav-link flex items-center space-x-2"
                    aria-label="API dokümantasyonunu göster">
                    <i data-feather="code" class="w-4 h-4" aria-hidden="true"></i>
                    <span>API</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12" role="main">
        <!-- Hero Section -->
        <section class="max-w-4xl mx-auto text-center mb-16 px-4">
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">
                Altyapınızı <span class="text-brand-600">Saniyeler İçinde</span> Denetleyin
            </h2>
            <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Domain ve IP adreslerinizi DNS, SSL, Headers ve Port bazında analiz ederek
                güvenlik açıklarını profesyonel standartlarda raporlayın.
            </p>
            <div class="flex flex-wrap justify-center gap-3 text-sm font-medium">
                <span
                    class="px-3 py-1 bg-brand-50 text-brand-700 rounded-full border border-brand-100 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-brand-500 rounded-full animate-pulse"></span> DNS Analizi
                </span>
                <span
                    class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> SSL/TLS
                </span>
                <span
                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full border border-blue-100 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span> Port Scan
                </span>
            </div>
        </section>
        <!-- Page Description for SEO -->
        <section class="max-w-4xl mx-auto mb-8">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-3">Güvenlik Kontrol Aracı Hakkında</h2>
                <p class="text-blue-700 mb-3">
                    Bu ücretsiz güvenlik kontrol aracı ile domain ve IP adreslerinizin güvenlik durumunu analiz
                    edebilirsiniz.
                    DNS güvenliği, SSL/TLS sertifikaları, HTTP güvenlik başlıkları, port tarama ve daha fazlasını
                    kontrol edin.
                </p>
                <p class="text-blue-600 text-sm">
                    <strong>Desteklenen Kontroller:</strong> DNS Güvenliği, SSL/TLS Analizi, HTTP Headers, Port Tarama,
                    E-posta Güvenliği, Kara Liste Kontrolü
                </p>
            </div>
        </section>

        <!-- Input Form Section -->
        <section class="max-w-4xl mx-auto" aria-labelledby="form-heading">
            <div class="glass-card rounded-2xl p-6 md:p-10 mb-12 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 -tr-y-1/2 tr-x-1/2 w-64 h-64 bg-brand-500/5 rounded-full blur-3xl pointer-events-none transition-all group-hover:bg-brand-500/10">
                </div>

                <h2 id="form-heading" class="text-2xl font-bold text-slate-900 mb-8 flex items-center">
                    <div class="w-10 h-10 bg-brand-100 text-brand-600 rounded-lg flex items-center justify-center mr-4">
                        <i data-feather="zap" class="w-5 h-5"></i>
                    </div>
                    Yeni Analiz Başlat
                </h2>

                <form id="securityForm" class="space-y-6" role="form" aria-label="Güvenlik analizi formu">
                    <fieldset>
                        <legend class="sr-only">Analiz parametreleri</legend>

                        <div>
                            <div class="space-y-4">
                                <label for="target" class="block text-sm font-semibold text-slate-700 tracking-tight">
                                    Hedef Domain veya IP Adresi <span class="text-brand-600"
                                        aria-label="zorunlu alan">*</span>
                                </label>
                                <div class="flex flex-col md:flex-row gap-3">
                                    <div class="relative flex-1 group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i data-feather="globe" class="w-5 h-5"></i>
                                        </div>
                                        <input type="text" id="target" name="target"
                                            placeholder="örn: google.com veya 8.8.8.8" class="input-field pl-12"
                                            required aria-describedby="target-help" aria-required="true">
                                    </div>
                                    <div class="relative w-full md:w-36 group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i data-feather="hash" class="w-4 h-4"></i>
                                        </div>
                                        <input type="text" id="port" name="port" placeholder="Port"
                                            class="input-field pl-10" aria-describedby="port-help">
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                    <p id="target-help" class="text-xs text-slate-500 italic">
                                        * URL'lerden domain kısmı otomatik olarak ayrıştırılır.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <label
                                class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all select-none group has-[:checked]:border-brand-500/50 has-[:checked]:bg-brand-50/50">
                                <input type="checkbox" name="checks[]" value="dns" checked
                                    class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                                <span
                                    class="text-sm font-semibold text-slate-700 ml-3 group-has-[:checked]:text-brand-700">DNS
                                    Güvenliği</span>
                            </label>
                            <label
                                class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all select-none group has-[:checked]:border-brand-500/50 has-[:checked]:bg-brand-50/50">
                                <input type="checkbox" name="checks[]" value="ssl" checked
                                    class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                                <span
                                    class="text-sm font-semibold text-slate-700 ml-3 group-has-[:checked]:text-brand-700">SSL/TLS
                                    Analizi</span>
                            </label>
                            <label
                                class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all select-none group has-[:checked]:border-brand-500/50 has-[:checked]:bg-brand-50/50">
                                <input type="checkbox" name="checks[]" value="headers" checked
                                    class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                                <span
                                    class="text-sm font-semibold text-slate-700 ml-3 group-has-[:checked]:text-brand-700">HTTP
                                    Headers</span>
                            </label>
                            <label
                                class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all select-none group has-[:checked]:border-brand-500/50 has-[:checked]:bg-brand-50/50">
                                <input type="checkbox" name="checks[]" value="ports" checked
                                    class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                                <span
                                    class="text-sm font-semibold text-slate-700 ml-3 group-has-[:checked]:text-brand-700">Port
                                    Tarama</span>
                            </label>
                            <label
                                class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all select-none group has-[:checked]:border-brand-500/50 has-[:checked]:bg-brand-50/50">
                                <input type="checkbox" name="checks[]" value="email"
                                    class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                                <span
                                    class="text-sm font-semibold text-slate-700 ml-3 group-has-[:checked]:text-brand-700">E-posta
                                    Güvenliği</span>
                            </label>
                            <label
                                class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-all select-none group has-[:checked]:border-brand-500/50 has-[:checked]:bg-brand-50/50">
                                <input type="checkbox" name="checks[]" value="blacklist"
                                    class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                                <span
                                    class="text-sm font-semibold text-slate-700 ml-3 group-has-[:checked]:text-brand-700">Kara
                                    Liste</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="pt-4">
                        <button type="submit" class="btn-primary w-full flex items-center justify-center space-x-3"
                            aria-describedby="submit-help">
                            <i data-feather="play" class="w-5 h-5" aria-hidden="true"></i>
                            <span>Taramayı Başlat</span>
                        </button>
                        <p id="submit-help"
                            class="text-xs text-slate-500 text-center mt-4 flex items-center justify-center space-x-2">
                            <i data-feather="info" class="w-3 h-3"></i>
                            <span>Sistem kaynakları limitli şekilde kullanılmaktadır.</span>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Loading State -->
            <div id="loading"
                class="hidden glass-card rounded-2xl p-10 mb-12 shadow-brand-500/5 overflow-hidden relative"
                role="status" aria-live="polite">
                <div class="absolute inset-0 loading-shimmer opacity-30"></div>
                <div class="flex flex-col items-center justify-center text-center relative z-10 px-4">
                    <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mb-6 animate-bounce">
                        <i data-feather="loader" class="w-8 h-8 text-brand-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Güvenlik Kontrolleri Sürüyor</h3>
                    <p class="text-slate-600 max-w-sm">Seçtiğiniz parametrelere göre altyapınız derinlemesine analiz
                        ediliyor. Lütfen sayfayı kapatmayın.</p>
                </div>
            </div>

            <!-- Results -->
            <section id="results" class="hidden space-y-8" aria-labelledby="results-heading">
                <!-- Analysis Summary -->
                <div class="glass-card rounded-2xl overflow-hidden shadow-brand-500/5 transition-all duration-500">
                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center">
                            <i data-feather="terminal" class="w-5 h-5 mr-3 text-brand-600"></i>
                            Analiz Özeti
                        </h3>
                        <div class="flex items-center space-x-2">
                            <button onclick="toggleRawJson()"
                                class="flex items-center space-x-2 px-3 py-1.5 bg-white border border-slate-200 hover:border-brand-500/50 hover:bg-brand-50 text-slate-600 hover:text-brand-600 rounded-lg transition-all text-xs font-semibold">
                                <i data-feather="code" class="w-3.5 h-3.5"></i>
                                <span id="rawJsonButtonText">RAW JSON</span>
                            </button>
                        </div>
                    </div>
                    <div class="p-6 md:p-8">
                        <div id="summary" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" role="region"
                            aria-label="Analiz özeti">
                            <!-- Populated by JS -->
                        </div>
                    </div>
                </div>

                <!-- Raw JSON Output -->
                <div id="rawJsonOutput" class="hidden glass-card rounded-2xl overflow-hidden border-brand-500/30">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-900 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-slate-100 flex items-center">
                            <i data-feather="file-text" class="w-4 h-4 mr-3 text-brand-400"></i>
                            Developer Response
                        </h3>
                        <button onclick="copyRawJson()" class="text-slate-400 hover:text-white transition-colors">
                            <i data-feather="copy" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="bg-slate-950 p-6">
                        <pre id="rawJsonContent"
                            class="text-brand-300 text-xs font-mono overflow-x-auto whitespace-pre-wrap"></pre>
                    </div>
                </div>

                <!-- Detailed Results -->
                <div id="detailedResults" class="grid grid-cols-1 gap-6" role="region"
                    aria-label="Detaylı analiz sonuçları">
                    <!-- Populated by JS -->
                </div>
            </section>
        </section>
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
                        <code class="text-sm text-blue-600">GET /api.php?target=example.com&o=json</code>
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
                                    Dakikada maksimum <strong>20 istek</strong> gönderilebilir. API kullanımında bu
                                    sınırı göz önünde bulundurun.
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
                                <span class="text-gray-600">- Kontrol türleri (opsiyonel, varsayılan: dns, ssl, headers,
                                    ports)</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">o</span>
                                <span class="text-gray-600">- Çıktı formatı: <b>json</b> veya <b>text</b> (varsayılan:
                                    json)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Example Request -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Örnek GET İstekleri</h4>
                    <div class="bg-gray-900 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-green-400 text-sm">cURL (JSON)</span>
                            <button onclick="copyToClipboard(this)"
                                class="text-gray-400 hover:text-gray-200 transition-colors" title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-green-400 text-sm overflow-x-auto"
                            data-content="curl 'https://www.guvenliktarama.com/api.php?target=google.com&o=json'">
curl 'https://www.guvenliktarama.com/api.php?target=google.com&o=json'</pre>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-green-400 text-sm">cURL (TEXT)</span>
                            <button onclick="copyToClipboard(this)"
                                class="text-gray-400 hover:text-gray-200 transition-colors" title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-green-400 text-sm overflow-x-auto"
                            data-content="curl 'https://www.guvenliktarama.com/api.php?target=google.com&o=text'">
curl 'https://www.guvenliktarama.com/api.php?target=google.com&o=text'</pre>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-green-400 text-sm">Doğrudan URL (Tarayıcıda)</span>
                            <button onclick="copyToClipboard(this)"
                                class="text-gray-400 hover:text-gray-200 transition-colors" title="Kopyala">
                                <i data-feather="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <pre class="text-green-400 text-sm overflow-x-auto"
                            data-content="https://www.guvenliktarama.com/api.php?target=google.com&o=json">
https://www.guvenliktarama.com/api.php?target=google.com&o=json</pre>
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
                            <span class="font-medium text-gray-700">email</span>
                            <span class="text-gray-600 text-sm">- E-posta güvenlik kontrolü</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <span class="font-medium text-gray-700">blacklist</span>
                            <span class="text-gray-600 text-sm">- Kara liste kontrolü</span>
                        </div>
                    </div>
                </div>

                <!-- Example Response -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Örnek Yanıt</h4>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-blue-400 text-sm">JSON Response (Web Arayüzü)</span>
                            <button onclick="copyToClipboard(this)"
                                class="text-gray-400 hover:text-gray-200 transition-colors" title="Kopyala">
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
                                class="text-gray-400 hover:text-gray-200 transition-colors" title="Kopyala">
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
    <footer class="bg-slate-950 text-slate-400 py-16 mt-16 border-t border-slate-900" role="contentinfo">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 group">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-brand-600/20 text-brand-500 rounded-xl flex items-center justify-center border border-brand-500/30"
                            aria-hidden="true">
                            <i data-feather="shield" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white tracking-tight">Güvenlik<span
                                    class="text-brand-500">Tarama</span></h3>
                            <p class="text-[10px] uppercase tracking-widest font-bold text-slate-500">Secured
                                Infrastructure</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed max-w-sm mb-6">
                        Yapay zeka asistanı Antigravity tarafından stabilize edilmiş,
                        kurumsal düzeyde güvenlik tarama çözümleri. Altyapınızı bugün denetleyin.
                    </p>
                    <div class="flex space-x-4">
                        <a href="mailto:info@guvenliktarama.com"
                            class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center hover:bg-brand-600 hover:text-white transition-all text-slate-500"
                            aria-label="E-posta gönder">
                            <i data-feather="mail" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-6">Araçlar</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="/" class="hover:text-brand-400 transition-colors">OSINT Scanner</a></li>
                        <li><a href="#api" onclick="showApiInfo()"
                                class="hover:text-brand-400 transition-colors">Developer API</a></li>
                        <li><a href="privacy.php" class="hover:text-brand-400 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-slate-900 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs">© 2026 Güvenlik Tarama. Tüm hakları saklıdır.</p>
                <div class="flex items-center gap-6 text-xs font-medium">
                    <a href="privacy.php" class="hover:text-white transition-colors">Veri Gizliliği</a>
                    <a href="mailto:privacy@guvenliktarama.com" class="hover:text-white transition-colors">Destek
                        Hattı</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Feather icons
        feather.replace();

        // Global değişkenler
        let currentRawData = null;

        // Form submission with better accessibility
        document.getElementById('securityForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const target = formData.get('target');
            const port = formData.get('port');
            const checks = formData.getAll('checks[]');

            if (!target.trim()) {
                // Better error handling for accessibility
                const targetInput = document.getElementById('target');
                targetInput.setAttribute('aria-invalid', 'true');
                targetInput.focus();

                // Show error message
                showNotification('Lütfen bir hedef girin!', 'error');
                return;
            }

            // Reset aria-invalid
            document.getElementById('target').setAttribute('aria-invalid', 'false');

            // Show loading with better accessibility
            const loadingElement = document.getElementById('loading');
            const resultsElement = document.getElementById('results');
            const rawJsonElement = document.getElementById('rawJsonOutput');

            loadingElement.classList.remove('hidden');
            resultsElement.classList.add('hidden');
            rawJsonElement.classList.add('hidden');

            // Announce loading to screen readers
            announceToScreenReader('Güvenlik analizi başlatılıyor, lütfen bekleyin.');

            try {
                // Form verilerini URL parametrelerine çevir
                const params = new URLSearchParams();
                params.append('target', target);
                if (port) params.append('port', port);
                checks.forEach(check => params.append('checks[]', check));

                const response = await fetch(`api.php?${params.toString()}`, {
                    method: 'GET'
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                const data = result.data; // api.php wraps response in 'data'

                // Hide loading
                loadingElement.classList.add('hidden');

                // Store raw data
                currentRawData = data;

                // Show results
                displayResults(data);
                resultsElement.classList.remove('hidden');

                // Announce results to screen readers
                announceToScreenReader(`Analiz tamamlandı. ${data.summary.passed} başarılı, ${data.summary.warnings} uyarı, ${data.summary.failed} başarısız test.`);

            } catch (error) {
                console.error('Hata:', error);
                showNotification('Analiz sırasında bir hata oluştu!', 'error');
                loadingElement.classList.add('hidden');
                announceToScreenReader('Analiz sırasında bir hata oluştu.');
            }
        });

        function displayResults(data) {
            // Display summary with better accessibility
            const summary = document.getElementById('summary');
            summary.innerHTML = `
                <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-5 text-center group hover:bg-emerald-100/50 transition-all duration-300" role="region" aria-label="Başarılı testler">
                    <div class="text-3xl font-extrabold text-emerald-600 mb-1 group-hover:scale-110 transition-transform">${data.summary.passed}</div>
                    <div class="text-[10px] uppercase tracking-widest font-bold text-emerald-700/70">Güvenli</div>
                </div>
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-5 text-center group hover:bg-amber-100/50 transition-all duration-300" role="region" aria-label="Uyarılar">
                    <div class="text-3xl font-extrabold text-amber-600 mb-1 group-hover:scale-110 transition-transform">${data.summary.warnings}</div>
                    <div class="text-[10px] uppercase tracking-widest font-bold text-amber-700/70">Zayıf Yapılandırma</div>
                </div>
                <div class="bg-rose-50 border border-rose-100 rounded-xl p-5 text-center group hover:bg-rose-100/50 transition-all duration-300" role="region" aria-label="Başarısız testler">
                    <div class="text-3xl font-extrabold text-rose-600 mb-1 group-hover:scale-110 transition-transform">${data.summary.failed}</div>
                    <div class="text-[10px] uppercase tracking-widest font-bold text-rose-700/70">Risk Tespit Edildi</div>
                </div>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-center group hover:bg-slate-100/50 transition-all duration-300" role="region" aria-label="Toplam test sayısı">
                    <div class="text-3xl font-extrabold text-slate-800 mb-1 group-hover:scale-110 transition-transform">${data.summary.total}</div>
                    <div class="text-[10px] uppercase tracking-widest font-bold text-slate-500">Kontrol Edilen Parametre</div>
                </div>
            `;

            // Display raw JSON
            const rawJsonContent = document.getElementById('rawJsonContent');
            rawJsonContent.textContent = JSON.stringify(data, null, 2);

            // Display detailed results
            const detailedResults = document.getElementById('detailedResults');
            detailedResults.innerHTML = '';

            data.results.forEach((result, index) => {
                const statusConfig = {
                    'success': { color: 'emerald', icon: 'check-circle', label: 'BAŞARILI' },
                    'warning': { color: 'amber', icon: 'alert-triangle', label: 'UYARI' },
                    'error': { color: 'rose', icon: 'x-circle', label: 'RİSKLİ' }
                }[result.status] || { color: 'slate', icon: 'help-circle', label: 'BİLİNMİYOR' };

                const resultCard = document.createElement('article');
                resultCard.className = 'glass-card rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-brand-500/10 transition-all duration-300 border-l-4 border-l-' + statusConfig.color + '-500';
                resultCard.setAttribute('role', 'region');

                resultCard.innerHTML = `
                    <div class="px-6 py-6 border-b border-slate-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-${statusConfig.color}-50 text-${statusConfig.color}-600 rounded-xl flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                    <i data-feather="${statusConfig.icon}" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-lg font-bold text-slate-900 tracking-tight">${result.title}</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed max-w-2xl">${result.description}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 self-start md:self-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold tracking-widest bg-${statusConfig.color}-50 text-${statusConfig.color}-700 border border-${statusConfig.color}-100">
                                    ${statusConfig.label}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50/50 px-6 py-6">
                        <div class="flex items-center justify-between mb-3 text-xs font-bold text-slate-400 uppercase tracking-widest">
                            <span>Teknik Bulgular</span>
                            <button onclick="copyToClipboard(this)" class="hover:text-brand-600 transition-colors p-1" title="Kopyala">
                                <i data-feather="copy" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                            <pre class="text-xs text-slate-700 font-mono overflow-x-auto leading-relaxed" data-content="${result.details}">${result.details}</pre>
                        </div>
                    </div>
                `;
                detailedResults.appendChild(resultCard);
            });

            // Re-initialize Feather icons
            feather.replace();
        }

        // Enhanced copy function with better accessibility
        function copyToClipboard(button) {
            const preElement = button.closest('.bg-gray-50').querySelector('pre');
            const content = preElement.getAttribute('data-content') || preElement.textContent;

            // Modern clipboard API kullan
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(content).then(() => {
                    showCopySuccess(button);
                    announceToScreenReader('İçerik panoya kopyalandı.');
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
                    announceToScreenReader('İçerik panoya kopyalandı.');
                } else {
                    showCopyError(button);
                    announceToScreenReader('Kopyalama başarısız.');
                }
            } catch (err) {
                console.error('Fallback kopyalama başarısız:', err);
                showCopyError(button);
                announceToScreenReader('Kopyalama başarısız.');
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

        // API Modal fonksiyonları with better accessibility
        function showApiInfo() {
            const modal = document.getElementById('apiModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Scroll'u engelle
            feather.replace();

            // Focus management for accessibility
            const closeButton = modal.querySelector('[onclick="hideApiInfo()"]');
            if (closeButton) {
                closeButton.focus();
            }

            // Announce modal opening
            announceToScreenReader('API dokümantasyonu açıldı.');
        }

        function hideApiInfo() {
            const modal = document.getElementById('apiModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Scroll'u geri aç
            announceToScreenReader('API dokümantasyonu kapatıldı.');
        }

        // Modal dışına tıklayınca kapat
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('apiModal');
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    hideApiInfo();
                }
            });

            // ESC tuşu ile kapat
            document.addEventListener('keydown', function (e) {
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
                announceToScreenReader('RAW JSON çıktısı gösterildi.');
            } else {
                rawJsonOutput.classList.add('hidden');
                buttonText.textContent = 'RAW JSON Göster';
                announceToScreenReader('RAW JSON çıktısı gizlendi.');
            }
        }

        // RAW JSON kopyalama fonksiyonu
        function copyRawJson() {
            const rawJsonContent = document.getElementById('rawJsonContent');
            const content = rawJsonContent.textContent || rawJsonContent.innerText;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(content).then(() => {
                    showCopySuccess(document.querySelector('[onclick="copyRawJson()"]'));
                    announceToScreenReader('JSON çıktısı panoya kopyalandı.');
                }).catch(err => {
                    console.error('Kopyalama başarısız:', err);
                    fallbackCopyTextToClipboard(content, document.querySelector('[onclick="copyRawJson()"]'));
                });
            } else {
                fallbackCopyTextToClipboard(content, document.querySelector('[onclick="copyRawJson()"]'));
            }
        }

        // Accessibility helper functions
        function announceToScreenReader(message) {
            // Create a live region for screen reader announcements
            let liveRegion = document.getElementById('sr-live-region');
            if (!liveRegion) {
                liveRegion = document.createElement('div');
                liveRegion.id = 'sr-live-region';
                liveRegion.setAttribute('aria-live', 'polite');
                liveRegion.setAttribute('aria-atomic', 'true');
                liveRegion.className = 'sr-only';
                document.body.appendChild(liveRegion);
            }

            liveRegion.textContent = message;

            // Clear the message after a short delay
            setTimeout(() => {
                liveRegion.textContent = '';
            }, 1000);
        }

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${type === 'error' ? 'bg-red-500 text-white' :
                type === 'success' ? 'bg-green-500 text-white' :
                    'bg-blue-500 text-white'
                }`;
            notification.setAttribute('role', 'alert');
            notification.setAttribute('aria-live', 'assertive');
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove notification after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 5000);
        }

        // Add CSS for screen reader only content
        const style = document.createElement('style');
        style.textContent = `
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>