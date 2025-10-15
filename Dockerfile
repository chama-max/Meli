# Use official PHP with Apache
FROM php:8.2-apache

# Install system deps, composer prerequisites, and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
 && docker-php-ext-install mysqli pdo pdo_mysql zip \
 && rm -rf /var/lib/apt/lists/*

# Enable apache rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Ensure permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Render's default port
EXPOSE 10000

# Use Apache foreground (recommended for php:apache image)
CMD ["apache2-foreground"]
