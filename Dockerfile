# Use the official PHP image with Apache
FROM php:8.2-apache

# Install git
RUN apt-get update && apt-get install -y --no-install-recommends git && rm -rf /var/lib/apt/lists/*

# Copy only necessary files to the Apache document root
COPY index.php result.php README.md /var/www/html/
COPY good.js bad.js /var/www/html/

# Expose port 80
EXPOSE 80

# Set recommended permissions (optional, for development)
RUN chown -R www-data:www-data /var/www/html

# Switch to non-root user
USER www-data 