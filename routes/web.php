<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file contains the main web routes for the application.
| Routes are modularized into separate files for better organization.
|
*/

// Home Page
Route::get('/', [PageController::class, 'home'])->name('home');

// Include modular route files
require __DIR__.'/auth.php';
require __DIR__.'/shop.php';

// Admin routes with prefix
Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__.'/admin.php';
});

// Redirect /admin to admin login
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});
