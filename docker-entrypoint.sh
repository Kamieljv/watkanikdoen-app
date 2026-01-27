#!/bin/bash
# filepath: docker-entrypoint.sh

set -e

if [ "$APP_ENV" = "local" ]; then
    echo "Starting Laravel development server..."
    php artisan serve --host=0.0.0.0 --port=8000
else
    echo "Starting PHP-FPM..."
    php-fpm
fi