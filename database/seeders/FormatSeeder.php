<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formats = [
            ['name' => 'Paperback', 'slug' => 'paperback'],
            ['name' => 'Hardback', 'slug' => 'hardback'],
            ['name' => 'Square', 'slug' => 'square'],
            ['name' => 'Layflat', 'slug' => 'layflat'],
            ['name' => 'Magazine', 'slug' => 'magazine'],
            ['name' => 'Notebook', 'slug' => 'notebook'],
            ['name' => 'Pocket', 'slug' => 'pocket'],
            ['name' => 'Cookbook', 'slug' => 'cookbook'],
            ['name' => 'Catalog', 'slug' => 'catalog'],
            ['name' => 'Folder', 'slug' => 'folder'],
            ['name' => 'Poster', 'slug' => 'poster'],
            ['name' => 'Box', 'slug' => 'box'],
        ];

        foreach ($formats as $format) {
            Format::create($format);
        }
    }
}
