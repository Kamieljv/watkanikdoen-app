$ErrorActionPreference = "Stop"
$PSNativeCommandUseErrorActionPreference = $false

#Reproduce the GitHub Actions Laravel CI environment locally.
#This does NOT use the normal docker-compose MySQL container.
#It creates a disposable MySQL 8 container matching CI.
#Requirements:
#- Docker
#- PHP / Composer
#- Node.js / npm
#Usage:
#.\scripts\test-ci.ps1

$RootDir = Resolve-Path (Join-Path $PSScriptRoot "..")
Set-Location $RootDir

$MysqlContainer = "laravel-ci-mysql"
$MysqlImage = "mysql:8"
$MysqlPort = 3306

$EnvFile = ".env"
$CiEnvFile = ".env.ci"
$BackupEnvFile = ".env.ci.local-backup"

$TestSucceeded = $false
$BackupCreated = $false
$TemporaryEnvCreated = $false

function Cleanup {
Write-Host ""
Write-Host "Cleaning up CI test environment..." -ForegroundColor Cyan

if ($BackupCreated -and (Test-Path $BackupEnvFile)) {
    if (Test-Path $EnvFile) {
        Remove-Item $EnvFile -Force
    }

    Move-Item $BackupEnvFile $EnvFile -Force
    Write-Host "Restored .env"
}
elseif ($TemporaryEnvCreated -and (Test-Path $EnvFile)) {
    Remove-Item $EnvFile -Force
    Write-Host "Removed temporary .env"
}

$containerExists = docker ps -a --format "{{.Names}}" |
    Where-Object { $_ -eq $MysqlContainer }

if ($containerExists) {
    docker rm -f $MysqlContainer | Out-Null
    Write-Host "Removed temporary MySQL container"
}


}

try {
Write-Host "==> Checking prerequisites" -ForegroundColor Cyan

if (-not (Get-Command docker -ErrorAction SilentlyContinue)) {
    throw "Docker is required."
}

if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    throw "PHP is required. Make sure Laravel Herd is available."
}

if (-not (Get-Command composer -ErrorAction SilentlyContinue)) {
    throw "Composer is required."
}

if (-not (Get-Command npm -ErrorAction SilentlyContinue)) {
    throw "npm is required."
}

if (-not (Test-Path $CiEnvFile)) {
    throw "$CiEnvFile was not found."
}

Write-Host "PHP:"
php --version | Select-Object -First 1

Write-Host "Composer:"
composer --version

Write-Host "Node:"
node --version

Write-Host "npm:"
npm --version

Write-Host ""
Write-Host "==> Checking port $MysqlPort" -ForegroundColor Cyan

$portInUse = Get-NetTCPConnection `
    -LocalPort $MysqlPort `
    -State Listen `
    -ErrorAction SilentlyContinue

if ($portInUse) {
    throw "Port $MysqlPort is already in use."
}

Write-Host "==> Removing previous CI MySQL container" -ForegroundColor Cyan

$existingContainer = docker ps -a --format "{{.Names}}" |
    Where-Object { $_ -eq $MysqlContainer }

if ($existingContainer) {
    docker rm -f $MysqlContainer | Out-Null
}

Write-Host "==> Starting temporary MySQL 8" -ForegroundColor Cyan

docker run `
    --name $MysqlContainer `
    --env MYSQL_ROOT_PASSWORD=root `
    --publish "${MysqlPort}:3306" `
    --detach `
    --health-cmd="mysqladmin ping -h 127.0.0.1 -uroot -proot --silent" `
    --health-interval=2s `
    --health-timeout=5s `
    --health-retries=30 `
    $MysqlImage | Out-Null

Write-Host "==> Waiting for MySQL" -ForegroundColor Cyan

$mysqlReady = $false

for ($i = 1; $i -le 60; $i++) {
    $health = docker inspect `
        --format "{{.State.Health.Status}}" `
        $MysqlContainer 2>$null

    if ($health -eq "healthy") {
        $mysqlReady = $true
        break
    }

    if ($health -eq "unhealthy") {
        throw "MySQL container became unhealthy."
    }

    Start-Sleep -Seconds 1
}

if (-not $mysqlReady) {
    throw "MySQL did not become healthy within 60 seconds."
}

Write-Host "MySQL is healthy and accepting connections."



Write-Host "==> Creating CI database" -ForegroundColor Cyan

docker exec `
    -e MYSQL_PWD=root `
    $MysqlContainer `
    mysql -uroot -e "CREATE DATABASE IF NOT EXISTS laravel;"

if ($LASTEXITCODE -ne 0) {
    throw "Failed to create the Laravel CI database."
}

Write-Host "CI database created."

Write-Host "==> Preparing .env" -ForegroundColor Cyan

if (Test-Path $EnvFile) {
    Copy-Item $EnvFile $BackupEnvFile -Force
    $BackupCreated = $true
    Write-Host "Backed up existing .env"
}

Copy-Item $CiEnvFile $EnvFile -Force
$TemporaryEnvCreated = $true

Write-Host "==> Installing Composer dependencies" -ForegroundColor Cyan

composer install `
    -q `
    --no-progress `
    --prefer-dist `
    --no-interaction `
    --no-suggest `
    --optimize-autoloader `
    --no-scripts

if ($LASTEXITCODE -ne 0) {
    throw "Composer install failed."
}

Write-Host "==> Clearing Laravel configuration" -ForegroundColor Cyan

php artisan config:clear

if ($LASTEXITCODE -ne 0) {
    throw "php artisan config:clear failed."
}

php artisan cache:clear

if ($LASTEXITCODE -ne 0) {
    throw "php artisan cache:clear failed."
}

Write-Host "==> Generating application key" -ForegroundColor Cyan

php artisan key:generate

if ($LASTEXITCODE -ne 0) {
    throw "php artisan key:generate failed."
}

Write-Host "==> Running migrations" -ForegroundColor Cyan

php artisan migrate --force -v

if ($LASTEXITCODE -ne 0) {
    throw "php artisan migrate failed."
}

Write-Host "==> Installing Node dependencies" -ForegroundColor Cyan

npm ci

if ($LASTEXITCODE -ne 0) {
    throw "npm ci failed."
}

Write-Host "==> Building frontend" -ForegroundColor Cyan

npm run build

if ($LASTEXITCODE -ne 0) {
    throw "npm run build failed."
}

Write-Host "==> Running Pest" -ForegroundColor Cyan

.\vendor\bin\pest

if ($LASTEXITCODE -ne 0) {
    throw "Pest reported failing tests."
}

$TestSucceeded = $true

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "CI test suite passed." -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green


}
finally {
Cleanup
}