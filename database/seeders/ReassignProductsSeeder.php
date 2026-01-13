<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ReassignProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get new category IDs
        $magazines = Category::where('slug', 'magazines')->first();
        $catalogs = Category::where('slug', 'catalogs')->first();
        $businessCards = Category::where('slug', 'business-cards')->first();
        $brochures = Category::where('slug', 'brochures')->first();
        $banners = Category::where('slug', 'banners')->first();

        // Reassign existing products to more specific categories
        if ($magazines) {
            Product::where('title', 'LIKE', '%Magazine%')
                ->orWhere('title', 'LIKE', '%Lookbook%')
                ->update(['category_id' => $magazines->id]);
        }

        if ($catalogs) {
            Product::where('title', 'LIKE', '%Catalog%')
                ->update(['category_id' => $catalogs->id]);
        }

        if ($businessCards) {
            Product::where('title', 'LIKE', '%Business Card%')
                ->update(['category_id' => $businessCards->id]);
        }

        if ($brochures) {
            Product::where('title', 'LIKE', '%Brochure%')
                ->update(['category_id' => $brochures->id]);
        }

        if ($banners) {
            Product::where('title', 'LIKE', '%Banner%')
                ->orWhere('title', 'LIKE', '%Poster%')
                ->update(['category_id' => $banners->id]);
        }

        $this->command->info('Products reassigned to new categories successfully!');
    }
}
