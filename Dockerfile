# Використовуємо офіційний PHP образ з FPM 8.4
FROM php:8.4-fpm

# Встановлення залежностей та розширень PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    curl \
    gnupg \
    ca-certificates \
    libzip-dev \
    libcurl4-openssl-dev \
    pkg-config \
    zlib1g-dev \
    build-essential \
    netcat-openbsd \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Встановлюємо Node.js 20 + npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www/html

# Спочатку тільки composer файли - для кешування шарів
COPY composer.json composer.lock ./

# Встановлюємо залежності Laravel
RUN composer install --no-interaction --prefer-dist --no-scripts --optimize-autoloader --optimize-autoloader

# Потім копіюємо весь код
COPY . .

# Тепер запускаємо скрипти (package:discover тощо)
RUN composer dump-autoload --optimize --ignore-platform-reqs
RUN php artisan package:discover --ansi

# Встановлюємо npm залежності та збираємо фронтенд
RUN npm ci && npm run build

# Права для папок Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Налаштування PHP-FPM для TCP 9000
RUN echo '[www]' > /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo 'listen = 0.0.0.0:9000' >> /usr/local/etc/php-fpm.d/zz-docker.conf

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Відкриваємо порт
EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]
