<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Products', [
            'products' => Inertia::defer(fn () => Product::with('category')->latest()->get()),
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();

        return Inertia::render('Admin/ProductForm', [
            'categories' => $categories,
            'product' => null,
            'isEdit' => false,
            'configOptions' => $this->getConfigOptions(),
        ]);
    }

    public function show(Product $product)
    {
        // Redirect to edit page
        return redirect()->route('admin.products.edit', $product);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate secure random filename
            $extension = $image->getClientOriginalExtension();
            $imageName = \Illuminate\Support\Str::random(40).'.'.$extension;

            // Store in storage/app/public/products directory
            $path = $image->storeAs('products', $imageName, 'public');
            $validated['image'] = '/storage/'.$path;
        }

        $validated['stock'] = $request->has('stock');
        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? 0;
        $validated['popularity'] = $validated['popularity'] ?? 0;
        $validated['min_quantity'] = $validated['min_quantity'] ?? 1;

        // Handle config_options as JSON
        if (isset($validated['config_options']) && is_array($validated['config_options'])) {
            // Already validated as array
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();

        return Inertia::render('Admin/ProductForm', [
            'product' => $product,
            'categories' => $categories,
            'isEdit' => true,
            'configOptions' => $this->getConfigOptions(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                $oldPath = str_replace('/storage/', '', $product->image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('image');

            // Generate secure random filename
            $extension = $image->getClientOriginalExtension();
            $imageName = \Illuminate\Support\Str::random(40).'.'.$extension;

            // Store in storage/app/public/products directory
            $path = $image->storeAs('products', $imageName, 'public');
            $validated['image'] = '/storage/'.$path;
        } else {
            unset($validated['image']);
        }

        $validated['stock'] = $request->has('stock');
        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? $product->rating;
        $validated['popularity'] = $validated['popularity'] ?? $product->popularity;
        $validated['min_quantity'] = $validated['min_quantity'] ?? $product->min_quantity ?? 1;

        // Handle config_options as JSON
        if (isset($validated['config_options']) && is_array($validated['config_options'])) {
            // Already validated as array
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Get configuration options for product form.
     */
    protected function getConfigOptions(): array
    {
        return [
            'bindings' => [
                ['value' => 'saddle-stitch', 'label' => 'Saddle Stitch', 'price' => 8.50],
                ['value' => 'paperback-perfect', 'label' => 'Paperback Perfect', 'price' => 12.10],
                ['value' => 'hardcover', 'label' => 'Hardcover', 'price' => 25.00],
                ['value' => 'spiral', 'label' => 'Spiral Binding', 'price' => 15.00],
                ['value' => 'wire-o', 'label' => 'Wire-O Binding', 'price' => 18.00],
            ],
            'sizes' => [
                ['value' => 'us-letter', 'label' => 'US Letter (8.5" x 11")', 'price' => 1.20],
                ['value' => 'a4', 'label' => 'A4 (210mm x 297mm)', 'price' => 1.00],
                ['value' => 'a5', 'label' => 'A5 (148mm x 210mm)', 'price' => 0.80],
                ['value' => 'us-trade', 'label' => 'US Trade (6" x 9")', 'price' => 0.60],
                ['value' => 'digest', 'label' => 'Digest (5.5" x 8.5")', 'price' => 0.50],
                ['value' => 'custom', 'label' => 'Custom Size', 'price' => 0.00],
            ],
            'orientations' => [
                ['value' => 'portrait', 'label' => 'Portrait', 'price' => 0.00],
                ['value' => 'landscape', 'label' => 'Landscape', 'price' => 0.50],
            ],
            'paperTypes' => [
                ['value' => '70lb-uncoated', 'label' => '70 lb. Uncoated', 'price' => 0.30],
                ['value' => '80lb-uncoated', 'label' => '80 lb. Uncoated', 'price' => 0.50],
                ['value' => '70lb-satin', 'label' => '70 lb. Satin', 'price' => 0.50],
                ['value' => '80lb-satin', 'label' => '80 lb. Satin', 'price' => 1.00],
                ['value' => '100lb-satin', 'label' => '100 lb. Satin', 'price' => 1.50],
                ['value' => '70lb-gloss', 'label' => '70 lb. Gloss', 'price' => 0.60],
                ['value' => '80lb-gloss', 'label' => '80 lb. Gloss', 'price' => 1.20],
                ['value' => '100lb-gloss', 'label' => '100 lb. Gloss', 'price' => 1.80],
            ],
            'coverPaperTypes' => [
                ['value' => '80lb-satin', 'label' => '80 lb. Satin', 'price' => 1.00],
                ['value' => '100lb-satin', 'label' => '100 lb. Satin', 'price' => 1.50],
                ['value' => '130lb-satin', 'label' => '130 lb. Satin', 'price' => 2.00],
                ['value' => '80lb-gloss', 'label' => '80 lb. Gloss', 'price' => 1.20],
                ['value' => '100lb-gloss', 'label' => '100 lb. Gloss', 'price' => 1.80],
                ['value' => '130lb-gloss', 'label' => '130 lb. Gloss', 'price' => 2.50],
            ],
            'coatings' => [
                ['value' => 'none', 'label' => 'None', 'price' => 0.00],
                ['value' => 'matte', 'label' => 'Matte', 'price' => 2.50],
                ['value' => 'gloss', 'label' => 'Gloss', 'price' => 2.50],
                ['value' => 'soft-touch', 'label' => 'Soft Touch', 'price' => 3.50],
                ['value' => 'uv-coating', 'label' => 'UV Coating', 'price' => 4.00],
            ],
            'finishes' => [
                ['value' => 'none', 'label' => 'None', 'price' => 0.00],
                ['value' => 'spot-uv', 'label' => 'Spot UV', 'price' => 5.00],
                ['value' => 'foil-stamping', 'label' => 'Foil Stamping', 'price' => 8.00],
                ['value' => 'embossing', 'label' => 'Embossing', 'price' => 6.00],
                ['value' => 'debossing', 'label' => 'Debossing', 'price' => 6.00],
            ],
        ];
    }
}
