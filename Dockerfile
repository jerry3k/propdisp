FROM php:7.2-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip opcache

# Enable Apache rewrite module (still needed for WordPress permalinks)
RUN a2enmod rewrite

# Set ServerName to suppress "Could not reliably determine the server's fully qualified domain name" warning
RUN echo "ServerName propertydisplayed.co.uk" >> /etc/apache2/apache2.conf

# PHP configuration
RUN { \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'memory_limit = 256M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_vars = 3000'; \
    echo 'date.timezone = "UTC"'; \
} > /usr/local/etc/php/conf.d/wordpress.ini

# Cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Working directory
WORKDIR /var/www/html

# Copy WordPress files
COPY ./propdisp_wp/ /var/www/html/

# Update database settings
RUN sed -i "s/define( 'DB_HOST', '.*' );/define( 'DB_HOST', 'db' );/" /var/www/html/wp-config.php

# Set recommended permissions
RUN find /var/www/html/wp-content/themes -type d -exec chmod 755 {} \; \
    && find /var/www/html/wp-content/themes -type f -exec chmod 644 {} \; \
    && chown -R www-data:www-data /var/www/html
