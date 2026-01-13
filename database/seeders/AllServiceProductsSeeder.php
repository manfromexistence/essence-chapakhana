<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AllServiceProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding all service products...');

        $this->call([
            BooksServiceProductSeeder::class,
            BusinessCardsServiceProductSeeder::class,
            StickersLabelsServiceProductSeeder::class,
            BrochuresFlyersServiceProductSeeder::class,
            BannersSignsServiceProductSeeder::class,
            CatalogsServiceProductSeeder::class,
            MagazinesServiceProductSeeder::class,
            StationeryServiceProductSeeder::class,
            ZinesServiceProductSeeder::class,
        ]);

        $this->command->info('All service products seeded successfully!');
    }
}
