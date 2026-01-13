<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class StationeryServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ServiceCategory::where('slug', 'stationery')->first();

        if (! $category) {
            $this->command->error('Stationery category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Letterheads',
                'description' => 'Professional branded letterheads for business correspondence. Custom design and premium paper.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Envelopes',
                'description' => 'Custom printed envelopes in various sizes. Professional branding for all mailings.',
                'price' => 3.50,
                'image' => 'https://images.unsplash.com/photo-1596275469886-439d6e6a62e3?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Notepads',
                'description' => 'Branded notepads with multiple pages. Perfect for notes and memos.',
                'price' => 8.00,
                'image' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Presentation Folders',
                'description' => 'Professional folders with pockets for proposals and presentations.',
                'price' => 12.00,
                'image' => 'https://images.unsplash.com/photo-1586339949916-3e9457bef6d3?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Appointment Cards',
                'description' => 'Small cards for appointment reminders and contact information.',
                'price' => 4.00,
                'image' => 'https://images.unsplash.com/photo-1561070791-36c11767b26a?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Invoices & Forms',
                'description' => 'Custom business forms, invoices, and receipts with carbonless copies.',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Thank You Cards',
                'description' => 'Elegant thank you cards for business and personal use.',
                'price' => 6.00,
                'image' => 'https://images.unsplash.com/photo-1526548319911-7bb3f09df88a?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Greeting Cards',
                'description' => 'Custom greeting cards for holidays and special occasions.',
                'price' => 6.00,
                'image' => 'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Postcards',
                'description' => 'Standard and custom size postcards for marketing and announcements.',
                'price' => 4.50,
                'image' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Compliment Slips',
                'description' => 'Small branded slips to accompany documents and packages.',
                'price' => 3.00,
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

        $this->command->info('Stationery service products seeded successfully!');
    }
}
