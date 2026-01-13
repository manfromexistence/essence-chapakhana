<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class CatalogsServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'catalogs')->first();

        if (! $category) {
            $this->command->error('Catalogs category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Product Catalog',
                'description' => 'Professional product catalogs with full-color pages. Perfect for showcasing your entire product line.',
                'price' => 30.00,
                'image' => 'https://images.unsplash.com/photo-1513542789411-b6a5d4f31634?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Sales Catalog',
                'description' => 'High-quality sales catalogs with pricing and product details. Essential for B2B communications.',
                'price' => 28.00,
                'image' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Trade Show Catalog',
                'description' => 'Compact catalogs designed for trade shows and exhibitions. Easy to distribute.',
                'price' => 25.00,
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Saddle-Stitched Catalog',
                'description' => 'Stapled binding for smaller catalogs up to 64 pages. Cost-effective solution.',
                'price' => 20.00,
                'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Perfect Bound Catalog',
                'description' => 'Square spine binding for professional look. Suitable for larger page counts.',
                'price' => 35.00,
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Spiral Bound Catalog',
                'description' => 'Coil binding allows catalog to lay flat. Durable and practical.',
                'price' => 32.00,
                'image' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Fashion Lookbook',
                'description' => 'Fashion and lifestyle catalogs with high-quality image reproduction.',
                'price' => 40.00,
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            ServiceProduct::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($product['name'])],
                [
                    'service_category_id' => $category->id,
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'is_active' => $product['is_active'],
                ]
            );
        }

        $this->command->info('Catalogs service products seeded successfully!');
    }
}
