# Chapakhana

Chapakhana is a product of Nex Group and Developed by Alphainno.

## Recent Updates (January 19, 2026)

### ✅ Completed Tasks

1. **Design Request Integration** - Added design request fields to checkout process
   - Checkbox to enable design assistance
   - Text area for design requirements
   - File upload for reference materials (images, PDF, AI, PSD)
   - Stored in orders table with migration

2. **Order System Improvements**
   - Design request fields added to Order model
   - File upload handling for design files
   - Proper validation for design request data

3. **Registration Process Fixed**
   - Simplified password validation (removed complex Password::min rule)
   - Better error messages in Bangla and English
   - Minimum 2 characters for name validation
   - User-friendly registration form with icons

4. **Admin Panel Separation**
   - Admin panel is completely separate from user orders
   - Users access their orders via `/orders` route (My Orders page)
   - Admin accesses all orders via `/admin/orders` route
   - Admin middleware ensures only admin users can access admin panel
   - Regular users cannot access admin dashboard
   - "My Orders" link added to user profile dropdown in header

### 📋 Remaining Tasks

1. **Pricing Chart** - Pricing helper and component created
   - See `docs/PRICING_TABLE_USAGE.md` for implementation guide
   - Helper class: `app/Helpers/PricingHelper.php`
   - Component: `resources/views/components/pricing-table.blade.php`
   - Need to add to product pages

2. **Admin Dashboard Simplification** - Make admin dashboard easier to use

3. **Category Page Sidebar** - Show category pages as sidebar sub-menu items in admin panel

## Documentation

- **Task Fixes**: See `docs/TASK_FIXES_JAN_19.md` for detailed information
- **Pricing Guide**: See `docs/PRICING_TABLE_USAGE.md` for pricing implementation
- **My Orders**: See `docs/MY_ORDERS_FEATURE.md` for user orders feature
- **Architecture**: See `docs/ARCHITECTURE.md` for system overview

## Zip with windows 7-Zip

```bash
npm run build && "/c/Program Files/7-Zip/7z.exe" a -tzip ../chapakhana-updated.zip . '-xr!node_modules' '-xr!.git' -mx=1
```

### Cpanel Deploy

```bash
rm -f database/migrations/2026_01_13_100000_add_performance_indexes_to_products_table.php
rm -f database/migrations/2026_01_13_100001_add_performance_indexes_to_orders_table.php
rm -f database/migrations/2026_01_13_100002_add_performance_indexes_to_order_items_table.php
rm -f database/migrations/2026_01_13_100003_add_performance_indexes_to_categories_table.php

rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/*.php

php artisan key:generate && php artisan migrate:fresh --seed && rm -rf public/storage && php artisan storage:link
```


Chapakhana task
1. Pricing chart miss 
2. Order issues 
3. Design request not included 
4. Admin dashboard easy korte hobe . R admin panel r my order eksathe asbe na . Admin only for the owner not for user . 
5. Sign up process thik korte hobe

At admin panel category page we have list of all category pages but please make it as a sidebar sub-menu items and in the sidebar please show them correctly!!!!
