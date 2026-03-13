#!/bin/bash
set -e

cd /var/www/html

echo "Waiting for MySQL..."
until php -r "
    try {
        new PDO(
            'mysql:host='.getenv('DB_HOST').';port='.getenv('DB_PORT').';dbname='.getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }
"; do
    echo "  MySQL not ready, retrying in 2s..."
    sleep 2
done
echo "MySQL is ready!"

echo "Running migrations..."
php artisan migrate --force || true

echo "Running seeders..."
php artisan db:seed --force || true

echo "Publishing Filament assets..."
php artisan filament:assets || true

echo "Starting PHP-FPM..."
exec php-fpm -F
