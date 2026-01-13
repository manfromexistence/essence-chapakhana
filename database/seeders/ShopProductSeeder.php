<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ShopProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories first
        $categories = [
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'Professional book printing services including paperback, hardback, and custom formats',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Marketing materials including brochures, flyers, and promotional items',
                'is_active' => true,
            ],
            [
                'name' => 'Stationery',
                'slug' => 'stationery',
                'description' => 'Business stationery, letterheads, envelopes, and more',
                'is_active' => true,
            ],
            [
                'name' => 'Signage',
                'slug' => 'signage',
                'description' => 'Indoor and outdoor signage solutions',
                'is_active' => true,
            ],
            [
                'name' => 'Packaging',
                'slug' => 'packaging',
                'description' => 'Custom packaging and box solutions',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(['slug' => $categoryData['slug']], $categoryData);
        }

        // Get category IDs
        $booksCategory = Category::where('slug', 'books')->first();
        $marketingCategory = Category::where('slug', 'marketing')->first();
        $stationeryCategory = Category::where('slug', 'stationery')->first();
        $signageCategory = Category::where('slug', 'signage')->first();
        $packagingCategory = Category::where('slug', 'packaging')->first();

        // Sample products
        $products = [
            // Books
            [
                'category_id' => $booksCategory->id,
                'title' => 'Paperback Book Bundle',
                'slug' => 'paperback-book-bundle',
                'description' => 'Lightweight novel-ready sets with recycled interiors.',
                'format' => 'Paperback',
                'price' => 8.50,
                'rating' => 4.6,
                'popularity' => 95,
                'stock' => true,
                'badge' => 'New',
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $booksCategory->id,
                'title' => 'Hardback Photo Book',
                'slug' => 'hardback-photo-book',
                'description' => 'Gallery-grade binding with matte cover options.',
                'format' => 'Hardback',
                'price' => 24.00,
                'rating' => 4.8,
                'popularity' => 88,
                'stock' => true,
                'badge' => 'Bestseller',
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $booksCategory->id,
                'title' => 'Cookbook Print Set',
                'slug' => 'cookbook-print-set',
                'description' => 'Lay-flat binding for recipe pages.',
                'format' => 'Cookbook',
                'price' => 18.00,
                'rating' => 4.7,
                'popularity' => 75,
                'stock' => true,
                'badge' => null,
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $booksCategory->id,
                'title' => 'Leaflet Bundle',
                'slug' => 'leaflet-bundle',
                'description' => 'Tri-fold or bi-fold designs, glossy finish.',
                'format' => 'Leaflet',
                'price' => 3.50,
                'rating' => 4.5,
                'popularity' => 82,
                'stock' => true,
                'badge' => null,
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],

            // Marketing
            [
                'category_id' => $marketingCategory->id,
                'title' => 'Magazine Run',
                'slug' => 'magazine-run',
                'description' => 'Quick-turn glossy mags for launches.',
                'format' => 'Magazine',
                'price' => 4.20,
                'rating' => 4.2,
                'popularity' => 70,
                'stock' => true,
                'badge' => 'Bulk',
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $marketingCategory->id,
                'title' => 'Brochure Pack',
                'slug' => 'brochure-pack',
                'description' => 'Full-color marketing brochures with multiple fold options.',
                'format' => 'Brochure',
                'price' => 12.00,
                'rating' => 4.5,
                'popularity' => 85,
                'stock' => true,
                'badge' => null,
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $marketingCategory->id,
                'title' => 'Flyer Set',
                'slug' => 'flyer-set',
                'description' => 'A5 promotional flyers, high-quality print.',
                'format' => 'Flyer',
                'price' => 2.50,
                'rating' => 4.3,
                'popularity' => 90,
                'stock' => true,
                'badge' => 'Popular',
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],

            // Stationery
            [
                'category_id' => $stationeryCategory->id,
                'title' => 'Business Card Premium',
                'slug' => 'business-card-premium',
                'description' => 'Matt or gloss finish, 400gsm quality.',
                'format' => 'Business Card',
                'price' => 15.00,
                'rating' => 4.9,
                'popularity' => 98,
                'stock' => true,
                'badge' => 'Premium',
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $stationeryCategory->id,
                'title' => 'Letterhead Set',
                'slug' => 'letterhead-set',
                'description' => 'Professional company letterheads, customizable.',
                'format' => 'Letterhead',
                'price' => 8.00,
                'rating' => 4.6,
                'popularity' => 72,
                'stock' => true,
                'badge' => null,
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],

            // Signage
            [
                'category_id' => $signageCategory->id,
                'title' => 'Banner Large Format',
                'slug' => 'banner-large-format',
                'description' => 'Weather-resistant outdoor banners.',
                'format' => 'Banner',
                'price' => 45.00,
                'rating' => 4.7,
                'popularity' => 65,
                'stock' => true,
                'badge' => null,
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
            [
                'category_id' => $signageCategory->id,
                'title' => 'Poster Print A1',
                'slug' => 'poster-print-a1',
                'description' => 'High-resolution poster printing.',
                'format' => 'Poster',
                'price' => 12.50,
                'rating' => 4.4,
                'popularity' => 78,
                'stock' => true,
                'badge' => null,
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],

            // Packaging
            [
                'category_id' => $packagingCategory->id,
                'title' => 'Custom Box Packaging',
                'slug' => 'custom-box-packaging',
                'description' => 'Branded packaging boxes, various sizes.',
                'format' => 'Box',
                'price' => 22.00,
                'rating' => 4.8,
                'popularity' => 88,
                'stock' => true,
                'badge' => 'Custom',
                'image' => '/images/placeholder-product.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }

        $this->command->info('Shop products seeded successfully!');
    }
}
