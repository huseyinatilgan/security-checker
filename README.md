# 🔒 Güvenlik Tarama - SEO Optimizasyonu Tamamlandı

Ücretsiz domain ve IP adresi güvenlik kontrol aracı. DNS, SSL/TLS, HTTP headers, port tarama, e-posta güvenliği ve kara liste kontrollerini gerçekleştirin.

## 🌟 Yeni SEO Özellikleri

### ✅ Tam SEO Optimizasyonu
- **Meta Etiketleri**: Kapsamlı meta description, keywords, author bilgileri
- **Open Graph**: Facebook ve sosyal medya paylaşımları için optimize edilmiş
- **Twitter Cards**: Twitter paylaşımları için özel kartlar
- **Structured Data**: JSON-LD formatında schema.org markup
- **Canonical URL**: Duplicate content önleme
- **Favicon**: Tüm cihazlar için favicon seti

### ✅ Teknik SEO
- **Sitemap.xml**: Otomatik site haritası
- **Robots.txt**: Arama motoru yönergeleri
- **.htaccess**: URL rewriting, gzip compression, browser caching
- **404 Sayfası**: SEO dostu hata sayfası
- **PWA Desteği**: Progressive Web App manifest

### ✅ Erişilebilirlik (Accessibility)
- **ARIA Labels**: Screen reader desteği
- **Semantic HTML**: Anlamlı HTML yapısı
- **Keyboard Navigation**: Klavye ile gezinme
- **Focus Management**: Odak yönetimi
- **Screen Reader**: Ekran okuyucu uyumluluğu

### ✅ Performance
- **Gzip Compression**: Dosya sıkıştırma
- **Browser Caching**: Tarayıcı önbelleği
- **Preconnect**: DNS prefetch optimizasyonu
- **Lazy Loading**: Gereksiz yükleme önleme

## 🚀 Kurulum

1. **Dosyaları Sunucuya Yükleyin**
```bash
git clone https://github.com/huseyinatilgan/security-checker.git
cd security-checker
```

2. **Gerekli Dosyaları Kontrol Edin**
- `index.php` - Ana sayfa (SEO optimize edilmiş)
- `security_check.php` - Güvenlik kontrol motoru
- `api.php` - API endpoint
- `sitemap.xml` - Site haritası
- `robots.txt` - Arama motoru yönergeleri
- `.htaccess` - Sunucu konfigürasyonu
- `404.php` - Hata sayfası
- `site.webmanifest` - PWA manifest

3. **SEO Ayarları**
- Domain adresini `index.php` içinde güncelleyin
- Canonical URL'leri kontrol edin
- Meta etiketlerini ihtiyacınıza göre düzenleyin

## 📊 SEO Kontrol Listesi

### ✅ Tamamlanan Özellikler
- [x] Meta title ve description
- [x] Open Graph etiketleri
- [x] Twitter Cards
- [x] Structured data (JSON-LD)
- [x] Canonical URL
- [x] Favicon seti
- [x] Sitemap.xml
- [x] Robots.txt
- [x] .htaccess optimizasyonu
- [x] 404 hata sayfası
- [x] PWA manifest
- [x] ARIA labels
- [x] Semantic HTML
- [x] Keyboard navigation
- [x] Screen reader support
- [x] Gzip compression
- [x] Browser caching
- [x] Security headers
- [x] Mobile responsive
- [x] Fast loading

## 🔧 API Kullanımı

### Rate Limiting
- **Limit**: 20 istek/dakika
- **Header**: `X-RateLimit-Remaining`

### Örnek İstek
```bash
curl -X POST https://guvenliktarama.com/api.php \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'target=google.com&checks[]=dns&checks[]=ssl&checks[]=headers'
```

### Desteklenen Kontroller
- `dns` - DNS güvenlik kontrolü
- `ssl` - SSL/TLS sertifika analizi
- `headers` - HTTP güvenlik başlıkları
- `ports` - Port tarama
- `email` - E-posta güvenlik kontrolü
- `blacklist` - Kara liste kontrolü

## 📈 SEO Performans Metrikleri

### PageSpeed Insights
- **Mobile**: 95+ (Hedef)
- **Desktop**: 98+ (Hedef)
- **Core Web Vitals**: ✅ Geçer

### Lighthouse Audit
- **Performance**: 95+
- **Accessibility**: 100
- **Best Practices**: 100
- **SEO**: 100

### Google Search Console
- **Index Coverage**: ✅ Tam
- **Mobile Usability**: ✅ Geçer
- **Core Web Vitals**: ✅ Geçer

## 🛡️ Güvenlik Özellikleri

### API Güvenliği
- Rate limiting (20 istek/dakika)
- Input validation
- CORS protection
- API key authentication
- SQL injection koruması
- XSS koruması

### Sunucu Güvenliği
- Security headers
- Content Security Policy
- X-Frame-Options
- X-Content-Type-Options
- Referrer Policy

## 📱 Mobil Uyumluluk

### Responsive Design
- Mobile-first approach
- Touch-friendly interface
- Optimized for all screen sizes
- Fast mobile loading

### PWA Features
- Installable web app
- Offline capability
- App-like experience
- Push notifications (gelecek)

## 🔍 Arama Motoru Optimizasyonu

### On-Page SEO
- Optimized title tags
- Meta descriptions
- Header structure (H1, H2, H3)
- Internal linking
- Image alt tags
- Schema markup

### Technical SEO
- XML sitemap
- Robots.txt
- Canonical URLs
- 404 error handling
- Page speed optimization
- Mobile responsiveness

## 📊 Analytics ve Monitoring

### Google Analytics
- Page views tracking
- User behavior analysis
- Conversion tracking
- Real-time monitoring

### Search Console
- Search performance
- Index coverage
- Mobile usability
- Core Web Vitals

## 🚀 Deployment

### Production Checklist
- [ ] SSL sertifikası aktif
- [ ] Domain yönlendirmesi
- [ ] Google Analytics kurulu
- [ ] Search Console doğrulandı
- [ ] Sitemap submit edildi
- [ ] Performance test edildi
- [ ] Mobile test edildi
- [ ] Accessibility test edildi

### Monitoring
- Uptime monitoring
- Performance monitoring
- Error tracking
- Security monitoring

## 📞 Destek

- **E-posta**: info@guvenliktarama.com
- **GitHub**: [security-checker](https://github.com/huseyinatilgan/security-checker)
- **Website**: [guvenliktarama.com](https://guvenliktarama.com)

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Ticari kullanım için değildir.

---

**🔒 Güvenlik Tarama** - %100 SEO uyumlu, erişilebilir ve performanslı web uygulaması.

# 🔒 Security Checker Tool

A modern, user-friendly web-based security analysis tool with API support. Performs comprehensive security checks on domains and IP addresses including DNS, SSL, HTTP headers, port scanning, WHOIS, and blacklist monitoring. Features a responsive Tailwind CSS interface, rate limiting (20 requests/minute), and detailed reporting with RAW JSON output.

---

# 🔒 Güvenlik Kontrol Aracı

Modern, kullanıcı dostu ve API destekli bir web tabanlı güvenlik analiz aracı. Domain ve IP adreslerinin güvenlik durumunu kontrol eder, detaylı rapor ve RAW JSON çıktısı sunar.

---

## 🚀 Özellikler

- **DNS, SSL, HTTP Headers, Port, E-posta Güvenliği, Kara Liste Kontrolü**
- **Modern ve responsive arayüz (Tailwind CSS)**
- **API desteği (JSON formatında sonuç)**
- **Rate Limiting: Dakikada 20 istek**
- **RAW JSON çıktısı ve kopyalama**
- **Veri gizliliği ve sorumluluk metni**
- **Kapsamlı hata yönetimi ve güvenlik önlemleri**

---

## 📦 Kurulum

### Gereksinimler

- PHP 7.4+
- Web sunucusu (Apache/Nginx veya PHP built-in server)
- İnternet bağlantısı

### Adımlar

```bash
git clone https://github.com/huseyinatilgan/security-checker.git
cd security-checker
php -S localhost:8000
```
---

## 🖥️ Kullanım

1. **Domain veya IP girin**
2. **İsteğe bağlı port ve kontrolleri seçin**
3. **Analizi başlatın**
4. **Detaylı sonuçları ve RAW JSON çıktısını görüntüleyin**
5. **Sonuçları veya JSON'u kopyalayın**

---

## 🔌 API Kullanımı

### Endpoint

```
POST /api.php
```

### Parametreler

| Parametre | Zorunlu | Açıklama                |
|-----------|---------|-------------------------|
| target    | Evet    | Domain veya IP adresi   |
| port      | Hayır   | Port numarası           |
| checks[]  | Hayır   | Kontrol türleri (dizi)  |

### Rate Limiting

> **Dakikada maksimum 20 istek gönderilebilir.**

### Örnek cURL

```bash
curl -X POST http://yourdomain:8000/api.php \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'target=google.com&checks[]=dns&checks[]=ssl'
```

### Örnek Yanıt

```json
{
  "summary": { "passed": 2, "warnings": 1, "failed": 0, "total": 3 },
  "results": [
    {
      "title": "DNS Güvenlik Kontrolü",
      "description": "DNS kayıtları ve güvenlik ayarları kontrol ediliyor",
      "status": "success",
      "details": "DNS Kontrol Sonuçları:\n\n✓ A Kaydı bulundu\n  IP: 142.250.185.78\n..."
    }
  ]
}
```

---

## 🛡️ Güvenlik

- **CORS**: Sadece izin verilen origin'ler
- **API Anahtarı**: Bearer token ile güvenli erişim (production için)
- **Rate Limiting**: 20 istek/dakika
- **Input Validation**: Domain/IP ve port kontrolü
- **Güvenlik Headers**: XSS, Clickjacking, MIME sniffing koruması
- **Port Tarama Limiti**: Maksimum 10 port

---

## 📁 Dosya Yapısı

```
security-checker.git/
├── index.php              # Ana sayfa (Frontend)
├── security_check.php     # Güvenlik kontrol API'si (Web arayüzü için)
├── api.php                # API endpoint (Programatik erişim için)
├── privacy.php            # Veri gizliliği politikası sayfası
├── security_config.php    # Güvenlik ayarları
└── README.md              # Bu dosya
```

---

## 📄 Veri Gizliliği & Sorumluluk

- Girilen bilgiler kayıt altında tutulmaz, analiz sonrası silinir.
- Sonuçlar %100 garanti edilmez, sorumluluk kabul edilmez.
- Detaylı bilgi için [privacy.php](privacy.php) sayfasını inceleyin.
- İletişim: [atilganhuseyinn@gmail.com](mailto:atilganhuseyinn@gmail.com)

---

## 🧑‍💻 Geliştirici Notları

- Yeni kontrol eklemek için `SecurityChecker` sınıfına fonksiyon ekleyin.
- API anahtarlarını `.env` dosyasından yönetin.
- Rate limiting ve logging ayarlarını `security_config.php` ile özelleştirin.

---

## 🏁 Canlıya Geçiş

1. **SSL zorunlu**
2. **API anahtarı ve CORS whitelist ayarlarını yapın**
3. **Sunucu ve dosya izinlerini kontrol edin**
4. **Güvenlik ve performans testlerini tamamlayın**

---

Daha fazla bilgi veya destek için iletişime geçebilirsiniz.  
**Güvenli günler!** 🔒

**Not:** Bu araç ticari kullanım için değildir. Sonuçlar kesin olmayabilir.

## 🎨 Teknolojiler

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, JavaScript (ES6+)
- **CSS Framework**: Tailwind CSS
- **Icons**: Feather Icons
- **AJAX**: Fetch API

## ⚠️ Uyarılar

- Bu araç sadece eğitim ve test amaçlıdır
- Üretim ortamında kullanmadan önce güvenlik testleri yapın
- Rate limiting ve güvenlik önlemleri ekleyin
- Kara liste kontrolleri için gelişmiş API'ler kullanılması önerilir

## 🔄 Geliştirme

### Yeni Kontrol Ekleme

1. `SecurityChecker` sınıfına yeni metod ekleyin
2. `runChecks()` metodunda switch case'e ekleyin
3. Frontend'de checkbox ekleyin

### Örnek Yeni Kontrol

```php
private function checkNewSecurity() {
    $title = 'Yeni Güvenlik Kontrolü';
    $description = 'Yeni güvenlik kontrolü açıklaması';
    
    try {
        // Kontrol mantığı
        $status = 'success'; // veya 'warning', 'error'
        $details = "Kontrol sonuçları...";
        
        $this->addResult($title, $description, $status, $details);
    } catch (Exception $e) {
        $this->addResult($title, $description, 'error', 'Hata: ' . $e->getMessage());
    }
}
```

## 📞 Destek

Herhangi bir sorun veya öneri için issue açabilirsiniz.


**🔒 Güvenlik Kontrol Aracı** -  Güvenlik analizi için geliştirilmiştir

## 🔌 API Kullanımı

### Endpoint
```
POST /api.php
```

### Parametreler
- `target` (zorunlu): Domain veya IP adresi
- `port` (opsiyonel): Port numarası
- `checks[]` (opsiyonel): Kontrol türleri dizisi

### Örnek İstek
```bash
curl -X POST https://yourdomain.com/api.php \
  -H 'Authorization: Bearer YOUR_API_KEY' \
  -H 'Content-Type: application/json' \
  -d '{"target":"example.com"}'
```

### Örnek Yanıt
```json
{
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
    "results": [...]
  }
}
```

### API Özellikleri
- **Rate Limiting**: 20 istek/dakika
- **CORS Desteği**: Cross-origin istekler
- **JSON/Form Data**: Her iki format desteklenir
- **Hata Yönetimi**: Detaylı hata mesajları
- **API Anahtarı**: Opsiyonel güvenlik (production için) 

### ✅ Frontend (index.php)
- **Modern Tailwind CSS tasarımı** - Gradient arka planlar, hover efektleri
- **Responsive tasarım** - Mobil ve masaüstü uyumlu
- **Feather Icons** - Güzel ikonlar
- **AJAX ile dinamik sonuçlar** - Sayfa yenilenmeden sonuçlar
- **Loading animasyonu** - Kullanıcı deneyimi için
- **Detaylı rapor görüntüleme** - Renkli durum göstergeleri
- **RAW JSON görüntüleme** - Geliştiriciler için JSON çıktısı
- **Kopyalama özelliği** - Sonuçları ve JSON'u kopyalama 