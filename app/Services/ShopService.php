<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Format;
use App\Models\Product;
use App\Models\ShopHeroSection;
use Illuminate\Support\Collection;

class ShopService
{
    /**
     * Get all products for the shop page with filters applied.
     */
    public function getProducts(array $filters = []): Collection
    {
        $query = Product::with('category')
            ->where('is_active', true);

        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (! empty($filters['format'])) {
            $query->where('format', $filters['format']);
        }

        if (! empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (! empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        $sortBy = $filters['sort'] ?? 'latest';

        match ($sortBy) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'popular' => $query->orderBy('popularity', 'desc'),
            'rating' => $query->orderBy('rating', 'desc'),
            'latest' => $query->latest(),
            default => $query->latest(),
        };

        return $query->get();
    }

    /**
     * Get active categories.
     */
    public function getCategories(): Collection
    {
        return Category::where('is_active', true)->get();
    }

    /**
     * Get active formats.
     */
    public function getFormats(): Collection
    {
        return Format::where('is_active', true)->orderBy('name')->get();
    }

    /**
     * Get or create the shop hero section.
     */
    public function getHeroSection(): ShopHeroSection
    {
        return ShopHeroSection::first() ?? ShopHeroSection::create([
            'subtitle' => 'Curated print catalogue',
            'title' => 'Shop every format in one place.',
            'description' => 'Browse books, marketing kits, signage, and packaging with ready-to-order specs. Filter fast, compare formats, and ship anywhere.',
            'badges' => ['Lead times 48h', 'Color-managed', 'Proofing included'],
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
        ]);
    }
}
