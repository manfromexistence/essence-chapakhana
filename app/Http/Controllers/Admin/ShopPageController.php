<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShopHeroSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopPageController extends Controller
{
    public function index()
    {
        $hero = ShopHeroSection::first() ?? new ShopHeroSection;
        $categories = Category::withCount('products')->where('is_active', true)->get();
        $products = Product::with('category')->where('is_active', true)->latest()->get();
        $orders = Order::with(['user', 'items'])->latest()->take(10)->get();

        return Inertia::render('Admin/Shop', [
            'hero' => $hero,
            'categories' => $categories,
            'products' => $products,
            'orders' => $orders,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'subtitle' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'badges' => 'nullable|array',
            'badges.*' => 'nullable|string|max:255',
            'stat1_label' => 'required|string|max:255',
            'stat1_value' => 'required|string|max:255',
            'stat1_sublabel' => 'required|string|max:255',
            'stat2_label' => 'required|string|max:255',
            'stat2_value' => 'required|string|max:255',
            'stat2_sublabel' => 'required|string|max:255',
            'stat3_label' => 'required|string|max:255',
            'stat3_value' => 'required|string|max:255',
            'stat3_sublabel' => 'required|string|max:255',
            'stat4_label' => 'required|string|max:255',
            'stat4_value' => 'required|string|max:255',
            'stat4_sublabel' => 'required|string|max:255',
            'featured_products' => 'nullable|array',
            'featured_categories' => 'nullable|array',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $hero = ShopHeroSection::first();

            // Delete old image if exists
            if ($hero && $hero->cover_image) {
                $oldImagePath = public_path($hero->cover_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store new image
            $image = $request->file('cover_image');
            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/shop-hero'), $imageName);
            $validated['cover_image'] = '/uploads/shop-hero/'.$imageName;
        }

        // Filter out empty badges
        if (isset($validated['badges'])) {
            $validated['badges'] = array_filter($validated['badges'], fn ($badge) => ! empty(trim($badge)));
            $validated['badges'] = array_values($validated['badges']);
        }

        $hero = ShopHeroSection::first();
        if ($hero) {
            $hero->update($validated);
        } else {
            ShopHeroSection::create($validated);
        }

        return back()->with('success', 'Shop page updated successfully!');
    }
}
