<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class BrochuresFlyersServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'brochures')->first();

        if (! $category) {
            $this->command->error('Brochures category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Tri-Fold Brochures',
                'description' => 'Classic three-panel brochures perfect for product information and event promotions.',
                'price' => 4.00,
                'image' => 'https://images.unsplash.com/photo-1576670393302-bc2c44473f0f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Bi-Fold Brochures',
                'description' => 'Simple two-panel design ideal for menus, programs, and presentations.',
                'price' => 3.50,
                'image' => 'https://images.unsplash.com/photo-1566430919742-e5a6d00bedb7?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Z-Fold Brochures',
                'description' => 'Accordion-style folding for unique presentations and easy reading.',
                'price' => 4.50,
                'image' => 'https://images.unsplash.com/photo-1523633589114-88eaf4b4f1a8?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Gate Fold Brochures',
                'description' => 'Elegant opening design with two panels folding inward. Premium presentation.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1611162618071-b39a2ec055fb?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'A4 Flyers',
                'description' => 'Standard single-page flyers for promotions, events, and announcements.',
                'price' => 2.00,
                'image' => 'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'A5 Flyers',
                'description' => 'Compact half-size flyers perfect for handouts and direct mail.',
                'price' => 1.50,
                'image' => 'https://images.unsplash.com/photo-1594908900066-3f47337549d8?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Rack Cards',
                'description' => 'Slim 4x9 inch cards perfect for display racks at hotels, restaurants, and tourist centers.',
                'price' => 3.00,
                'image' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Leaflets',
                'description' => 'Single-page information sheets for promotions and announcements.',
                'price' => 1.00,
                'image' => 'https://images.unsplash.com/photo-1586339949216-35c2747656ca?w=400&h=400&fit=crop',
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

        $this->command->info('Brochures & Flyers service products seeded successfully!');
    }
}
