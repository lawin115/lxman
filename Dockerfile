# 1. Base image
FROM php:8.2-fpm

# 2. Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev \
    && docker-php-ext-install pdo_mysql zip gd

# 3. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Set working dir
WORKDIR /var/www/html

# 5. Copy files
COPY . .

# 6. Install dependencies
RUN composer install --no-dev --optimize-autoloader

# 7. Expose port
EXPOSE 8000

# 8. Run Laravel
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000
