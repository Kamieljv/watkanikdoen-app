#!/bin/bash

# Pre-Migration Checklist Script
# Run this before starting the actual migration

echo "╔════════════════════════════════════════════════════════════╗"
echo "║   Voyager to Filament Pre-Migration Checklist             ║"
echo "╚════════════════════════════════════════════════════════════╝"
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

CHECKS_PASSED=0
CHECKS_FAILED=0

check_item() {
    if [ $1 -eq 0 ]; then
        echo -e "${GREEN}✓${NC} $2"
        CHECKS_PASSED=$((CHECKS_PASSED + 1))
    else
        echo -e "${RED}✗${NC} $2"
        CHECKS_FAILED=$((CHECKS_FAILED + 1))
    fi
}

echo "Checking prerequisites..."
echo ""

# Check if artisan exists
if [ -f "artisan" ]; then
    check_item 0 "Laravel project detected"
else
    check_item 1 "Laravel artisan not found"
fi

# Check if Docker is running
if docker compose ps | grep -q "app"; then
    check_item 0 "Docker containers are running"
else
    check_item 1 "Docker containers not running (run: docker compose up -d)"
fi

# Check if Filament is installed
if docker compose exec -T app php -r "require 'vendor/autoload.php'; class_exists('Filament\FilamentServiceProvider') ? exit(0) : exit(1);" 2>/dev/null; then
    check_item 0 "Filament is installed"
else
    check_item 1 "Filament is not installed (run: composer require filament/filament)"
fi

# Check if Spatie Permission is installed
if docker compose exec -T app php -r "require 'vendor/autoload.php'; class_exists('Spatie\Permission\PermissionServiceProvider') ? exit(0) : exit(1);" 2>/dev/null; then
    check_item 0 "Spatie Laravel Permission is installed"
else
    check_item 1 "Spatie Permission not installed (run: composer require spatie/laravel-permission)"
fi

# Check database connection
if docker compose exec -T app php artisan db:show 2>&1 | grep -q "Connection"; then
    check_item 0 "Database connection is working"
else
    check_item 1 "Database connection failed"
fi

# Check if Voyager is currently installed
if docker compose exec -T app php -r "require 'vendor/autoload.php'; class_exists('TCG\Voyager\VoyagerServiceProvider') ? exit(0) : exit(1);" 2>/dev/null; then
    check_item 0 "Voyager is installed (ready to migrate)"
else
    check_item 1 "Voyager is not installed (nothing to migrate)"
fi

# Check if backup directory exists
if [ -d "database/backups" ]; then
    check_item 0 "Backup directory exists"
else
    echo -e "${YELLOW}!${NC} Backup directory will be created automatically"
fi

# Check User model for FilamentUser interface
if grep -q "FilamentUser" app/Models/User.php; then
    check_item 0 "User model implements FilamentUser"
else
    check_item 1 "User model doesn't implement FilamentUser interface"
fi

# Check User model for HasRoles trait
if grep -q "HasRoles" app/Models/User.php; then
    check_item 0 "User model has HasRoles trait"
else
    check_item 1 "User model missing HasRoles trait (will be added during migration)"
fi

echo ""
echo "════════════════════════════════════════════════════════════"
echo ""

if [ $CHECKS_FAILED -eq 0 ]; then
    echo -e "${GREEN}✓ All checks passed! ($CHECKS_PASSED/$((CHECKS_PASSED+CHECKS_FAILED)))${NC}"
    echo ""
    echo "You're ready to start the migration!"
    echo ""
    echo "Next steps:"
    echo "  1. Backup the database: php artisan db:backup"
    echo "  2. Run: docker compose exec app php artisan migrate"
    echo ""
else
    echo -e "${RED}✗ Some checks failed ($CHECKS_FAILED failed, $CHECKS_PASSED passed)${NC}"
    echo ""
    echo "Please resolve the issues above before proceeding."
    echo ""
    
    if ! docker compose ps | grep -q "app"; then
        echo "To start Docker containers:"
        echo "  docker compose up -d"
        echo ""
    fi
    
    if ! docker compose exec -T app php -r "require 'vendor/autoload.php'; class_exists('Filament\FilamentServiceProvider') ? exit(0) : exit(1);" 2>/dev/null; then
        echo "To install Filament:"
        echo "  docker compose exec app composer require filament/filament"
        echo "  docker compose exec app php artisan filament:install --panels"
        echo ""
    fi
    
    if ! docker compose exec -T app php -r "require 'vendor/autoload.php'; class_exists('Spatie\Permission\PermissionServiceProvider') ? exit(0) : exit(1);" 2>/dev/null; then
        echo "To install Spatie Laravel Permission:"
        echo "  docker compose exec app composer require spatie/laravel-permission"
        echo ""
    fi
fi

