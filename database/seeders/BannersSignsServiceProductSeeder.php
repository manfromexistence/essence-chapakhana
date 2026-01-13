<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class BannersSignsServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'banners')->first();

        if (! $category) {
            $this->command->error('Banners category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Vinyl Banners',
                'description' => 'Durable outdoor vinyl banners with grommets for easy hanging. Weather-resistant and long-lasting.',
                'price' => 25.00,
                'image' => 'https://images.unsplash.com/photo-1557821552-17105176677c?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Retractable Banners',
                'description' => 'Portable roll-up banners with stand. Perfect for trade shows and presentations.',
                'price' => 45.00,
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Mesh Banners',
                'description' => 'Wind-resistant mesh material for outdoor use. Ideal for fences and building wraps.',
                'price' => 30.00,
                'image' => 'https://images.unsplash.com/photo-1485217988980-11786ced9454?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Fabric Banners',
                'description' => 'Premium fabric banners with elegant drape and wrinkle-resistant finish.',
                'price' => 35.00,
                'image' => 'https://images.unsplash.com/photo-1577996693428-f362ec1e4c5e?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Step and Repeat Banners',
                'description' => 'Custom backdrop banners with repeating logos. Perfect for photo opportunities and events.',
                'price' => 50.00,
                'image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Yard Signs',
                'description' => 'Corrugated plastic signs with stakes for outdoor advertising and events.',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1603532648955-039310d9ed75?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'A-Frame Signs',
                'description' => 'Double-sided sidewalk signs for storefront advertising. Foldable and portable.',
                'price' => 40.00,
                'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Window Clings',
                'description' => 'Static-cling vinyl for windows. Easy to apply and remove without residue.',
                'price' => 15.00,
                'image' => 'https://images.unsplash.com/photo-1574180566232-aaad1b5b8450?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Foam Board Signs',
                'description' => 'Lightweight foam core signs for indoor displays and presentations.',
                'price' => 12.00,
                'image' => 'https://images.unsplash.com/photo-1610296669228-602fa827fc1f?w=400&h=400&fit=crop',
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

        $this->command->info('Banners & Signs service products seeded successfully!');
    }
}
