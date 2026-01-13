<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class MagazinesServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'magazines')->first();

        if (! $category) {
            $this->command->error('Magazines category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Saddle-Stitched Magazine',
                'description' => 'Traditional magazine binding with staples. Perfect for issues up to 64 pages.',
                'price' => 18.00,
                'image' => 'https://images.unsplash.com/photo-1555485038-a63855aa7ba9?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Perfect Bound Magazine',
                'description' => 'Professional square spine binding for thicker magazines. Durable and premium look.',
                'price' => 25.00,
                'image' => 'https://images.unsplash.com/photo-1551447180-63d0e0a4e5bd?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Glossy Magazine',
                'description' => 'High-gloss cover and pages for vibrant photography and graphics.',
                'price' => 22.00,
                'image' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Matte Magazine',
                'description' => 'Sophisticated matte finish for upscale editorial content.',
                'price' => 22.00,
                'image' => 'https://images.unsplash.com/photo-1540281733-3ba4a0c27f79?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Digest Size Magazine',
                'description' => 'Compact 5.5" x 8.5" format, perfect for portable reading.',
                'price' => 15.00,
                'image' => 'https://images.unsplash.com/photo-1476242906366-d8eb64c2f661?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'A4 Magazine',
                'description' => 'Standard international magazine size with professional appearance.',
                'price' => 20.00,
                'image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Custom Size Magazine',
                'description' => 'Unique custom dimensions for distinctive publications.',
                'price' => 28.00,
                'image' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Newsletter',
                'description' => 'Simple format newsletters for regular communications and updates.',
                'price' => 12.00,
                'image' => 'https://images.unsplash.com/photo-1586339949916-3e9457bef6d3?w=400&h=400&fit=crop',
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

        $this->command->info('Magazines service products seeded successfully!');
    }
}
