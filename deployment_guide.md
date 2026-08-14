# Panduan Deploy Laravel SIAP2 (Production) di CentOS + CloudPanel (Non-Sudo)

Panduan ini disusun khusus untuk deployment aplikasi **SIAP2 (Laravel)** pada server **CentOS** yang menggunakan **CloudPanel** sebagai panel kontrol, dengan asumsi Anda hanya memiliki akses **SSH User biasa (Non-Sudo)**.

---

## 1. Persiapan pada Dashboard CloudPanel
Sebelum masuk ke SSH, lakukan konfigurasi awal melalui interface web CloudPanel:

### A. Tambahkan Website Baru
1. Masuk ke CloudPanel Admin Anda.
2. Klik **Add Site** ➔ **Create a PHP Site**.
3. Isi kolom yang diperlukan:
   * **Domain Name:** `domainanda.com` (atau subdomain).
   * **PHP Version:** Pilih **PHP 8.2** atau **PHP 8.3**.
   * **Site User:** Buat username baru (misal: `siapuser`) beserta password SSH/FTP-nya.

### B. Konfigurasi Document Root
Secara default, PHP site mengarah ke `/` root htdocs. Untuk Laravel, kita harus mengarahkannya ke folder `/public`.
1. Masuk ke pengaturan site yang baru dibuat di CloudPanel.
2. Buka tab **Settings**.
3. Cari **Document Root** dan ubah nilainya menjadi:
   `/public`
4. Klik **Save**.

### C. Buat Database Baru
1. Buka tab **Databases** pada CloudPanel site Anda.
2. Klik **Add Database**.
3. Catat detail berikut untuk konfigurasi `.env` nanti:
   * **Database Name:** (misal: `onlinkid_parkir`)
   * **Database User:** (misal: `siap_dbuser`)
   * **Database Password:** (Password database Anda)

---

## 2. Proses Deployment via SSH (Akses Non-Sudo)

Sambungkan ke server menggunakan terminal/SSH dengan user website yang telah dibuat pada langkah **1-A** (bukan root):

```bash
ssh siapuser@ip-address-server -p [port-ssh]
```

Setelah berhasil masuk, ikuti langkah-langkah berikut:

### Step 1: Pindah ke Direktori Website
Secara default, folder kerja website Anda berada di `htdocs/[domain.com]`.
```bash
cd htdocs/domainanda.com
```

### Step 2: Bersihkan Folder Bawaan CloudPanel
Hapus file `index.php` default bawaan CloudPanel agar tidak bentrok.
```bash
rm public/index.php
```

### Step 3: Kloning Repositori Git
Kloning repositori GitHub yang sudah ter-push ke dalam server. Kita gunakan `.` untuk mengkloning langsung ke folder saat ini:
```bash
git clone https://github.com/diskonnekted/siap-parkir-dinhub.git .
```

### Step 4: Konfigurasi File Environment (.env)
1. Salin template `.env`:
   ```bash
   cp .env.example .env
   ```
2. Edit file `.env` menggunakan editor teks (seperti nano):
   ```bash
   nano .env
   ```
3. Ubah variabel berikut agar sesuai dengan server production:
   ```env
   APP_NAME="SIAP Dinhub Banjarnegara"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domainanda.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=onlinkid_parkir_sesuai_step_1C
   DB_USERNAME=siap_dbuser_sesuai_step_1C
   DB_PASSWORD=password_dbuser_sesuai_step_1C
   ```
4. Simpan dengan menekan `CTRL+O`, tekan `Enter`, lalu keluar dengan `CTRL+X`.

### Step 5: Instalasi Dependensi PHP (Composer)
Jalankan composer install dengan opsi optimasi production:
```bash
composer install --optimize-autoloader --no-dev
```

### Step 6: Generate Application Key
```bash
php artisan key:generate
```

### Step 7: Impor Database & Sinkronisasi Media
1. Upload file **`PARKIR.sql`** ke server menggunakan FTP/SFTP (masukkan ke folder `htdocs/domainanda.com`).
2. Jalankan perintah impor database melalui SSH:
   ```bash
   mysql -u siap_dbuser_sesuai_step_1C -p onlinkid_parkir_sesuai_step_1C < PARKIR.sql
   ```
   *(Masukkan password database Anda ketika diminta)*.
3. Hapus file `.sql` setelah impor selesai demi keamanan:
   ```bash
   rm PARKIR.sql
   ```
4. Upload semua folder `media` (foto jukir, fktp, dll.) menggunakan FTP/SFTP dan taruh di dalam folder:
   `/home/cloudpanel/htdocs/domainanda.com/public/media/`

### Step 8: Membuat Symlink Storage (Penting untuk Upload Media)
```bash
php artisan storage:link
```

### Step 9: Optimasi Cache Laravel (Production Mode)
Jalankan serangkaian perintah optimasi ini untuk mempercepat waktu respons sistem:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 3. Troubleshooting & Catatan Penting
* **Error 500 / Log Izin Menulis:** Jika muncul error 500, pastikan folder storage and bootstrap cache dapat ditulis. Di CloudPanel, jalankan perintah berikut jika terjadi masalah hak akses file:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```
* **Batas Upload Foto KTP/Jukir:** Secara default, upload file dibatasi oleh PHP. Jika foto juru parkir gagal diunggah karena ukuran terlalu besar, masuk ke CloudPanel dashboard website Anda, buka tab **PHP Settings**, cari parameter `upload_max_filesize` dan `post_max_size`, ubah nilainya menjadi `10M` atau `20M`, lalu simpan.
