#!/bin/bash
set -e

cd /var/www/html

# Якщо немає APP_KEY — генеруємо
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force --env=docker
fi

# Експортуємо APP_KEY з .env.docker в поточне середовище процесу
export APP_KEY=$(grep APP_KEY .env.docker | cut -d'=' -f2)

echo "Running migrations..."
php artisan migrate --force || true

echo "Running seeders..."
php artisan db:seed --force || true

echo "Publishing Filament assets..."
php artisan filament:assets || true

echo "Starting PHP built-in server..."

exec php -S 0.0.0.0:${PORT:-10000} -t public
