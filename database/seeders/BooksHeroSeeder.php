<?php

namespace Database\Seeders;

use App\Models\BooksHeroSection;
use Illuminate\Database\Seeder;

class BooksHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BooksHeroSection::create([
            'title' => 'Books',
            'description' => 'Give your book the treatment it deserves: our catalogue contains all the paper and binding options and special finishes you need to customise your publication. And from just one copy.',
            'rating_score' => 4.5,
            'rating_count' => 80,
            'fsc_text' => 'The majority of our products are FSC® certified – explore them now!',
            'slider_images' => [
                'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&h=400&fit=crop',
                'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=800&h=400&fit=crop',
                'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=800&h=400&fit=crop',
            ],
        ]);
    }
}
