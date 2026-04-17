#!/bin/bash
set -e

echo "==> Update source code"
git pull origin main

echo "==> Install PHP dependencies"
composer install --no-dev --optimize-autoloader

echo "==> Run migration"
php artisan migrate --force

echo "==> Clear and rebuild cache"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Deployment done"
