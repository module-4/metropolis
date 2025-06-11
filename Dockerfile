# Use official PHP image with Apache
FROM php:8.4-apache

# Install necessary extensions and dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Fix permissions for Laravel logs
RUN mkdir -p /var/www/html/storage/logs && chmod -R 777 /var/www/html/storage/logs

# Install dependencies for Puppeteer and Browsershot
RUN apt-get install -y gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgbm1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget libgbm-dev libxshmfence-dev
# Set Puppeteer cache directory
ENV PUPPETEER_CACHE_DIR=/var/www/.cache/puppeteer
RUN mkdir -p $PUPPETEER_CACHE_DIR && chmod -R 777 $PUPPETEER_CACHE_DIR

# Set up cache directory for Browsershot
ENV BROWSERSHOT_CACHE_DIR=/var/www/cache
RUN mkdir -p $BROWSERSHOT_CACHE_DIR && chmod -R 777 $BROWSERSHOT_CACHE_DIR

# Install Puppeteer and Chrome
RUN npm install puppeteer && npx puppeteer browsers install chrome

COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY --chown=www-data:www-data . .

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --optimize-autoloader

# Install npm dependencies and run build
RUN npm install \
    && npm run build

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
