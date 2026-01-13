<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'description' => 'All types of books including paperbacks, hardbacks, and special editions',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Marketing materials including lookbooks, magazines, and catalogs',
                'is_active' => true,
            ],
            [
                'name' => 'Stationery',
                'slug' => 'stationery',
                'description' => 'Office and personal stationery items',
                'is_active' => true,
            ],
            [
                'name' => 'Signage',
                'slug' => 'signage',
                'description' => 'Posters and large format prints',
                'is_active' => true,
            ],
            [
                'name' => 'Packaging',
                'slug' => 'packaging',
                'description' => 'Custom packaging solutions and product boxes',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
