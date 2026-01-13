<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category' => 'Books',
                'title' => 'Paperback Book Bundle',
                'description' => 'Lightweight novel-ready sets with recycled interiors.',
                'format' => 'Paperback',
                'price' => 8.50,
                'rating' => 4.6,
                'popularity' => 95,
                'stock' => true,
                'badge' => 'New',
                'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Books',
                'title' => 'Hardback Photo Book',
                'description' => 'Gallery-grade binding with matte cover options.',
                'format' => 'Hardback',
                'price' => 24.00,
                'rating' => 4.8,
                'popularity' => 91,
                'stock' => true,
                'badge' => 'Bestseller',
                'image' => 'https://images.unsplash.com/photo-1457694587812-e8bf29a43845?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Marketing',
                'title' => 'Square Lookbook',
                'description' => 'Brand-forward square books for campaigns.',
                'format' => 'Square',
                'price' => 16.75,
                'rating' => 4.4,
                'popularity' => 82,
                'stock' => true,
                'badge' => 'Limited',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Books',
                'title' => 'Layflat Portfolio',
                'description' => 'Seamless spreads ideal for photography and art.',
                'format' => 'Layflat',
                'price' => 38.00,
                'rating' => 4.9,
                'popularity' => 77,
                'stock' => true,
                'badge' => 'Premium',
                'image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Marketing',
                'title' => 'Magazine Run',
                'description' => 'Quick-turn glossy mags for launches.',
                'format' => 'Magazine',
                'price' => 4.20,
                'rating' => 4.2,
                'popularity' => 88,
                'stock' => true,
                'badge' => 'Bulk',
                'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Stationery',
                'title' => 'Notebook Stack',
                'description' => 'Wire-bound notes with soy inks.',
                'format' => 'Notebook',
                'price' => 6.40,
                'rating' => 4.1,
                'popularity' => 73,
                'stock' => true,
                'badge' => 'Eco',
                'image' => 'https://images.unsplash.com/photo-1481277542470-605612bd2d61?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Books',
                'title' => 'Pocket Zine',
                'description' => 'Short-run zines with uncoated feel.',
                'format' => 'Pocket',
                'price' => 3.80,
                'rating' => 4.0,
                'popularity' => 69,
                'stock' => true,
                'badge' => 'Indie',
                'image' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Books',
                'title' => 'Cookbook Kit',
                'description' => 'Oil-resistant papers with foil accents.',
                'format' => 'Cookbook',
                'price' => 19.50,
                'rating' => 4.5,
                'popularity' => 83,
                'stock' => true,
                'badge' => 'Bundle',
                'image' => 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Marketing',
                'title' => 'Catalog Set',
                'description' => 'Multi-variant catalogs with spot UV.',
                'format' => 'Catalog',
                'price' => 7.10,
                'rating' => 4.3,
                'popularity' => 79,
                'stock' => true,
                'badge' => 'Ready',
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Stationery',
                'title' => 'Presentation Folder',
                'description' => 'Die-cut folders with custom pockets.',
                'format' => 'Folder',
                'price' => 2.90,
                'rating' => 3.9,
                'popularity' => 60,
                'stock' => true,
                'badge' => 'Saver',
                'image' => 'https://images.unsplash.com/photo-1509099836639-18ba02e2e1ba?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Signage',
                'title' => 'Large Format Poster',
                'description' => 'Vibrant latex inks for outdoor durability.',
                'format' => 'Poster',
                'price' => 12.00,
                'rating' => 4.7,
                'popularity' => 86,
                'stock' => true,
                'badge' => 'UV Safe',
                'image' => 'https://images.unsplash.com/photo-1522199710521-72d69614c702?w=500&h=420&fit=crop',
            ],
            [
                'category' => 'Packaging',
                'title' => 'Product Packaging Set',
                'description' => 'Rigid boxes with embossing and liners.',
                'format' => 'Box',
                'price' => 29.00,
                'rating' => 4.4,
                'popularity' => 80,
                'stock' => true,
                'badge' => 'Custom',
                'image' => 'https://images.unsplash.com/photo-1453689472869-23f81f0b89dd?w=500&h=420&fit=crop',
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'title' => $productData['title'],
                    'slug' => \Illuminate\Support\Str::slug($productData['title']),
                    'description' => $productData['description'],
                    'format' => $productData['format'],
                    'price' => $productData['price'],
                    'rating' => $productData['rating'],
                    'popularity' => $productData['popularity'],
                    'stock' => $productData['stock'],
                    'badge' => $productData['badge'],
                    'image' => $productData['image'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
