FROM php:8.1-fpm-alpine

# Install dependencies
RUN apk --no-cache add \
    libfreetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    vpx-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd pdo_mysql mbstring exif pcntl bcmath

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
