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
   - File upload h

```bash
npm run build && "/c/Program Files/7-Zip/7z.exe" a -tzip ../chapakhana.zip . '-xr!node_modules' '-xr!.git' -mx=1
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
