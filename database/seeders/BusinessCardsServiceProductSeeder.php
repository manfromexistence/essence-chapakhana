<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class BusinessCardsServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'business-cards')->first();

        if (! $category) {
            $this->command->error('Business Cards category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Classic Business Cards',
                'description' => 'Traditional business cards with professional design, perfect for any industry. Standard size with various paper options.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Square Business Cards',
                'description' => 'Stand out with unique square-shaped business cards. Modern design that makes a memorable impression.',
                'price' => 7.00,
                'image' => 'https://images.unsplash.com/photo-1563906267088-b029e7101114?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Rounded Corner Cards',
                'description' => 'Soft rounded corners add a touch of sophistication to your business cards. Comfortable to handle.',
                'price' => 6.00,
                'image' => 'https://images.unsplash.com/photo-1611926653670-1e4a8ef3cf70?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Matte Business Cards',
                'description' => 'Elegant matte finish that resists fingerprints and smudges. Professional and durable.',
                'price' => 8.00,
                'image' => 'https://images.unsplash.com/photo-1557821552-17105176677c?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Glossy Business Cards',
                'description' => 'High-gloss finish for vibrant colors and sharp images. Eye-catching and professional.',
                'price' => 8.00,
                'image' => 'https://images.unsplash.com/photo-1635776062127-d379bfcba9f8?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Premium Business Cards',
                'description' => 'Ultra-thick premium cards with luxury feel. Perfect for making a lasting impression.',
                'price' => 12.00,
                'image' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Foil Business Cards',
                'description' => 'Metallic foil accents add elegance and shine. Available in gold, silver, and copper.',
                'price' => 15.00,
                'image' => 'https://images.unsplash.com/photo-1559526324-593bc073d938?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Textured Business Cards',
                'description' => 'Unique textured finishes including linen, felt, and leather patterns.',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1598520106830-8c45c2035460?w=400&h=400&fit=crop',
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

        $this->command->info('Business Cards service products seeded successfully!');
    }
}
