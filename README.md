# Chapakhana

Chapakhana is a product of Nex Group and Developed by Alphainno.

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

## Recent Updates (January 19, 2026)

### ✅ Completed Tasks:

1. **Sign Up Process Fixed**
   - Added proper validation with custom error messages
   - Added terms and conditions acceptance
   - Improved user feedback and error handling
   - Explicit non-admin user creation

2. **User Orders Separated from Admin**
   - Created dedicated `/orders` route for regular users
   - New UserOrderController for user-specific order management
   - User orders page with clean UI showing order history
   - Detailed order view page with status tracking
   - Admin orders remain separate at `/admin/orders`

3. **Design Request Feature Added**
   - Added design request fields to orders table
   - Support for design file uploads
   - Design request notes field
   - Ready for checkout integration

4. **Pricing Display Component**
   - Created reusable pricing table component
   - Supports tiered pricing display
   - Ready for service product integration

5. **Shop Admin Panel Image Preview Fixed**
   - Fixed default shop cover image not showing in preview
   - Enhanced AdminImageInput component for better compatibility
   - Now properly displays existing images on page load

6. **Shop Page Improvements - COMPLETE ✅**
   - ✅ Fixed range slider - thumb perfectly centered on track (margin-top: -7px)
   - ✅ Increased thumb size to 20px for better visibility
   - ✅ Added smooth hover effects with scale transform
   - ✅ Seeded **52 PRODUCTS** across all 14 categories (was 25)
   - ✅ Every category now has 3-5 products
   - ✅ Realistic BDT pricing (৳120 to ৳3800)
   - ✅ Professional product descriptions and images
   - ✅ Variety of formats, badges, and price points

### 🔄 Pending Tasks:

1. **Pricing Chart Integration**
   - Integrate pricing component with service products
   - Add pricing data to product pages

2. **Order Issues**
   - Test order creation flow
   - Verify order status updates

3. **Admin Dashboard Simplification**
   - Simplify admin dashboard UI
   - Remove user-facing features from admin panel
   - Focus on management tools only

### Next Steps:

Run migration to add design request fields:
```bash
php artisan migrate
```
