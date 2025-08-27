# 📱 IniGadget App

`IniGadget App` adalah aplikasi web berbasis **Laravel** dengan integrasi **Vite** untuk frontend.  
Proyek ini dapat digunakan sebagai pondasi pengembangan aplikasi modern dengan stack Laravel (backend) dan JavaScript/Blade (frontend).

---

## ✨ Fitur Utama
- ✅ Backend dengan Laravel (routing, controller, model, migration)
- ✅ Template engine **Blade**
- ✅ Manajemen asset dengan **Vite** (mendukung JS/SCSS/React/Vue)
- ✅ Struktur siap skala untuk pengembangan dan produksi
- ✅ Mendukung autentikasi Laravel (bisa dikembangkan lebih lanjut)
- ✅ Dukungan database MySQL/PostgreSQL/SQLite

---

## 🛠 Persyaratan Sistem
Sebelum instalasi, pastikan sistem Anda sudah terpasang:
- **PHP 8.1+**
- **Composer**
- **Node.js & npm** (versi terbaru)
- **MySQL / PostgreSQL / SQLite**
- Ekstensi PHP: `OpenSSL`, `PDO`, `Mbstring`, `Ctype`, `JSON`, `BCMath`

---

## 🚀 Instalasi Cepat

1. **Clone repository**
   ```bash
   git clone https://github.com/muhammadiqbalsaputra/inigadget-app.git
   cd inigadget-app
   ```

2. **Install dependencies backend**
   ```bash
   composer install
   ```

3. **Install dependencies frontend**
   ```bash
   npm install
   ```

4. **Setup environment**
   ```bash
   cp .env.example .env
   ```
   Lalu sesuaikan konfigurasi database di file `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inigadget
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi database (opsional)**
   ```bash
   php artisan migrate
   ```

---

## ▶️ Menjalankan Aplikasi

- Jalankan server Laravel:
  ```bash
  php artisan serve
  ```

- Jalankan Vite untuk frontend (development mode):
  ```bash
  npm run dev
  ```

- Build asset untuk produksi:
  ```bash
  npm run build
  ```

Aplikasi bisa diakses di:  
👉 `http://127.0.0.1:8000`

---

## 📂 Struktur Proyek

```bash
inigadget-app/
├── app/                # Kode utama Laravel (Models, Controllers, dll)
├── bootstrap/          # File bootstrap Laravel
├── config/             # Konfigurasi aplikasi
├── database/           # Migration dan seeder
├── public/             # Web root (index.php, assets)
├── resources/
│   ├── js/             # Sumber JavaScript (Vite)
│   ├── views/          # Blade templates
├── routes/             # Definisi route (web.php, api.php)
├── tests/              # Unit & Feature tests
├── .env.example        # Template environment
├── composer.json       # Dependency backend (PHP)
├── package.json        # Dependency frontend (JS)
├── vite.config.js      # Konfigurasi Vite
```

---

## 🧪 Testing
Jalankan unit test dengan perintah:
```bash
php artisan test
```

---

## 🤝 Kontribusi
Kontribusi selalu terbuka!  
Langkah-langkah kontribusi:
1. Fork repository ini
2. Buat branch fitur:  
   ```bash
   git checkout -b feature/nama-fitur
   ```
3. Commit perubahan:  
   ```bash
   git commit -m "Menambahkan fitur baru"
   ```
4. Push ke branch:  
   ```bash
   git push origin feature/nama-fitur
   ```
5. Buat Pull Request

---

## 📜 Lisensi
Proyek ini menggunakan lisensi **MIT**.  
Anda bebas menggunakan, memodifikasi, dan mendistribusikan aplikasi ini.

---

## 🙌 Penutup
Terima kasih sudah menggunakan **IniGadget App**! 🚀  
Jika bermanfaat, jangan lupa beri ⭐ di repo ini.
