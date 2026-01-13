<?php

namespace App\Http\Controllers;

use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * Display the shop page with all products.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['category_id', 'format', 'min_price', 'max_price', 'sort']);

        $products = $this->shopService->getProducts($filters);
        $categories = $this->shopService->getCategories();
        $formats = $this->shopService->getFormats();
        $hero = $this->shopService->getHeroSection();

        return view('pages.shop', compact('products', 'categories', 'formats', 'hero'));
    }
}
