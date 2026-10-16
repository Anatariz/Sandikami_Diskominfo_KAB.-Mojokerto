#!/usr/bin/env bash
# Keluar jika ada error
set -o errexit

# Install dependensi PHP
composer install --no-dev --optimize-autoloader

# Install dependensi frontend (jika pakai Vite/Tailwind bawaan Laravel)
npm install
npm run build

# Cache config, route, dan view untuk optimasi production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi database
php artisan migrate --force