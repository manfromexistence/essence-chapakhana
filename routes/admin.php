<?php

use App\Http\Controllers\Admin\CheckoutFieldController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceManagementController;
use App\Http\Controllers\Admin\ServiceProductController;
use App\Http\Controllers\Admin\ShopHeroController;
use App\Http\Controllers\Admin\ShopPageController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All admin panel routes - requires admin authentication
|
*/

// Admin Login (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])
        ->middleware('throttle:3,1')
        ->name('login.post');
});

// Protected Admin Routes
Route::middleware('admin')->group(function () {
    // Redirect /admin to /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Image Upload API (for AdminImageInput component)
    Route::post('/upload-image', [AdminPageController::class, 'uploadImage'])->name('upload-image');

    // Category Management
    Route::resource('categories', CategoryController::class);

    // Product Management
    Route::resource('products', ProductController::class);

    // Format Management
    Route::resource('formats', FormatController::class);

    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [OrderController::class, 'updateStatus'])->name('status');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });

    // Checkout Field Management
    Route::resource('checkout-fields', CheckoutFieldController::class)
        ->except(['create', 'show', 'edit']);
    Route::patch(
        'checkout-fields/{checkout_field}/toggle-visibility',
        [CheckoutFieldController::class, 'toggleVisibility']
    )
        ->name('checkout-fields.toggle-visibility');
    Route::patch(
        'checkout-fields/{checkout_field}/toggle-required',
        [CheckoutFieldController::class, 'toggleRequired']
    )
        ->name('checkout-fields.toggle-required');

    // Shop Page Management
    Route::prefix('shop')->name('shop.')->group(function () {
        Route::get('/', [ShopPageController::class, 'index'])->name('index');
        Route::put('/', [ShopPageController::class, 'update'])->name('update');
    });

    // Service Management
    Route::get('/services', [ServiceManagementController::class, 'index'])->name('services.index');

    // Shop Hero Section
    Route::prefix('shop-hero')->name('shop-hero.')->group(function () {
        Route::get('/', [ShopHeroController::class, 'edit'])->name('edit');
        Route::put('/', [ShopHeroController::class, 'update'])->name('update');
    });

    // Service Categories
    Route::resource('service-categories', ServiceCategoryController::class);

    // Service Products
    Route::resource('service-products', ServiceProductController::class);

    // Page Management
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [AdminPageController::class, 'index'])->name('index');

        // Home Page
        Route::get('/home', [AdminPageController::class, 'editHome'])->name('home');
        Route::put('/home', [AdminPageController::class, 'updateHome'])->name('home.update');
        Route::post('/home', [AdminPageController::class, 'updateHome'])->name('home.store'); // For file uploads

        // Header
        Route::get('/header', [AdminPageController::class, 'editHeader'])->name('header');
        Route::put('/header', [AdminPageController::class, 'updateHeader'])->name('header.update');
        Route::post('/header', [AdminPageController::class, 'updateHeader'])->name('header.store');

        // Footer
        Route::get('/footer', [AdminPageController::class, 'editFooter'])->name('footer');
        Route::put('/footer', [AdminPageController::class, 'updateFooter'])->name('footer.update');

        // Category Pages
        Route::get('/category/{slug}', [AdminPageController::class, 'editCategory'])->name('category');
        Route::put('/category/{slug}', [AdminPageController::class, 'updateCategory'])->name('category.update');

        // Category Product Detail Pages
        Route::get('/category/{categorySlug}/product/{productSlug}/edit', [AdminPageController::class, 'editCategoryProduct'])->name('category.product.edit');
        Route::put('/category/{categorySlug}/product/{productSlug}', [AdminPageController::class, 'updateCategoryProduct'])->name('category.product.update');
    });

    // Site Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SiteSettingsController::class, 'index'])->name('index');
        Route::post('/', [SiteSettingsController::class, 'update'])->name('update');
    });
});
