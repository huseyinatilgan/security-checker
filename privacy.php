<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veri Gizliliği - Güvenlik Tarama</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

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
            body { @apply bg-slate-50 text-slate-900 font-sans antialiased; }
            h1, h2, h3, h4 { @apply font-display; }
        }
        @layer components {
            .glass-card { @apply bg-white/80 backdrop-blur-md border border-white/20 shadow-xl; }
            .glass-header { @apply sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-slate-200; }
            .btn-primary { @apply bg-brand-600 hover:bg-brand-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg shadow-brand-500/20 active:scale-[0.98]; }
            .nav-link { @apply px-4 py-2 text-slate-600 hover:text-brand-600 font-medium transition-colors cursor-pointer; }
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- Google tag (gtag.js) -->
    <?php if (getenv('GOOGLE_ANALYTICS_ID')): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars(getenv('GOOGLE_ANALYTICS_ID')); ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo htmlspecialchars(getenv('GOOGLE_ANALYTICS_ID')); ?>');
        </script>
    <?php endif; ?>
</head>
<body class="selection:bg-brand-100 selection:text-brand-900">
    <!-- Header -->
    <header class="glass-header" role="banner">
        <div class="container mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3 group cursor-pointer" onclick="window.location.href='index.php'">
                <div class="w-10 h-10 bg-brand-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:bg-brand-700 transition-all duration-300">
                    <i data-feather="shield" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-950">Güvenlik<span class="text-brand-600">Tarama</span></h1>
                    <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 -mt-1">Enterprise Guard</p>
                </div>
            </div>
            
            <nav class="flex items-center space-x-2">
                <a href="index.php" class="nav-link">Ana Sayfa</a>
                <div class="h-4 w-px bg-slate-200 mx-2"></div>
                <span class="px-4 py-2 text-brand-600 font-bold text-sm bg-brand-50 rounded-lg border border-brand-100 italic">📄 Privacy</span>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-16">
        <div class="max-w-4xl mx-auto">
            <!-- Page Hero -->
            <section class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-50 text-brand-600 rounded-3xl mb-6 shadow-brand-500/10 shadow-inner">
                    <i data-feather="lock" class="w-10 h-10"></i>
                </div>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Veri Gizliliği Politikası</h2>
                <p class="text-slate-500 font-medium">Son güncelleme: <span class="text-brand-600"><?php echo date('d.m.Y'); ?></span></p>
            </section>

            <!-- Sections -->
            <div class="space-y-8">
                <!-- Data Collection -->
                <div class="glass-card rounded-2xl p-8 md:p-10 hover:shadow-brand-500/5 transition-all">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center mr-4">
                            <i data-feather="database" class="w-4 h-4"></i>
                        </span>
                        Veri Toplama
                    </h3>
                    <div class="space-y-6 text-slate-600 leading-relaxed">
                        <p>Güvenlik Tarama, altyapınızın denetlenmesi için gerekli olan minimal teknik verileri işler:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <span class="font-bold text-slate-900 block mb-1 uppercase tracking-tighter text-[10px]">Analiz Hedefi</span>
                                Girilen domain veya IP adresleri.
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <span class="font-bold text-slate-900 block mb-1 uppercase tracking-tighter text-[10px]">Teknik Kayıtlar</span>
                                IP adresiniz, tarayıcı bilgisi ve zaman damgası.
                            </div>
                        </div>
                        <div class="bg-amber-50 border border-amber-100 rounded-xl p-5 flex items-start gap-4 shadow-sm">
                            <i data-feather="alert-triangle" class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-bold text-amber-900">Teknik Not</p>
                                <p class="text-xs text-amber-800/80 mt-1">Girdiğiniz veriler sadece anlık analiz motorunda koşturulur ve veritabanlarımızda kalıcı olarak indekslenmez.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Storage & Security -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="glass-card rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                            <i data-feather="hard-drive" class="w-5 h-5 mr-3 text-brand-600"></i>
                            Veri Saklama
                        </h3>
                        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-5 mb-4">
                            <p class="text-xs font-bold text-emerald-800 uppercase tracking-widest mb-2">Zero Persistence</p>
                            <p class="text-xs text-emerald-700 leading-relaxed">Analiz raporları oturum kapandığında tamamen bellekten silinir. Kalıcı kayıt tutulmaz.</p>
                        </div>
                        <p class="text-sm text-slate-500 italic">Log kayıtları maksimum 30 gün içinde anonimleştirilerek silinmektedir.</p>
                    </div>

                    <div class="glass-card rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                            <i data-feather="share-2" class="w-5 h-5 mr-3 text-brand-600"></i>
                            Veri Paylaşımı
                        </h3>
                        <p class="text-sm text-slate-600 mb-4 leading-relaxed">Üçüncü taraf reklam ağları veya veri simsarları ile hiçbir veri paylaşımı yapılmaz.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-xs text-slate-500">
                                <div class="w-1.5 h-1.5 bg-brand-400 rounded-full"></div> Sadece yasal zorunluluklar
                            </li>
                            <li class="flex items-center gap-2 text-xs text-slate-500">
                                <div class="w-1.5 h-1.5 bg-brand-400 rounded-full"></div> Teknik altyapı limitleri
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Responsible Disclosure -->
                <div class="glass-card rounded-2xl p-8 border-l-4 border-l-rose-500">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                        <i data-feather="alert-octagon" class="w-6 h-6 mr-4 text-rose-500"></i>
                        Sorumluluk Reddi
                    </h3>
                    <div class="bg-rose-50 border border-rose-100 rounded-xl p-6 mb-6">
                        <p class="text-sm font-bold text-rose-900 uppercase tracking-widest mb-2">KRİTİK UYARI</p>
                        <p class="text-sm text-rose-800 leading-relaxed">
                            Bu araç, altyapı sahiplerinin kendi sistemlerini test etmesi için "olduğu gibi" sunulmaktadır. 
                            Üçüncü taraf sistemlere izinsiz tarama yapılması yasal sorumluluk doğurabilir. 
                            Sonuçların doğruluğu için profesyonel denetim gereklidir.
                        </p>
                    </div>
                </div>

                <!-- Contact card -->
                <div class="glass-card rounded-2xl p-1 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-brand-600/5 to-transparent"></div>
                    <div class="relative z-10 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <h4 class="text-xl font-bold text-slate-900">Bir sorunuz mu var?</h4>
                            <p class="text-slate-500">Privacy ekibimiz her zaman yardıma hazır.</p>
                        </div>
                        <a href="mailto:privacy@guvenliktarama.com" class="btn-primary flex items-center gap-3">
                            <i data-feather="mail" class="w-5 h-5"></i>
                            Bize Ulaşın
                        </a>
                    </div>
                </div>

                <div class="text-center pt-8">
                    <a href="index.php" class="text-slate-400 hover:text-brand-600 transition-all font-bold text-sm flex items-center justify-center gap-2">
                        <i data-feather="arrow-left" class="w-4 h-4"></i>
                        Tekrar Analiz Yap
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-16 mt-16 border-t border-slate-900" role="contentinfo">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-brand-600/20 text-brand-500 rounded-xl flex items-center justify-center border border-brand-500/30">
                        <i data-feather="shield" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Güvenlik<span class="text-brand-500">Tarama</span></h3>
                </div>
                <div class="flex items-center gap-8 text-xs font-semibold uppercase tracking-widest">
                    <a href="index.php" class="hover:text-white transition-colors">Start Scan</a>
                    <a href="mailto:privacy@guvenliktarama.com" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
            <div class="border-t border-slate-900 mt-8 pt-8 text-center">
                <p class="text-[10px] text-slate-600">© 2026 Secured Infrastructure. Built for the Modern Web.</p>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>
 