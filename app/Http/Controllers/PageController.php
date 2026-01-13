<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use App\Services\CategoryDataService;

class PageController extends Controller
{
    protected CategoryDataService $categoryService;

    public function __construct(CategoryDataService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display the home page.
     */
    public function home()
    {
        // Fetch all home page sections from database
        $sections = PageSection::where('page', 'home')->get()->keyBy('section_key');

        // Extract content from sections
        $homeContent = [];
        foreach ($sections as $key => $section) {
            $homeContent[$key] = $section->content;
        }

        return view('pages.home', compact('homeContent', 'sections'));
    }

    /**
     * Display a category page.
     */
    public function category(string $category)
    {
        $data = $this->categoryService->getCategoryBySlug($category);

        if (! $data) {
            abort(404, 'Category not found');
        }

        return view('pages.category', $data);
    }

    /**
     * Display a product configuration page.
     */
    public function productConfig(string $category, string $product)
    {
        $productData = $this->categoryService->getProductType($category, $product);

        if (! $productData) {
            abort(404, 'Product not found');
        }

        $view = 'products.configure.'.($productData['view'] ?? 'book');

        return view($view, [
            'productType' => $productData['productType'],
            'productTitle' => $productData['productTitle'],
        ]);
    }
}
