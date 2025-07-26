FROM php:8.2-apache

# Install dependencies dan library tambahan agar docker-php-ext-install tidak gagal
RUN apt-get update && apt-get install -y \
    unzip git zip libzip-dev zlib1g-dev libicu-dev libonig-dev libxml2-dev \
    libcurl4-openssl-dev pkg-config libssl-dev build-essential autoconf \
    && docker-php-ext-install intl pdo pdo_mysql mysqli mbstring zip

# Aktifkan mod_rewrite (dibutuhkan CodeIgniter)
RUN a2enmod rewrite

# Ubah DocumentRoot ke /public agar CI4 bisa langsung jalan
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Salin semua file proyek ke container
COPY . /var/www/html/
COPY .env /var/www/html/.env
# Set permission supaya writable folder bisa dipakai untuk logs, cache, dsb
RUN mkdir -p /var/www/html/writable \
    && mkdir -p /var/www/html/writable/cache \
    && mkdir -p /var/www/html/writable/logs \
    && touch /var/www/html/writable/database.db \
    && chmod -R 777 /var/www/html/writable \
    && chown -R www-data:www-data /var/www/html/writable
    
    RUN mkdir -p /tmp \
    && touch /tmp/database.db \
    && chmod 777 /tmp/database.db





# Tambahkan composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Pindah ke folder kerja (root proyek)
WORKDIR /var/www/html

# Install PHP dependencies via composer
RUN composer install --no-dev --optimize-autoloader
