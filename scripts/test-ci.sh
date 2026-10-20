#!/usr/bin/env bash

set -Eeuo pipefail

# Reproduce the GitHub Actions Laravel CI environment locally.
# This does NOT use the normal docker-compose MySQL container.
# It creates a disposable MySQL 8 container matching CI.
# Requirements:
# - Docker
# - PHP / Composer
# - Node.js / npm
# - bash
# Usage:
# bash ./scripts/test-ci.sh

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

MYSQL_CONTAINER="laravel-ci-mysql"
MYSQL_IMAGE="mysql:8"
MYSQL_PORT="3306"

ENV_FILE=".env"
CI_ENV_FILE=".env.ci"
BACKUP_ENV_FILE=".env.ci.local-backup"

ENV_CREATED="false"
BACKUP_CREATED="false"

cleanup() {
EXIT_CODE=$?

echo
echo "Cleaning up CI test environment..."

if [[ "$BACKUP_CREATED" == "true" && -f "$BACKUP_ENV_FILE" ]]; then
    rm -f "$ENV_FILE"
    mv "$BACKUP_ENV_FILE" "$ENV_FILE"
    echo "Restored .env"
elif [[ "$ENV_CREATED" == "true" && -f "$ENV_FILE" ]]; then
    rm -f "$ENV_FILE"
    echo "Removed temporary .env"
fi

if docker ps -a --format '{{.Names}}' | grep -qx "$MYSQL_CONTAINER"; then
    docker rm -f "$MYSQL_CONTAINER" >/dev/null
    echo "Removed temporary MySQL container"
fi

exit "$EXIT_CODE"


}

trap cleanup EXIT

echo "==> Checking prerequisites"

if ! command -v docker >/dev/null 2>&1; then
echo "ERROR: Docker is required."
exit 1
fi

if ! command -v php >/dev/null 2>&1; then
echo "ERROR: PHP is required."
exit 1
fi

if ! command -v composer >/dev/null 2>&1; then
echo "ERROR: Composer is required."
exit 1
fi

if ! command -v npm >/dev/null 2>&1; then
echo "ERROR: npm is required."
exit 1
fi

if [[ ! -f "$CI_ENV_FILE" ]]; then
echo "ERROR: $CI_ENV_FILE was not found."
exit 1
fi

echo "PHP:"
php --version | head -n 1

echo "Composer:"
composer --version

echo "Node:"
node --version

echo "npm:"
npm --version

echo
echo "==> Checking port $MYSQL_PORT"

if command -v lsof >/dev/null 2>&1; then
if lsof -iTCP:"$MYSQL_PORT" -sTCP:LISTEN >/dev/null 2>&1; then
echo "ERROR: Port $MYSQL_PORT is already in use."
exit 1
fi
fi

echo "==> Removing previous CI MySQL container"

if docker ps -a --format '{{.Names}}' | grep -qx "$MYSQL_CONTAINER"; then
docker rm -f "$MYSQL_CONTAINER" >/dev/null
fi

echo "==> Starting temporary MySQL 8"

docker run
--name "$MYSQL_CONTAINER"
--env MYSQL_ROOT_PASSWORD=root
--publish "$MYSQL_PORT:3306"
--detach
--health-cmd="mysqladmin ping -h 127.0.0.1 -uroot -proot --silent"
--health-interval=2s
--health-timeout=5s
--health-retries=30
"$MYSQL_IMAGE" >/dev/null

echo "==> Waiting for MySQL"

MYSQL_READY="false"

for i in {1..60}; do
HEALTH_STATUS="$(
docker inspect
--format '{{.State.Health.Status}}'
"$MYSQL_CONTAINER" 2>/dev/null || true
)"

if [[ "$HEALTH_STATUS" == "healthy" ]]; then
    MYSQL_READY="true"
    break
fi

if [[ "$HEALTH_STATUS" == "unhealthy" ]]; then
    echo "ERROR: MySQL container became unhealthy."
    exit 1
fi

sleep 1


done

if [[ "$MYSQL_READY" != "true" ]]; then
echo "ERROR: MySQL did not become healthy within 60 seconds."
exit 1
fi

echo "MySQL is healthy and accepting connections."

echo "==> Creating CI database"

docker exec
-e MYSQL_PWD=root
"$MYSQL_CONTAINER"
mysql -uroot
-e "CREATE DATABASE IF NOT EXISTS laravel;"

echo "CI database created."

echo "==> Preparing .env"

if [[ -f "$ENV_FILE" ]]; then
cp "$ENV_FILE" "$BACKUP_ENV_FILE"
BACKUP_CREATED="true"
echo "Backed up existing .env"
fi

cp "$CI_ENV_FILE" "$ENV_FILE"
ENV_CREATED="true"

echo "==> Installing Composer dependencies"

composer install
-q
--no-progress
--prefer-dist
--no-interaction
--no-suggest
--optimize-autoloader
--no-scripts

echo "==> Clearing Laravel configuration"

php artisan config:clear
php artisan cache:clear

echo "==> Generating application key"

php artisan key:generate

echo "==> Running migrations"

php artisan migrate --force -v

echo "==> Installing Node dependencies"

npm ci

echo "==> Building frontend"

npm run build

echo "==> Running Pest"

./vendor/bin/pest

echo
echo "========================================"
echo "CI test suite passed."
echo "========================================"