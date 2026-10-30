#!/bin/bash
set -e

# Pastikan folder penyimpanan Laravel dan cache bootstrap tersedia
mkdir -p \
    /var/www/storage/app/public/surat-masuk \
    /var/www/storage/app/public/surat-keluar \
    /var/www/storage/framework/cache/data \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/storage/logs \
    /var/www/bootstrap/cache

# Sesuaikan kepemilikan dan hak akses direktori storage & bootstrap cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Inisialisasi berkas .env jika belum ada
if [ ! -f /var/www/.env ]; then
    if [ -f /var/www/.env.docker ]; then
        echo "--> Inisialisasi .env dari .env.docker..."
        cp /var/www/.env.docker /var/www/.env
    elif [ -f /var/www/.env.example ]; then
        echo "--> Inisialisasi .env dari .env.example..."
        cp /var/www/.env.example /var/www/.env
    fi
    [ -f /var/www/.env ] && chown www-data:www-data /var/www/.env
fi

# Pastikan dependensi composer telah terpasang
if [ ! -d "/var/www/vendor" ] || [ ! -f "/var/www/vendor/autoload.php" ]; then
    echo "--> Direktori vendor tidak ditemukan. Menjalankan composer install..."
    gosu www-data composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Generate APP_KEY jika belum terisi
if ! grep -q "^APP_KEY=base64:" /var/www/.env; then
    echo "--> Men-generate Laravel APP_KEY..."
    gosu www-data php artisan key:generate --force
fi

# Buat symbolic link ke public storage jika belum ada
if [ ! -L "/var/www/public/storage" ]; then
    echo "--> Membuat symlink public storage..."
    gosu www-data php artisan storage:link || true
fi

# Pasang dependensi npm & build aset frontend jika belum di-build
if [ ! -d "/var/www/node_modules" ]; then
    echo "--> node_modules tidak ditemukan. Menjalankan npm install..."
    gosu www-data npm install --no-audit --no-fund
fi

if [ ! -f "/var/www/public/build/manifest.json" ]; then
    echo "--> Manifest Vite belum ditemukan. Melakukan build aset frontend (npm run build)..."
    gosu www-data npm run build
fi

# Jalankan migrasi database otomatis jika diaktifkan
if [ "${AUTO_MIGRATE:-false}" = "true" ]; then
    echo "--> Menjalankan migrasi database (artisan migrate --force)..."
    gosu www-data php artisan migrate --force || echo "Migrasi akan dicoba kembali saat database siap."
fi

echo "--> Inisialisasi container selesai. Menjalankan proses utama..."

# php-fpm harus dijalankan sebagai root (master process) agar dapat membuka log /proc/self/fd/2.
# Pool worker php-fpm akan secara otomatis berjalan sebagai user www-data.
if [ "$1" = "php-fpm" ]; then
    exec "$@"
else
    exec gosu www-data "$@"
fi
