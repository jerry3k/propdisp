FROM php:7.2-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    openssl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip opcache

# Enable Apache rewrite module only
RUN a2enmod rewrite

# Configure Apache for HTTP only
RUN sed -i 's/^\(\s*\)CustomLog\(.*\)/\1CustomLog\2\n\1ServerName propertydisplayed.co.uk/g' /etc/apache2/sites-available/000-default.conf

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

# Add Traefik header handling to wp-config.php
RUN sed -i "/\/\* That's all, stop editing! Happy blogging. \*\//i if (isset(\$_SERVER['HTTP_X_FORWARDED_PROTO']) \&\& \$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {\n    \$_SERVER['HTTPS'] = 'on';\n}\n" /var/www/html/wp-config.php

# Remove HTTPS redirect rule from .htaccess
RUN sed -i '/RewriteCond %{HTTPS} off/d' /var/www/html/.htaccess && \
    sed -i '/RewriteRule .\+https:\/\/%{HTTP_HOST}%{REQUEST_URI}/d' /var/www/html/.htaccess

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Use default entrypoint
CMD ["apache2-foreground"]
