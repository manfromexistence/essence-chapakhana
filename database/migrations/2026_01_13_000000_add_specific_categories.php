<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            [
                'name' => 'Magazines',
                'slug' => 'magazines',
                'description' => 'High-quality magazines and periodicals',
                'is_active' => true,
            ],
            [
                'name' => 'Catalogs',
                'slug' => 'catalogs',
                'description' => 'Product catalogs and listings',
                'is_active' => true,
            ],
            [
                'name' => 'Brochures',
                'slug' => 'brochures',
                'description' => 'Promotional brochures and flyers',
                'is_active' => true,
            ],
            [
                'name' => 'Business Cards',
                'slug' => 'business-cards',
                'description' => 'Professional business cards',
                'is_active' => true,
            ],
            [
                'name' => 'Invitation & Stationery',
                'slug' => 'postcards-invitations',
                'description' => 'Postcards, invitations, and personal stationery',
                'is_active' => true,
            ],
            [
                'name' => 'Banners',
                'slug' => 'banners',
                'description' => 'Large format banners',
                'is_active' => true,
            ],
            [
                'name' => 'Promotional Items',
                'slug' => 'promotional-items',
                'description' => 'Branded promotional merchandise',
                'is_active' => true,
            ],
            [
                'name' => 'Stickers',
                'slug' => 'stickers',
                'description' => 'Custom stickers and labels',
                'is_active' => true,
            ],
            [
                'name' => 'Booklets',
                'slug' => 'booklets',
                'description' => 'Multi-page booklets',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            // Check if slug exists to avoid duplicates
            if (DB::table('categories')->where('slug', $category['slug'])->doesntExist()) {
                DB::table('categories')->insert(array_merge($category, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $slugs = [
            'magazines',
            'catalogs',
            'brochures',
            'business-cards',
            'postcards-invitations',
            'banners',
            'promotional-items',
            'stickers',
            'booklets',
        ];

        DB::table('categories')->whereIn('slug', $slugs)->delete();
    }
};
