# ==== Stage 1: ambil composer binary ====
FROM composer:2 AS composer_bin

# ==== Stage 2: Build Frontend Assets (Node.js) ====
FROM node:20 AS node_build
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build

# ==== Stage 3: image aplikasi (Production) ====
FROM php:8.2-apache

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy source code
COPY . .

# Copy Composer binary
COPY --from=composer_bin /usr/bin/composer /usr/bin/composer

# Copy Built Assets from Node Stage
COPY --from=node_build /app/public/build /var/www/html/public/build

# Install Dependencies via Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer config -g repo.packagist.org composer https://repo.packagist.org \
    && composer config -g preferred-install dist \
    && composer config -g process-timeout 2000 \
    && composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction --no-progress

# Konfigurasi Apache DocumentRoot ke folder public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create storage directories explicitly (Fix: InvalidArgumentException)
RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    bootstrap/cache

# Permission untuk Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
