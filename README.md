# Sistem Informasi Manajemen Persuratan BPKAD

Sistem Informasi Manajemen Persuratan adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel 12** dan **Tailwind CSS** untuk mendokumentasikan, mengelola, serta memantau arsip persuratan (Surat Masuk & Surat Keluar) di lingkungan **BPKAD** (Badan Pengelolaan Keuangan dan Aset Daerah).

---

## 🌟 Fitur Utama

- **Dashboard Statistik & Ringkasan:** Menampilkan metrik total surat masuk, surat keluar, agenda surat terbaru, dan status notifikasi disposisi/baca.
- **Manajemen Surat Masuk:** Pencatatan asal instansi/pengirim, tanggal penerimaan, nomor surat, status terbaca/belum dibaca, serta unggah berkas fisik/PDF.
- **Manajemen Surat Keluar:** Pencatatan nomor berkas, perihal, tujuan pengiriman surat, tanggal surat, serta pengarsipan dokumen digital.
- **Pencarian Terpadu (Global Search):** Pencarian instan melintasi basis data surat masuk dan keluar secara simultan.
- **Laporan & Ekspor PDF:** Rekapitulasi data laporan per periode (preview dan export download PDF via DomPDF).
- **Manajemen Profil & Keamanan Akun:** Autentikasi terproteksi dengan Laravel Breeze dan manajemen profil pengguna.

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.2+, Laravel 12.x
- **Frontend:** Blade Templating, Tailwind CSS, Alpine.js, Vite
- **Database:** MySQL / MariaDB (atau SQLite untuk development)
- **PDF Generation:** Barryvdh Laravel DomPDF
- **Package Manager:** Composer & NPM

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Clone Repositori
```bash
git clone https://github.com/USERNAME/REPO_NAME.git
cd REPO_NAME
```

### 2. Instalasi Dependensi (Backend & Frontend)
```bash
# Instal dependensi PHP
composer install

# Instal dependensi Node.js
npm install
```

### 3. Konfigurasi Environment (.env)
Salin berkas contoh konfigurasi `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan kredensial basis data Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bpkad_surat
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Migrasi & Seed Database
Jalankan migrasi tabel database (beserta data awal/seeder jika ada):
```bash
php artisan migrate --seed
```

### 6. Symbolic Link Storage
Pastikan file upload surat dapat diakses publik dengan membuat symlink storage:
```bash
php artisan storage:link
```

### 7. Jalankan Server Pengembangan
Jalankan server aplikasi Laravel dan build assets Vite:
```bash
# Terminal 1: Laravel Dev Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

Aplikasi siap diakses melalui peramban web di: `http://localhost:8000`.

---

## 📁 Struktur Direktori Utama

```text
├── app/
│   ├── Http/Controllers/    # Controller logika aplikasi (Surat, Laporan, dsb)
│   └── Models/             # Model Eloquent (SuratMasuk, SuratKeluar, User)
├── database/
│   ├── migrations/         # Skema struktur tabel database
│   └── seeders/            # Data dummy / inisialisasi awal
├── resources/
│   ├── views/              # Template antarmuka Blade
│   └── css/ & js/          # Source styling Tailwind & script Vite
├── routes/
│   └── web.php             # Definisi routing aplikasi web
└── storage/                # File lampiran & dokumen arsip surat
```

---

## 📄 Lisensi
Proyek ini didistribusikan di bawah lisensi terbuka [MIT](LICENSE).
