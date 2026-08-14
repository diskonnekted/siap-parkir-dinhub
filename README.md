# SIAP (Sistem Informasi Aplikasi Parkir) &bull; Dinhub Banjarnegara

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL Database](https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql&logoColor=white)](https://mysql.com)
[![Leaflet Mapping](https://img.shields.io/badge/Mapping-Leaflet.js-199900?logo=leaflet&logoColor=white)](https://leafletjs.com)
[![Chart.js Stats](https://img.shields.io/badge/Charts-Chart.js-FF6384?logo=chartdotjs&logoColor=white)](https://www.chartjs.org)

**SIAP** adalah sistem informasi manajemen pelayanan perparkiran terpadu yang dirancang untuk **Dinas Perhubungan Kabupaten Banjarnegara**. Sistem ini bertindak sebagai jembatan informasi antara regulator (Dinhub), pengelola parkir (perorangan/badan usaha), juru parkir (petugas lapangan), dan masyarakat umum (publik).

Sistem ini bermigrasi dari arsitektur lama berbasis **CodeIgniter 3** ke **Laravel** modern guna meningkatkan performa, skalabilitas, keamanan, serta menghadirkan pengalaman pengguna yang jauh lebih baik (UI/UX Promax).

---

## 🚀 Fitur Utama

### 🌐 Halaman Publik (Landing Page)
* **Visual Premium:** Desain responsif, modern, dan minimalis dengan integrasi tipografi Google Fonts (*Plus Jakarta Sans* & *Inter*).
* **Tarif Resmi Transparan:** Informasi tarif parkir resmi berdasarkan Peraturan Daerah (Motor, Mobil, Alat Berat).
* **Portal Pengaduan Publik:** Memungkinkan masyarakat melaporkan jukir liar, penyalahgunaan tarif, atau masalah perparkiran secara instan tanpa login.
* **Publikasi Tindak Lanjut:** Menampilkan status aduan warga beserta jawaban resmi/solusi dari pihak Dinhub.

### 📊 Dashboard Administrator & Pengelola
* **Statistik Visual Dinamis:** Integrasi **Chart.js** untuk grafik volume kendaraan harian (Motor & Mobil) dan bagan distribusi data pengelola.
* **SPA Feel (Single Page App):** Mekanisme navigasi mulus menggunakan **PJAX**. Berpindah halaman atau menu sidebar tidak lagi memicu reload penuh browser, menghilangkan efek kedipan putih secara total.
* **Pemetaan Interaktif (Leaflet.js):** Plotting koordinat ruas jalan, penentuan titik parkir awal/akhir, dan penempatan penanda posisi juru parkir langsung pada peta.
* **Manajemen Pengelola:** Validasi berkas izin usaha, foto KTP, dan registrasi akun untuk pengelola kategori Perorangan serta Badan Usaha.
* **Cetak SK & Administrasi:** Fitur pencetakan Surat Ketetapan (SK) resmi untuk legalitas operasional titik parkir.
* **Master Data Terpusat:** Pengaturan akun admin, tahun pengelolaan aktif, dan data pejabat penandatangan resmi.

---

## 🛠️ Spesifikasi Teknis

| Komponen | Teknologi / Keterangan |
| :--- | :--- |
| **Framework Core** | Laravel 11.x |
| **Bahasa Pemrograman** | PHP 8.x |
| **Database Engine** | MariaDB / MySQL 5.7+ |
| **Front-End Styling** | Bootstrap 5.3 (Publik) & Bootstrap 4 / AdminLTE Theme (Admin) |
| **Peta Digital** | Leaflet.js (OpenStreetMap) |
| **Visualisasi Data** | Chart.js (Line & Doughnut Charts) |
| **Transisi Halaman** | Custom jQuery PJAX Engine (Zero-flash page swapping) |
| **Autentikasi** | Standard Laravel Session Guard & MD5 Password Hash Compatibility |

---

## ⚙️ Petunjuk Instalasi Lokal

### 1. Prasyarat
Pastikan server lokal Anda (XAMPP/Laragon) telah terinstal:
* PHP >= 8.2
* Composer
* MySQL / MariaDB Server

### 2. Kloning Repositori
```bash
git clone https://github.com/diskonnekted/siap-parkir-dinhub.git
cd siap-parkir-dinhub
```

### 3. Instalasi Dependensi
```bash
composer install
```

### 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan pengaturan database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=onlinkid_parkir
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Impor Database
1. Buat database baru di MySQL dengan nama `onlinkid_parkir`.
2. Impor file backup `PARKIR.sql` yang berada di folder root/projek asal ke database `onlinkid_parkir`.

### 7. Jalankan Server Lokal
```bash
php artisan serve --port=8081
```
Aplikasi kini dapat diakses di browser melalui tautan:
* **Halaman Publik:** `http://localhost:8081/`
* **Dashboard Admin:** `http://localhost:8081/admin/login` (Gunakan kredensial default admin/admin).

---

## 👥 Kontributor & Hak Cipta
* **Dinas Perhubungan Kabupaten Banjarnegara** - Pemilik Hak Cipta & Kebijakan
* **Clasnet** ([clasnet.co.id](https://clasnet.co.id/)) - Pengembang Utama & Digitalisasi Sistem
