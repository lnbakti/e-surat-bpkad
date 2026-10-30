# ==========================================
# Dockerfile untuk BPKAD Sistem Persuratan
# PHP 8.3 FPM (Stable & Modern for Laravel 12)
# ==========================================
FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000

# Set environment cache paths agar tidak mengotori volume proyek
ENV COMPOSER_HOME=/tmp/composer \
    npm_config_cache=/tmp/.npm

# Pasang paket sistem dan pustaka dependensi yang dibutuhkan
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    gosu \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    default-mysql-client \
    ca-certificates \
    gnupg \
    && rm -rf /var/lib/apt/lists/*

# Konfigurasi dan kompilasi ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache

# Pasang ekstensi Redis melalui PECL
RUN pecl install redis \
    && docker-php-ext-enable redis

# Pasang Node.js 22 LTS (Active LTS) & npm untuk Vite / Tailwind build
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && rm -rf /var/lib/apt/lists/*

# Ambil binari Composer resmi versi terbaru (v2)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Sesuaikan UID/GID www-data agar sinkron dengan kepemilikan file di host OS
RUN if [ "$UID" != "33" ]; then \
        usermod -u $UID www-data 2>/dev/null || true; \
        groupmod -g $GID www-data 2>/dev/null || true; \
    fi

# Direktori kerja aplikasi
WORKDIR /var/www

# Salin konfigurasi PHP kustom
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Salin dan berikan izin eksekusi script entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Port PHP-FPM
EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php-fpm"]
