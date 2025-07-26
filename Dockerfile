FROM php:8.2-apache

# Install ekstensi & dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev unzip git zip \
    && docker-php-ext-install intl pdo pdo_mysql mbstring

# Aktifkan mod_rewrite (CodeIgniter butuh)
RUN a2enmod rewrite

# Ubah DocumentRoot ke /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copy semua file project ke dalam container
COPY . /var/www/html/

# Set permission (wajib di CI4 biar writable jalan)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Install composer dari image composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies PHP
RUN composer install --no-dev --optimize-autoloader
