# 📖 Sistem Buku Tamu Digital  
*Inspektorat Provinsi Jawa Timur*

Sistem Buku Tamu Digital ini dirancang untuk mempermudah proses pencatatan kunjungan tamu secara digital di lingkungan *Inspektorat Provinsi Jawa Timur. Sistem ini dibangun menggunakan framework **Laravel* dan dilengkapi dengan fitur manajemen pengguna (user roles) serta laporan kunjungan dalam format PDF.

---

## 🚀 Fitur Utama

- Input data tamu secara langsung oleh resepsionis
- Penyimpanan data kunjungan secara *real-time*
- Rekap kunjungan yang dapat *diunduh sebagai PDF*
- *Manajemen pengguna* dengan hak akses berbeda sesuai peran (role)

---

## 👥 Role dan Hak Akses Pengguna

### 1. Super Admin
- CRUD data *lookups, **tamu, dan **user*
- Akses penuh ke halaman *manajemen user*
- Akses ke halaman *report* dan *unduh laporan PDF*
- Dapat *mengubah profil*

### 2. Resepsionis
- CRUD data *lookups* dan *tamu*
- *Tidak bisa* mengakses halaman manajemen user
- Akses ke halaman *report* dan *unduh laporan PDF*
- Dapat *mengubah profil*

### 3. Monitor
- *Hanya bisa melihat* data lookups dan tamu
- *Tidak bisa CRUD* data apa pun
- Akses ke halaman *report* dan *unduh laporan PDF*
- Dapat *mengubah profil*

---

## ⚙ Instalasi dan Setup Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek secara lokal:

### 1. Clone Repository
```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo

### 2. Install Dependency Composer
bash
composer install

### 3. Copy File Environment
bash
cp .env.example .env

### 4. Generate Application Key
bash
php artisan key:generate

### 5. Konfigurasi Database
Edit file .env dan sesuaikan bagian berikut:
bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_tamu_db
DB_USERNAME=root
DB_PASSWORD=

### 6. Buat Database
Buat database baru di MySQL dengan nama buku_tamu_db (atau sesuai .env).

### 7. Jalankan Migrasi dan Seeder
bash
php artisan migrate --seed

### 8. Jalankan Aplikasi
```bash
php artisan serve
