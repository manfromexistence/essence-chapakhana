# Production 404 Fix - Orders Route

## 🚨 Issue
Getting `404 Not Found` error when accessing `/orders` page on production server.

---

## ⚡ Quick Fix (Do This First!)

### Step 1: Upload Test File
1. Upload `test-routes.php` to your `public/` folder
2. Visit: `https://chapakhana.notesofshahriar.com/test-routes.php`
3. This will show you exactly what's wrong

### Step 2: Run Fix Commands

**SSH into your server and run:**

```bash
cd /path/to/chapakhana

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verify routes exist
php artisan route:list | grep orders
```

**Expected output:**
```
GET|HEAD  orders ................. orders.index › UserOrderController@index
GET|HEAD  orders/{order} ......... orders.show › UserOrderController@show
```

### Step 3: Test Again
Visit: `https://chapakhana.notesofshahriar.com/orders`

---

## 🔧 If Still Not Working

### Option A: Use Automated Script

**Upload and run:**
```bash
# For Linux/Mac
chmod +x fix-orders-route.sh
./fix-orders-route.sh

# For Windows
fix-orders-route.bat
```

### Option B: Manual Deployment

1. **Ensure all files are uploaded:**
   ```
   ✓ app/Http/Controllers/UserOrderController.php
   ✓ app/Models/OrderItem.php
   ✓ resources/views/orders/index.blade.php
   ✓ resources/views/orders/show.blade.php
   ✓ resources/views/partials/header.blade.php
   ✓ routes/auth.php
   ```

2. **Run composer:**
   ```bash
   composer dump-autoload
   ```

3. **Clear and cache:**
   ```bash
   php artisan optimize:clear
   php artisan optimize
   ```

4. **Set permissions:**
   ```bash
   chmod -R 755 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

---

## 🔍 Debugging

### Check 1: Are Routes Registered?
```bash
php artisan route:list | grep orders
```

If no output → Routes not registered → Run `php artisan route:cache`

### Check 2: Is Controller Found?
```bash
php artisan tinker
```
Then:
```php
new App\Http\Controllers\UserOrderController();
```

If error → Controller not uploaded or autoload issue → Run `composer dump-autoload`

### Check 3: Are Views Present?
```bash
ls -la resources/views/orders/
```

Should show:
- `index.blade.php`
- `show.blade.php`

If missing → Upload view files

### Check 4: Check Laravel Logs
```bash
tail -50 storage/logs/laravel.log
```

Look for errors related to routes or controllers.

### Check 5: Check Web Server Logs

**Apache:**
```bash
tail -50 /var/log/apache2/error.log
```

**Nginx:**
```bash
tail -50 /var/log/nginx/error.log
```

---

## 🌐 Server Configuration

### Apache (.htaccess should work)

Make sure `mod_rewrite` is enabled:
```bash
sudo a2enmod rewrite
sudo service apache2 restart
```

### Nginx (Add to config)

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

Then restart:
```bash
sudo service nginx restart
```

---

## 📋 Complete Deployment Checklist

Run these commands in order:

```bash
# 1. Navigate to project
cd /path/to/chapakhana

# 2. Pull latest code (if using git)
git pull origin main

# 3. Install/update dependencies
composer install --optimize-autoloader --no-dev

# 4. Run migrations
php artisan migrate --force

# 5. Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 6. Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Create storage link
php artisan storage:link

# 8. Set permissions (Linux)
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 9. Restart web server
sudo service apache2 restart
# OR
sudo service nginx restart

# 10. Verify routes
php artisan route:list | grep orders
```

---

## ✅ Verification

After running fixes, test these:

### Test 1: Direct URL
```bash
curl -I https://chapakhana.notesofshahriar.com/orders
```

**Expected:** `302 Found` (redirect to login) or `200 OK` (if logged in)  
**Not Expected:** `404 Not Found`

### Test 2: Browser Test
1. Login to your account
2. Click profile dropdown
3. Click "My Orders"
4. Should see orders page

### Test 3: Check Test File
Visit: `https://chapakhana.notesofshahriar.com/test-routes.php`

Should show green checkmarks for:
- ✓ Laravel loaded successfully
- ✓ Found orders routes
- ✓ UserOrderController exists
- ✓ Order model exists
- ✓ OrderItem model exists
- ✓ Views exist

**⚠️ Delete test-routes.php after testing!**

---

## 🆘 Common Issues

### Issue: "Class UserOrderController not found"
**Fix:**
```bash
composer dump-autoload
php artisan clear-compiled
```

### Issue: "View [orders.index] not found"
**Fix:**
```bash
# Upload view files to resources/views/orders/
php artisan view:clear
```

### Issue: "Route [orders.index] not defined"
**Fix:**
```bash
php artisan route:clear
php artisan route:cache
```

### Issue: All routes return 404
**Fix:**
```bash
# Check .htaccess exists in public/
# Enable mod_rewrite (Apache)
sudo a2enmod rewrite
sudo service apache2 restart
```

---

## 📞 Still Need Help?

If none of the above works, provide:

1. Output of: `php artisan route:list | grep orders`
2. Output of: `php artisan about`
3. Content of: `storage/logs/laravel.log` (last 50 lines)
4. Screenshot of test-routes.php output
5. Your web server (Apache/Nginx) and version

---

## 📁 Files Included

- `test-routes.php` - Route testing script
- `fix-orders-route.sh` - Linux/Mac fix script
- `fix-orders-route.bat` - Windows fix script
- `PRODUCTION_DEPLOYMENT_GUIDE.md` - Complete deployment guide
- `PRODUCTION_404_FIX.md` - This file

---

**Priority:** HIGH  
**Status:** Awaiting Production Deployment  
**Date:** January 19, 2026

---

## 🎯 Expected Result

After applying fixes:
- ✅ `/orders` page loads without 404
- ✅ Users can see their orders
- ✅ "My Orders" link works in header
- ✅ Order details page works
- ✅ No errors in logs
