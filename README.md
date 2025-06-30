# 🔒 Güvenlik Tarama - SEO Optimizasyonu Tamamlandı

Ücretsiz domain ve IP adresi güvenlik kontrol aracı. DNS, SSL/TLS, HTTP headers, port tarama, e-posta güvenliği ve kara liste kontrollerini gerçekleştirin.

## 🌟 Yeni SEO Özellikleri

### ✅ URL Desteği (Yeni!)
- **Tam URL Desteği**: `https://example.com`, `http://example.com` formatlarını destekler
- **Otomatik Domain Çıkarma**: URL'lerden domain kısmı otomatik olarak çıkarılır
- **www Desteği**: `www.example.com` formatını destekler
- **Esnek Giriş**: Domain adı, IP adresi veya tam URL kabul eder

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
php -S localhost:8000
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

### Desteklenen URL Formatları
- **Domain**: `google.com`
- **IP Adresi**: `8.8.8.8`
- **Tam URL**: `https://google.com` veya `http://google.com`
- **www ile**: `www.google.com`

### Örnek İstek
```bash
# Domain ile
curl 'https://guvenliktarama.com/api.php?target=google.com&checks[]=dns&checks[]=ssl&o=json'

# Tam URL ile
curl 'https://guvenliktarama.com/api.php?target=https://google.com&checks[]=dns&checks[]=ssl&o=json'

# IP adresi ile
curl 'https://guvenliktarama.com/api.php?target=8.8.8.8&port=53&checks[]=dns&checks[]=ports&o=json'
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
- **Website**: [guvenliktarama.com](https://guvenliktarama.com)

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

2. **Environment dosyasını oluşturun:**
```bash
cp env.example .env
```

3. **Google Analytics ID'nizi ayarlayın:**
```bash
# .env dosyasını düzenleyin
GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
```

4. **Web sunucusunu yapılandırın:**
   - Document root'u proje klasörüne yönlendirin
   - .htaccess dosyasının çalıştığından emin olun

### Google Analytics Kurulumu

Google Analytics'i etkinleştirmek için:

1. `.env` dosyasında `GOOGLE_ANALYTICS_ID` değişkenini ayarlayın:
```
GOOGLE_ANALYTICS_ID=G-6JMFXNNE2Q
```

2. Environment variable'ı sunucunuzda ayarlayın:
   - **Apache:** `.htaccess` dosyasına `SetEnv GOOGLE_ANALYTICS_ID G-6JMFXNNE2Q` ekleyin
   - **Nginx:** `fastcgi_param GOOGLE_ANALYTICS_ID "G-6JMFXNNE2Q";` ekleyin
   - **cPanel:** Environment Variables bölümünden ayarlayın

3. **Güvenlik:** Google Analytics ID'nizi asla GitHub'a pushlamayın!

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
GET /api.php
```

### Parametreler

| Parametre | Zorunlu | Açıklama                |
|-----------|---------|-------------------------|
| target    | Evet    | Domain veya IP adresi   |
| port      | Hayır   | Port numarası           |
| checks[]  | Hayır   | Kontrol türleri (dizi)  |
| o         | Hayır   | Çıktı formatı (json/text) |

### Rate Limiting

> **Dakikada maksimum 20 istek gönderilebilir.**

### Örnek cURL

```bash
curl 'https://guvenliktarama.com/api.php?target=google.com&checks[]=dns&checks[]=ssl&o=json'
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
- İletişim: [info@guvenliktarama.com](mailto:info@guvenliktarama.com)

---

## 🧑‍💻 Geliştirici Notları

- Yeni kontrol eklemek için `SecurityChecker` sınıfına fonksiyon ekleyin.
- Rate limiting ve logging ayarlarını `security_config.php` ile özelleştirin.

---

## 🏁 Canlıya Geçiş

1. **SSL zorunlu**
2. **CORS whitelist ayarlarını yapın**
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

**🔒 Güvenlik Kontrol Aracı** - Güvenlik analizi için geliştirilmiştir

## 🔌 API Kullanımı

### Endpoint
```
GET /api.php
```

### Parametreler
- `target` (zorunlu): Domain veya IP adresi
- `port` (opsiyonel): Port numarası
- `checks[]` (opsiyonel): Kontrol türleri dizisi
- `o` (opsiyonel): Çıktı formatı (json/text)

### Örnek İstek
```bash
curl 'https://guvenliktarama.com/api.php?target=example.com&o=json'
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
- **JSON/Text Çıktı**: Her iki format desteklenir
- **Hata Yönetimi**: Detaylı hata mesajları

### ✅ Frontend (index.php)
- **Modern Tailwind CSS tasarımı** - Gradient arka planlar, hover efektleri
- **Responsive tasarım** - Mobil ve masaüstü uyumlu
- **Feather Icons** - Güzel ikonlar
- **AJAX ile dinamik sonuçlar** - Sayfa yenilenmeden sonuçlar
- **Loading animasyonu** - Kullanıcı deneyimi için
- **Detaylı rapor görüntüleme** - Renkli durum göstergeleri
- **RAW JSON görüntüleme** - Geliştiriciler için JSON çıktısı
- **Kopyalama özelliği** - Sonuçları ve JSON'u kopyalama 

# Güvenlik Kontrol Aracı API

## Özellikler
- Sadece GET ile çalışır, parametreler URL üzerinden gönderilir
- API anahtarı gerektirmez (herkes kullanabilir)
- Rate limit: Dakikada 20 istek
- Çıktı formatı: JSON (varsayılan) veya TEXT (o parametresi ile)
- Güvenlik: CORS, input validation, rate limit, XSS/CSRF koruma

## API Endpoint
```
https://guvenliktarama.com/api.php
```

## Parametreler
| Parametre | Zorunlu | Açıklama |
|-----------|---------|----------|
| target    | Evet    | Domain veya IP adresi |
| port      | Hayır   | Port numarası |
| checks[]  | Hayır   | Kontrol türleri (dns, ssl, headers, ports, email, blacklist) |
| o         | Hayır   | Çıktı formatı: `json` (varsayılan) veya `text` |

## Örnek GET İstekleri

**JSON formatı:**
```
https://guvenliktarama.com/api.php?target=google.com&o=json
```

**TEXT formatı:**
```
https://guvenliktarama.com/api.php?target=google.com&o=text
```

**Port ve özel kontrollerle:**
```
https://guvenliktarama.com/api.php?target=8.8.8.8&port=53&checks[]=dns&checks[]=ports&o=text
```

## cURL ile Kullanım
```bash
curl 'https://guvenliktarama.com/api.php?target=google.com&o=json'
curl 'https://guvenliktarama.com/api.php?target=google.com&o=text'
```

## Yanıt Örnekleri

**JSON:**
```json
{
  "success": true,
  "timestamp": "2025-06-28 13:28:53",
  "request": {
    "target": "google.com",
    "port": null,
    "checks": ["dns", "ssl", "headers", "ports"]
  },
  "data": {
    "summary": {"passed": 2, "warnings": 1, "failed": 0, "total": 3},
    "results": [
      {"title": "DNS Güvenlik Kontrolü", ...},
      {"title": "SSL/TLS Güvenlik Kontrolü", ...}
    ]
  }
}
```

**TEXT:**
```
Güvenlik Kontrol Sonucu
Hedef: google.com
...
Toplam Test: 4
Başarılı: 2
Uyarı: 1
Başarısız: 0
```

## Rate Limiting
- Dakikada maksimum 20 istek gönderebilirsiniz.
- Limit aşıldığında 429 hatası döner.

## Güvenlik
- API anahtarı gerektirmez.
- Rate limit, CORS, input validation ve güvenlik header'ları aktiftir.

---

Daha fazla bilgi ve canlı demo için: [https://guvenliktarama.com](https://guvenliktarama.com) 