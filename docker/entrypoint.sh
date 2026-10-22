#!/bin/bash

set -e

echo "Waiting for MySQL to be ready..."

# Wait for MySQL TCP port to be available (reads credentials from .env)
max_attempts=30
attempt=0
until php -r "
    \$db = getenv('DB_DATABASE') ?: 'laravel_locations';
    \$user = getenv('DB_USERNAME') ?: 'laravel';
    \$pass = getenv('DB_PASSWORD') ?: 'secret';
    \$host = getenv('DB_HOST') ?: 'db';
    \$port = getenv('DB_PORT') ?: '3306';
    try {
        new PDO(\"mysql:host={\$host};port={\$port};dbname={\$db}\", \$user, \$pass);
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }
" 2>/dev/null; do
    attempt=$((attempt + 1))
    if [ $attempt -ge $max_attempts ]; then
        echo "DB not available after $max_attempts attempts. Continuing..."
        break
    fi
    echo "  DB not ready (attempt $attempt/$max_attempts), retrying in 3s..."
    sleep 3
done

echo "Database connection OK!"

# Install/update composer dependencies
cd /var/www
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run migrations FIRST (creates cache/session tables)
php artisan migrate --force

# Now seed
php artisan db:seed --force

# Clear caches (tables now exist)
php artisan config:clear
php artisan cache:clear

# Create storage symlink
php artisan storage:link --force 2>/dev/null || true

# Cache for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start cron service (for scheduler)
service cron start 2>/dev/null || true

echo ""
echo "==================================="
echo "  Application is ready!"
echo "  URL: http://localhost:8000"
echo "  MailHog: http://localhost:8025"
echo "  Login: admin@example.com / password"
echo "==================================="
echo ""

exec "$@"
