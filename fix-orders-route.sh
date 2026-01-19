#!/bin/bash

# Fix Orders Route - Production Deployment Script
# Run this on your production server to fix the 404 error

echo "=========================================="
echo "Fixing Orders Route - Chapakhana"
echo "=========================================="
echo ""

# Step 1: Clear all caches
echo "Step 1: Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "✓ Caches cleared"
echo ""

# Step 2: Optimize for production
echo "Step 2: Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✓ Optimization complete"
echo ""

# Step 3: Verify routes
echo "Step 3: Verifying routes..."
php artisan route:list | grep orders
echo ""

# Step 4: Check permissions
echo "Step 4: Checking permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
echo "✓ Permissions set"
echo ""

# Step 5: Create storage link if needed
echo "Step 5: Creating storage link..."
php artisan storage:link
echo "✓ Storage linked"
echo ""

echo "=========================================="
echo "Fix Complete!"
echo "=========================================="
echo ""
echo "Please test the following URLs:"
echo "1. https://chapakhana.notesofshahriar.com/orders"
echo "2. Login and click 'My Orders' in profile dropdown"
echo ""
echo "If still not working, check:"
echo "1. Apache/Nginx configuration"
echo "2. .htaccess file"
echo "3. Laravel logs: storage/logs/laravel.log"
