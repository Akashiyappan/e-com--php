@echo off
REM Laravel E-Commerce Project Setup Script for Windows
echo ========================================
echo Laravel E-Commerce Local Setup
echo ========================================
echo.

REM Check if PHP is installed
php -v >nul 2>&1
if %errorlevel% neq 0 (
    echo Error: PHP is not installed or not in PATH
    pause
    exit /b 1
)

REM Check if MySQL is running
echo Checking MySQL connection...
mysql -u root -h 127.0.0.1 -e "SELECT 1" >nul 2>&1
if %errorlevel% neq 0 (
    echo Warning: Cannot connect to MySQL. Make sure MySQL is running with:
    echo - Host: 127.0.0.1
    echo - Username: root
    echo - Password: (empty or your password - update .env)
    echo.
)

REM Create database if not exists
echo Creating database php_project...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS php_project;"

REM Install Composer dependencies
echo.
echo Installing Composer dependencies...
call composer install

REM Generate APP_KEY if not exists
echo.
echo Generating application key...
php artisan key:generate

REM Run migrations
echo.
echo Running database migrations...
php artisan migrate --force

REM Seed the database
echo.
echo Seeding database with sample data...
php artisan db:seed

REM Clear cache
echo.
echo Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear

echo.
echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Your API endpoints are available at:
echo - Products: http://localhost:8000/api/products
echo - Orders: http://localhost:8000/api/orders
echo.
echo To start the development server, run:
echo   php artisan serve
echo.
pause
