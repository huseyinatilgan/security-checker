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

Tarayıcıda aç: [http://localhost:8000](http://localhost:8000)

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
curl -X POST http://localhost:8000/api.php \
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
- **Detaylı rapor görünümü** - Renkli durum göstergeleri
- **RAW JSON görüntüleme** - Geliştiriciler için JSON çıktısı
- **Kopyalama özelliği** - Sonuçları ve JSON'u kopyalama 