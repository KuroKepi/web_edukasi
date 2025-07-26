# Stage 1: Get Composer from official image
FROM composer:latest AS composer_stage

# Stage 2: Main app
FROM php:8.2-apache

# Install dependencies and intl extension
RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    git \
    zip \
    && docker-php-ext-install intl pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Composer from previous stage
COPY --from=composer_stage /usr/bin/composer /usr/bin/composer

# Copy source code to container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
