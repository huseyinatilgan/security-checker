# 🔒 Security Checker - Enterprise Guard (2026)

[![Security Status](https://img.shields.io/badge/Security-Audit_Passed-emerald?style=for-the-badge&logo=shield)](https://github.com/huseyinatilgan/security-checker)
[![Tech Stack](https://img.shields.io/badge/Modern_Tech-Corporate_Tech_UI-brand?style=for-the-badge&logo=tailwind-css&color=6366f1)](#-tech-stack)

Security Checker is a high-performance, professional-grade OSINT and security auditing tool. It provides deep analysis of infrastructure components including DNS, SSL/TLS, Security Headers, Port Exposure, and Blacklist status. 

Redesigned in 2026 with a **"Corporate Tech"** aesthetic, featuring glassmorphism, refined typography, and a hardened security architecture.

---

## 🇹🇷 Türkçe Özet

**Güvenlik Tarama - Enterprise Guard**, domain ve IP adreslerinizi profesyonel standartlarda analiz eden kurumsal düzeyde bir araçtır. 2026 vizyonu ile tamamen yenilenen arayüzü; modern cam efekti (glassmorphism), gelişmiş tipografi ve üst düzey güvenlik katmanıyla (SSRF koruması, rate limiting) donatılmıştır.

---

## ✨ Key Features (Özellikler)

### 🎨 Modern UI/UX (Redesigned 2026)
- **Corporate Tech Aesthetic**: Sleek Slate/Indigo palette with glassmorphism components.
- **Advanced Typography**: Featuring "Outfit" for displays and "Inter" for data readability.
- **Dynamic Dashboard**: Real-time analysis with modern loading shimmers and clear status badges.
- **Developer-Centric**: Integrated RAW JSON inspector with one-click copy.

### �️ Hardened Security (Audit Passed)
- **SSRF Protection**: Strict IP/Hostname validation pipeline preventing server-side attacks.
- **Rate Limit & DoS Prevention**: 20 req/min limit at system level to prevent abuse.
- **Secure Architecture**: Strictly aligned with modern Security Header standards (CSP, HSTS, etc.).
- **Zero-Persistence Privacy**: No data is stored permanently. Analyzed targets are cleared instantly.

### ⚙️ Engine Capabilities
- **DNS Deep Scan**: A, MX, NS, TXT, CNAME records analysis.
- **SSL/TLS Audit**: Certificate chain, expiry, and encryption strength.
- **Security Headers**: Analysis of CSP, X-Frame-Options, HSTS, and more.
- **Multi-Port Scanner**: Fast scanning of critical service ports.
- **OSINT Blacklist**: Real-time checks against global threat databases.

---

## 🚀 Quick Start (Hızlı Kurulum)

1. **Clone & Serve**
   ```bash
   git clone https://github.com/huseyinatilgan/security-checker.git
   cd security-checker
   php -S localhost:8000
   ```

2. **Environment Setup**
   Create a `.env` file (or set environment variables) for custom configurations:
   ```env
   GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
   ```

---

## � API Documentation

### Endpoint
`GET /api.php`

### Parameters
| Name | Type | Description |
|---|---|---|
| `target` | string | Domain or IP address (Required) |
| `port` | int | Custom port to check (Optional) |
| `checks[]` | array | list of checks: `dns`, `ssl`, `headers`, `ports`, `email`, `blacklist` |
| `o` | string | `json` (default) or `text` |

### Example Request
```bash
curl 'http://localhost:8000/api.php?target=google.com&checks[]=ssl&o=json'
```

---

## 🛠️ Tech Stack (Teknoloji Yığını)

- **Engine**: PHP 7.4+ (Hardened security logic)
- **Styling**: Tailwind CSS (Custom 2026 Design System)
- **Typography**: Outfit & Inter (Google Fonts)
- **Icons**: Feather Icons
- **Performance**: Zero-dependency frontend, Gzip compression, SEO optimized.

---

## � Compliance & Privacy (Gizlilik)

- **Anti-Abuse**: Use of this tool for unauthorized scanning of 3rd party infrastructure is prohibited.
- **Data Policy**: We do not store any analyzed target data. All logs are anonymized or purged within 30 days.

---

## 📞 Support & Contributing

- **Author**: [Hüseyin Atılgan](https://github.com/huseyinatilgan)
- **Assistant**: Stabilized and redesigned by Antigravity (Advanced AI Coding Agent).

---

**🔒 Security Checker** — Infrastructure Audit. Modernized. Secured.