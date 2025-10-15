# Use official PHP 8.2 image with Apache
FROM php:8.2-apache

# Copy all files to Apache document root
COPY . /var/www/html/

# Enable Apache rewrite module (useful for clean URLs)
RUN a2enmod rewrite

# Expose port 10000 (Render default port)
EXPOSE 10000

# Start PHP server on port 10000
CMD ["php", "-S", "0.0.0.0:10000", "-t", "/var/www/html"]
