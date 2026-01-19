<?php

namespace Database\Seeders;

use App\Models\ShopHeroSection;
use Illuminate\Database\Seeder;

class ShopHeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopHeroSection::updateOrCreate(
            ['id' => 1], // Find by ID 1
            [
                'subtitle' => 'Curated print catalogue',
                'title' => 'Shop every format in one place.',
                'description' => 'Browse books, marketing kits, signage, and packaging with ready-to-order specs. Filter fast, compare formats, and ship anywhere.',
                'badges' => ['Lead times 48h', 'Color-managed', 'Proofing included'],
                'cover_image' => '/uploads/shop-hero/1767996515_69617c6360d61.jpg',
                'stat1_label' => 'Average rating',
                'stat1_value' => '4.6',
                'stat1_sublabel' => 'Feefo verified',
                'stat2_label' => 'Formats',
                'stat2_value' => '30+',
                'stat2_sublabel' => 'Books to boxes',
                'stat3_label' => 'Turnaround',
                'stat3_value' => '48h',
                'stat3_sublabel' => 'Express available',
                'stat4_label' => 'Support',
                'stat4_value' => '24/7',
                'stat4_sublabel' => 'Print specialists',
            ]
        );
    }
}
