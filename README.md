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


Chapakhana task
1. Pricing chart miss 
2. Order issues 
3. Design request not included 
4. Admin dashboard easy korte hobe . R admin panel r my order eksathe asbe na . Admin only for the owner not for user . 
5. Sign up process thik korte hobe

At admin panel category page we have list of all category pages but please make it as a sidebar sub-menu items and in the sidebar please show them correctly!!!!
