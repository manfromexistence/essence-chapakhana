# Production Deployment Guide - Fix Orders Route 404

## Issue
Getting 404 error when accessing `/orders` page on production server.

---

## Quick Fix (Run on Production Server)

### Option 1: Using Script (Recommended)

**For Linux/Mac:**
```bash
chmod +x fix-orders-route.sh
./fix-orders-route.sh
```

**For Windows:**
```bash
fix-orders-route.bat
```

### Option 2: Manual Commands

Run these commands on your production server:

```bash
# 1. Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Create storage link
php artisan storage:link

# 4. Set permissions (Linux only)
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 5. Verify routes exist
php artisan route:list | grep orders
```

---

## Verify Routes Are Registered

Run this command to check if routes exist:

```bash
php artisan route:list | grep orders
```

**Expected Output:**
```
GET|HEAD  orders ................. orders.index › UserOrderController@index
GET|HEAD  orders/{order} ......... orders.show › UserOrderController@show
```

If you don't see these routes, the issue is with route registration.

---

## Common Issues & Solutions

### Issue 1: Routes Not Found After Deployment

**Cause:** Route cache not updated after deployment

**Solution:**
```bash
php artisan route:clear
php artisan route:cache
```

### Issue 2: 404 on All Routes

**Cause:** .htaccess not working or mod_rewrite disabled

**Solution:**

**For Apache:**
1. Enable mod_rewrite:
```bash
sudo a2enmod rewrite
sudo service apache2 restart
```

2. Check Apache config allows .htaccess:
```apache
<Directory /var/www/html/chapakhana/public>
    AllowOverride All
    Require all granted
</Directory>
```

**For Nginx:**
Add this to your site config:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### Issue 3: Permission Denied Errors

**Cause:** Wrong file permissions

**Solution:**
```bash
# Set correct permissions
sudo chown -R www-data:www-data /path/to/chapakhana
sudo chmod -R 755 /path/to/chapakhana/storage
sudo chmod -R 755 /path/to/chapakhana/bootstrap/cache
```

### Issue 4: Class Not Found Errors

**Cause:** Composer autoload not updated

**Solution:**
```bash
composer dump-autoload
php artisan clear-compiled
php artisan optimize
```

---

## Deployment Checklist

When deploying to production, always run:

```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
composer install --optimize-autoloader --no-dev

# 3. Run migrations
php artisan migrate --force

# 4. Clear and cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Storage link
php artisan storage:link

# 6. Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 7. Restart services (if needed)
sudo service apache2 restart
# OR
sudo service nginx restart
sudo service php8.4-fpm restart
```

---

## Testing After Deployment

### 1. Test Route Directly
```bash
curl -I https://chapakhana.notesofshahriar.com/orders
```

**Expected:** 302 redirect to login (if not authenticated) or 200 OK (if authenticated)
**Not Expected:** 404 Not Found

### 2. Test in Browser
1. Login to your account
2. Visit: `https://chapakhana.notesofshahriar.com/orders`
3. Should see orders page or empty state

### 3. Check Logs
```bash
tail -f storage/logs/laravel.log
```

Look for any errors when accessing `/orders`

---

## Server Configuration

### Apache Virtual Host Example

```apache
<VirtualHost *:80>
    ServerName chapakhana.notesofshahriar.com
    DocumentRoot /var/www/html/chapakhana/public

    <Directory /var/www/html/chapakhana/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/chapakhana-error.log
    CustomLog ${APACHE_LOG_DIR}/chapakhana-access.log combined
</VirtualHost>
```

### Nginx Server Block Example

```nginx
server {
    listen 80;
    server_name chapakhana.notesofshahriar.com;
    root /var/www/html/chapakhana/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Environment Configuration

Make sure your `.env` file on production has:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://chapakhana.notesofshahriar.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Cache
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database
```

---

## Debugging Steps

### 1. Enable Debug Mode Temporarily

In `.env`:
```env
APP_DEBUG=true
```

Visit the page and check the error message. **Remember to disable after debugging!**

### 2. Check Laravel Logs

```bash
tail -100 storage/logs/laravel.log
```

### 3. Check Web Server Logs

**Apache:**
```bash
tail -100 /var/log/apache2/error.log
```

**Nginx:**
```bash
tail -100 /var/log/nginx/error.log
```

### 4. Test Route Registration

```bash
php artisan tinker
```

Then in tinker:
```php
Route::getRoutes()->match(Request::create('/orders', 'GET'));
```

Should return route information, not throw exception.

---

## Files to Upload to Production

Make sure these files are on your production server:

```
✓ app/Http/Controllers/UserOrderController.php
✓ app/Models/OrderItem.php
✓ resources/views/orders/index.blade.php
✓ resources/views/orders/show.blade.php
✓ resources/views/partials/header.blade.php
✓ routes/auth.php
✓ routes/web.php
```

---

## Still Not Working?

### Check These:

1. **Is Laravel installed correctly?**
   ```bash
   php artisan --version
   ```

2. **Are dependencies installed?**
   ```bash
   composer install
   ```

3. **Is database connected?**
   ```bash
   php artisan migrate:status
   ```

4. **Are file permissions correct?**
   ```bash
   ls -la storage/
   ls -la bootstrap/cache/
   ```

5. **Is mod_rewrite enabled? (Apache)**
   ```bash
   apache2ctl -M | grep rewrite
   ```

6. **Is PHP version correct?**
   ```bash
   php -v
   ```
   Should be PHP 8.1 or higher

---

## Contact Support

If issue persists after trying all solutions:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check web server logs
3. Run: `php artisan route:list` and share output
4. Share error message from browser console
5. Share server configuration (Apache/Nginx)

---

## Quick Reference Commands

```bash
# Clear everything
php artisan optimize:clear

# Cache everything
php artisan optimize

# View all routes
php artisan route:list

# Check application status
php artisan about

# Test database connection
php artisan migrate:status
```

---

**Last Updated:** January 19, 2026  
**Status:** Production Deployment Guide
