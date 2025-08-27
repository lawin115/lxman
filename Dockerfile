# Stage 1: Build PHP dependencies
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-progress --optimize-autoloader

# Stage 2: PHP runtime with FPM
FROM php:8.2-fpm

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip gd

# Copy composer dependencies
WORKDIR /var/www/html
COPY --from=vendor /app/vendor ./vendor

# Copy Laravel source code
COPY . .

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Stage 3: Nginx
FROM nginx:1.25-alpine

# Copy nginx config
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Copy Laravel app from PHP stage
COPY --from=0 /var/www/html /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
