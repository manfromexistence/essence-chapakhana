<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class ZinesServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'zines')->first();

        if (! $category) {
            $this->command->error('Zines category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Half-Size Zine',
                'description' => 'Classic half-letter size zine, perfect for DIY publications and indie content.',
                'price' => 8.00,
                'image' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Mini Zine',
                'description' => 'Pocket-sized mini zines from a single sheet of paper. Quick and affordable.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Quarter-Size Zine',
                'description' => 'Compact quarter-size format for portable reading and easy distribution.',
                'price' => 6.00,
                'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Full-Size Zine',
                'description' => 'Standard letter-size zine with more space for content and artwork.',
                'price' => 12.00,
                'image' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Saddle-Stitched Zine',
                'description' => 'Traditional stapled binding for zines up to 64 pages.',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Perfect Bound Zine',
                'description' => 'Professional square spine binding for thicker zine publications.',
                'price' => 15.00,
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Art Zine',
                'description' => 'High-quality paper for art reproductions and photography zines.',
                'price' => 18.00,
                'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Comic Zine',
                'description' => 'Optimized for comic strips and graphic storytelling.',
                'price' => 9.00,
                'image' => 'https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Literary Zine',
                'description' => 'Text-focused zines for poetry, short stories, and essays.',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=400&fit=crop',
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

        $this->command->info('Zines service products seeded successfully!');
    }
}
