FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip zlib1g-dev libxml2-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring zip bcmath opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy app files
COPY . .

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

CMD ["php-fpm"]
