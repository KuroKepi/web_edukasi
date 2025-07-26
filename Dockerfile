FROM php:8.2-apache

RUN apt-get update && apt-get install -y libicu-dev unzip git zip \
    && docker-php-ext-install intl pdo pdo_mysql mbstring

RUN a2enmod rewrite

COPY . /var/www/html/
WORKDIR /var/www/html/

RUN chmod -R 755 /var/www/html \
    && chown -R www-data:www-data /var/www/html

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
CMD ["apache2-foreground"]
