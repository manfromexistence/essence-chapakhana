@echo off
REM Fix Orders Route - Production Deployment Script (Windows)
REM Run this on your production server to fix the 404 error

echo ==========================================
echo Fixing Orders Route - Chapakhana
echo ==========================================
echo.

REM Step 1: Clear all caches
echo Step 1: Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo [OK] Caches cleared
echo.

REM Step 2: Optimize for production
echo Step 2: Optimizing for production...
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo [OK] Optimization complete
echo.

REM Step 3: Verify routes
echo Step 3: Verifying routes...
php artisan route:list | findstr orders
echo.

REM Step 4: Create storage link if needed
echo Step 4: Creating storage link...
php artisan storage:link
echo [OK] Storage linked
echo.

echo ==========================================
echo Fix Complete!
echo ==========================================
echo.
echo Please test the following URLs:
echo 1. https://chapakhana.notesofshahriar.com/orders
echo 2. Login and click 'My Orders' in profile dropdown
echo.
echo If still not working, check:
echo 1. Web server configuration
echo 2. .htaccess file
echo 3. Laravel logs: storage/logs/laravel.log

pause
