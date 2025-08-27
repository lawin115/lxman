FROM php:8.2-cli

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev \
    && docker-php-ext-install pdo_mysql zip gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Workdir
WORKDIR /var/www/html

# Copy app
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel needs storage/cache links
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# Expose
EXPOSE 8000

# Run app with PORT from Railway, fallback 8000
CMD php artisan serve 

