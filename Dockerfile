FROM php:8.2-fpm

# System Dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# PHP Extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory
COPY . .

# Install dependencies
RUN composer install

# Change ownership
RUN chown -R www-data:www-data /var/www/html/storage

# Expose port 8000
EXPOSE 8000

# Start PHP built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000