<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin user
        $this->call(AdminUserSeeder::class);

        // Seed shop categories and products
        $this->call([
            CategorySeeder::class,
            FormatSeeder::class,
            ProductSeeder::class,
        ]);

        // Seed service categories and products
        $this->call([
            ServiceCategorySeeder::class,
            AllServiceProductsSeeder::class,
        ]);

        // Seed page sections for frontend content management
        $this->call(PageSectionSeeder::class);
    }
}
