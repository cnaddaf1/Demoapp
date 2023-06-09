# Stage 1: Build the application
FROM php:7.4-apache AS build

# Install required extensions and dependencies
RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli && \
    apt-get update && \
    apt-get install -y awscli

# Copy the application code
COPY . /var/www/html

# Stage 2: Final image with only necessary files
FROM php:7.4-apache

# Copy the built application from the previous stage
COPY --from=build /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/

# Install required extensions in the final stage
RUN docker-php-ext-enable mysqli

# Copy the application code
COPY . /var/www/html



# Enable required Apache modules
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]