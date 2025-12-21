# Dockerfile (letakkan di root repository)
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

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependencies (production)
RUN composer install --no-dev --optimize-autoloader

# Permission untuk Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port Apache
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
