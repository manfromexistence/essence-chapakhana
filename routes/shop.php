<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductConfigController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shop Routes
|--------------------------------------------------------------------------
|
| All public-facing shop routes - category pages, product pages, cart, checkout
|
*/

// Main shop page
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Category pages - uses database-backed PageSection model
$categories = [
    'books',
    'business-cards',
    'stickers',
    'postcards-invitations',
    'booklets',
    'catalogs',
    'magazines',
    'brochures',
    'banners',
    'stationery',
    'promotional-items',
    'marketing',
    'signage',
    'packaging',
];

foreach ($categories as $category) {
    Route::get("/{$category}", [CategoryPageController::class, 'show'])
        ->defaults('slug', $category)
        ->name("category.{$category}");

    Route::get("/{$category}/{product}", [ProductConfigController::class, 'show'])
        ->defaults('category', $category)
        ->name("product.{$category}");
}

// Cart Routes (no auth required for browsing and adding to cart)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::delete('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
});

// Cart count route (no auth required for header display)
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');

// Checkout Routes (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});
