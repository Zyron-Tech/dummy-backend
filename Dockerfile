# Use the official PHP image with Apache
FROM php:8.2-apache

# Install dependencies (you can adjust based on your needs)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy the application code to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose the port the app runs on
EXPOSE 80
