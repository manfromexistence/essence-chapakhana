<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class StickersLabelsServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'stickers')->first();

        if (! $category) {
            $this->command->error('Stickers category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Vinyl Stickers',
                'description' => 'Durable waterproof vinyl stickers, perfect for indoor and outdoor use. Weather-resistant and long-lasting.',
                'price' => 3.50,
                'image' => 'https://images.unsplash.com/photo-1572375992501-4b0892d50c69?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Die-Cut Stickers',
                'description' => 'Custom-shaped stickers cut to your exact design. Unique shapes for brand recognition.',
                'price' => 4.00,
                'image' => 'https://images.unsplash.com/photo-1594843871665-fcd39c05c3e0?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Round Stickers',
                'description' => 'Classic circular stickers in various sizes. Perfect for packaging, promotions, and branding.',
                'price' => 2.50,
                'image' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Square Stickers',
                'description' => 'Professional square stickers for labels, packaging, and promotional materials.',
                'price' => 2.50,
                'image' => 'https://images.unsplash.com/photo-1622547748225-3fc4abd2cca0?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Bumper Stickers',
                'description' => 'Large durable stickers for vehicles and outdoor use. Weather and UV resistant.',
                'price' => 6.00,
                'image' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Product Labels',
                'description' => 'Professional labels for product packaging with custom designs and sizes.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Clear Stickers',
                'description' => 'Transparent stickers with printed designs. Professional look on any surface.',
                'price' => 4.50,
                'image' => 'https://images.unsplash.com/photo-1607082349566-187342175e2f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Holographic Stickers',
                'description' => 'Eye-catching holographic finish that changes with light and viewing angle.',
                'price' => 5.50,
                'image' => 'https://images.unsplash.com/photo-1618241370699-62a9e66c8600?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Roll Labels',
                'description' => 'Labels on rolls for easy application and storage. Ideal for high-volume needs.',
                'price' => 8.00,
                'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=400&fit=crop',
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

        $this->command->info('Stickers & Labels service products seeded successfully!');
    }
}
