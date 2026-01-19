# Database Seeding Guide - Chapakhana

## Quick Start

To reset and seed the database with all dummy data:

```bash
php artisan migrate:fresh --seed
```

This command will:
1. Drop all tables
2. Run all migrations
3. Seed all data automatically

## What Gets Seeded

### 1. Admin User
- Email: admin@chapakhana.com
- Password: password
- Role: Admin (is_admin = true)

### 2. Categories (5)
- Books
- Marketing
- Stationery
- Signage
- Packaging

### 3. Products (22)
All categories now have products:
- Books: 5 products
- Marketing: 5 products
- Stationery: 4 products
- Signage: 3 products
- Packaging: 5 products

### 4. Formats
Various product formats (Paperback, Hardback, Magazine, etc.)

### 5. Service Categories & Products
Service-related data for the services section

### 6. Page Sections
Frontend content management data

## Seeder Files

All seeders are called from `DatabaseSeeder.php`:

```php
$this->call([
    AdminUserSeeder::class,
    CategorySeeder::class,
    FormatSeeder::class,
    ProductSeeder::class,        // ← Contains 22 products
    ServiceCategorySeeder::class,
    AllServiceProductsSeeder::class,
    PageSectionSeeder::class,
]);
```

## Adding More Products

To add more products, edit `database/seeders/ProductSeeder.php`:

```php
[
    'category' => 'Books',  // Must match existing category name
    'title' => 'Your Product Title',
    'description' => 'Product description',
    'format' => 'Paperback',
    'price' => 10.00,
    'rating' => 4.5,
    'popularity' => 80,
    'stock' => true,
    'badge' => 'New',
    'image' => 'https://example.com/image.jpg',
],
```

Then run:
```bash
php artisan migrate:fresh --seed
```

## Testing After Seeding

1. Visit `/shop` to see all products
2. Test category filters
3. Test price range filter
4. Test search functionality
5. Test add to cart
6. Login as admin to manage products

## Troubleshooting

### Products not showing?
- Check if categories exist: `php artisan tinker` → `Category::all()`
- Verify products are active: `is_active = true`
- Clear cache: `php artisan cache:clear`

### Images not loading?
- Images use Unsplash URLs
- Check internet connection
- Replace with local images if needed

### Seeder fails?
- Check database connection in `.env`
- Ensure migrations ran successfully
- Check for duplicate slugs or unique constraint violations

## Production Note

⚠️ **DO NOT** run `migrate:fresh` in production!

For production, use:
```bash
php artisan migrate
php artisan db:seed --class=ProductSeeder  # Only if needed
```

## Custom Seeders

If you need to seed specific data without resetting everything:

```bash
# Seed only products
php artisan db:seed --class=ProductSeeder

# Seed only categories
php artisan db:seed --class=CategorySeeder

# Seed only admin user
php artisan db:seed --class=AdminUserSeeder
```

## Data Integrity

All seeded data includes:
- ✅ Proper relationships (category_id, etc.)
- ✅ Slugs for URLs
- ✅ Realistic prices and ratings
- ✅ Stock availability
- ✅ Active status
- ✅ Timestamps

## Need Help?

Contact the development team at Alphainno for assistance.
