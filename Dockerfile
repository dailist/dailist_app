# ==== Stage 1: ambil composer binary ====
FROM composer:2 AS composer_bin

# ==== Stage 2: image aplikasi ====
FROM php:8.2-apache

# Install system dependencies + PHP extensions yang umum untuk Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
  && docker-php-ext-install pdo pdo_mysql zip \
  && a2enmod rewrite \
  && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Install Composer (ambil dari stage composer)
COPY --from=composer_bin /usr/bin/composer /usr/bin/composer

# Composer settings + install dependencies (production)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer config -g repo.packagist.org composer https://repo.packagist.org \
 && composer config -g preferred-install dist \
 && composer config -g process-timeout 2000 \
 && composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction --no-progress

# Permission untuk Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
