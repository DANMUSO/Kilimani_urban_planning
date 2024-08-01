FROM php:8.1.0-apache

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Enable Apache mod rewrite
RUN a2enmod rewrite

# Install Linux libraries
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP extensions
RUN docker-php-ext-install gettext intl pdo_mysql gd

# Configure GD extension
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]