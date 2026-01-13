<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class HeaderSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageSection::updateOrCreate(
            [
                'page' => 'header',
                'section_key' => 'main',
            ],
            [
                'title' => 'Header',
                'content' => [
                    'logo' => '/logo.png',
                    'site_name' => 'Chapakhana',
                    'phone' => '+880 1XXX-XXXXXX',
                    'navigation' => [
                        ['title' => 'Home', 'url' => '/', 'pattern' => '/'],
                        ['title' => 'Shop', 'url' => '/shop', 'pattern' => 'shop'],
                        ['title' => 'Magazines', 'url' => '/magazines', 'pattern' => 'magazines*'],
                        ['title' => 'Books', 'url' => '/books', 'pattern' => 'books*'],
                        ['title' => 'Catalog', 'url' => '/catalogs', 'pattern' => 'catalogs*'],
                        ['title' => 'Marketing Material', 'url' => '/brochures', 'pattern' => 'brochures*'],
                        ['title' => 'Business Cards', 'url' => '/business-cards', 'pattern' => 'business-cards*'],
                        ['title' => 'Invitation & Stationery', 'url' => '/postcards-invitations', 'pattern' => 'postcards-invitations*'],
                        ['title' => 'Banners', 'url' => '/banners', 'pattern' => 'banners*'],
                        ['title' => 'Promotional Items', 'url' => '/promotional-items', 'pattern' => 'promotional-items*'],
                    ],
                ],
                'is_active' => true,
                'order' => 0,
            ]
        );

        $this->command->info('Header section seeded successfully!');
    }
}
