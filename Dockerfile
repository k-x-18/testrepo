# Use the official PHP image with Apache
FROM php:8.2-apache

# Install git
RUN apt-get update && apt-get install -y git && rm -rf /var/lib/apt/lists/*

# Copy all project files to the Apache document root
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Set recommended permissions (optional, for development)
RUN chown -R www-data:www-data /var/www/html 