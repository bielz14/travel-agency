#!/bin/bash
set -e

cd /var/www/html

# Якщо немає APP_KEY — генеруємо
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force --env=docker
fi

echo "Running migrations..."
php artisan migrate --force || true

echo "Running seeders..."
php artisan db:seed --force || true

echo "Publishing Filament assets..."
php artisan filament:assets || true

echo "Starting PHP built-in server..."
npm run dev &
exec php -S 0.0.0.0:${PORT:-10000} -t public
