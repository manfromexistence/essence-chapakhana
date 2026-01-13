<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class BooksServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Books category
        $booksCategory = ServiceCategory::where('slug', 'books')->first();

        if (! $booksCategory) {
            $this->command->error('Books category not found. Please run ServiceCategorySeeder first.');

            return;
        }

        $products = [
            [
                'name' => 'Paperback Book',
                'description' => 'Traditional paperback books with flexible cover, perfect for novels, poetry, and general reading. Affordable and lightweight.',
                'price' => 15.00,
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Hardback Book',
                'description' => 'Premium hardcover books with durable binding, ideal for keepsakes, photo books, and professional publications.',
                'price' => 35.00,
                'image' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Special Finish Hardback',
                'description' => 'Luxury hardback books with special finishes like embossing, foil stamping, or textured covers for a premium look.',
                'price' => 50.00,
                'image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Comics',
                'description' => 'Comic book printing with vibrant colors and quality paper, suitable for graphic novels and comic series.',
                'price' => 12.00,
                'image' => 'https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Self-Published Book',
                'description' => 'Complete self-publishing solution for authors, including professional layout, printing, and binding options.',
                'price' => 25.00,
                'image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Recipe Book',
                'description' => 'Custom recipe books with quality paper and binding, perfect for collecting family recipes or creating cookbooks.',
                'price' => 20.00,
                'image' => 'https://images.unsplash.com/photo-1592430599438-26d6e9a5b975?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Cookery Book',
                'description' => 'Professional cookbook printing with high-quality photo reproduction and durable binding for kitchen use.',
                'price' => 30.00,
                'image' => 'https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Pocket-Sized Book',
                'description' => 'Compact, portable books perfect for travel guides, pocket notebooks, or mini editions.',
                'price' => 10.00,
                'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Lookbook',
                'description' => 'Fashion and portfolio lookbooks with high-quality image printing, ideal for designers and photographers.',
                'price' => 40.00,
                'image' => 'https://images.unsplash.com/photo-1535905557558-afc4877a26fc?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Manga',
                'description' => 'Japanese manga-style book printing with appropriate paper quality and binding for manga collections.',
                'price' => 14.00,
                'image' => 'https://images.unsplash.com/photo-1608889825205-eebdb9fc5806?w=400&h=400&fit=crop',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            ServiceProduct::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($product['name'])],
                [
                    'service_category_id' => $booksCategory->id,
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'is_active' => $product['is_active'],
                ]
            );
        }

        $this->command->info('Books service products seeded successfully!');
    }
}
