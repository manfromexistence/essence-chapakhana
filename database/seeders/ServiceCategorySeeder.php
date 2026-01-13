<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'Custom book printing services including paperback, hardback, and special finish books',
                'is_active' => true,
            ],
            [
                'name' => 'Business Cards',
                'slug' => 'business-cards',
                'description' => 'Professional business card printing services',
                'is_active' => true,
            ],
            [
                'name' => 'Stickers',
                'slug' => 'stickers',
                'description' => 'Custom stickers and labels printing for various uses',
                'is_active' => true,
            ],
            [
                'name' => 'Postcards & Invitations',
                'slug' => 'postcards-invitations',
                'description' => 'Custom postcards and invitation printing for special occasions',
                'is_active' => true,
            ],
            [
                'name' => 'Booklets',
                'slug' => 'booklets',
                'description' => 'Professional booklet printing services',
                'is_active' => true,
            ],
            [
                'name' => 'Catalogs',
                'slug' => 'catalogs',
                'description' => 'Professional catalog printing services',
                'is_active' => true,
            ],
            [
                'name' => 'Magazines',
                'slug' => 'magazines',
                'description' => 'Magazine printing services for publishers',
                'is_active' => true,
            ],
            [
                'name' => 'Brochures',
                'slug' => 'brochures',
                'description' => 'High-quality brochure and flyer printing services',
                'is_active' => true,
            ],
            [
                'name' => 'Banners',
                'slug' => 'banners',
                'description' => 'Large format banner and signage printing',
                'is_active' => true,
            ],
            [
                'name' => 'Stationery',
                'slug' => 'stationery',
                'description' => 'Custom stationery printing including letterheads, envelopes, and more',
                'is_active' => true,
            ],
            [
                'name' => 'Promotional Items',
                'slug' => 'promotional-items',
                'description' => 'Custom promotional item printing for marketing and branding',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing Materials',
                'slug' => 'marketing',
                'description' => 'Professional marketing material printing services',
                'is_active' => true,
            ],
            [
                'name' => 'Signage',
                'slug' => 'signage',
                'description' => 'Professional signage printing for businesses',
                'is_active' => true,
            ],
            [
                'name' => 'Packaging',
                'slug' => 'packaging',
                'description' => 'Custom packaging printing services',
                'is_active' => true,
            ],
            [
                'name' => 'Zines',
                'slug' => 'zines',
                'description' => 'Independent publication and zine printing',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => $category['is_active'],
                ]
            );
        }
    }
}
