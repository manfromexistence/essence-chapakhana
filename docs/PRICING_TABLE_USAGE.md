# Pricing Table Usage Guide

## Overview
This guide shows how to add pricing tables to product pages in Chapakhana.

---

## 1. Using the Pricing Helper

### In Controllers

```php
use App\Helpers\PricingHelper;

public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    
    // Get pricing tiers for this product category
    $pricingTiers = PricingHelper::getPricingTiers($product->category->slug);
    $pricingNote = PricingHelper::getPricingNote($product->category->slug);
    
    return view('products.detail', compact('product', 'pricingTiers', 'pricingNote'));
}
```

### Calculate Price by Quantity

```php
use App\Helpers\PricingHelper;

$quantity = 150;
$category = 'books';
$price = PricingHelper::calculatePrice($category, $quantity);
// Returns: 120 (based on quantity tier)
```

---

## 2. Using the Pricing Table Component

### Basic Usage

```blade
<x-pricing-table 
    title="Quantity Pricing"
    :prices="$pricingTiers"
    :note="$pricingNote"
/>
```

### With Custom Data

```blade
<x-pricing-table 
    title="বাল্ক মূল্য"
    :prices="[
        ['min' => 1, 'max' => 50, 'price' => 150],
        ['min' => 51, 'max' => 100, 'price' => 135],
        ['min' => 101, 'max' => 250, 'price' => 120],
        ['min' => 251, 'price' => 100]
    ]"
    note="৫০০+ অর্ডারের জন্য বিশেষ ছাড় উপলব্ধ"
/>
```

---

## 3. Adding to Product Detail Page

### Update Controller

File: `app/Http/Controllers/ProductDetailController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\PricingHelper;

class ProductDetailController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        // Get pricing information
        $pricingTiers = PricingHelper::getPricingTiers($product->category->slug);
        $pricingNote = PricingHelper::getPricingNote($product->category->slug);
        
        return view('products.detail', compact('product', 'pricingTiers', 'pricingNote'));
    }
}
```

### Update View

File: `resources/views/products/detail.blade.php`

Add this section after the product description:

```blade
<!-- Pricing Information -->
<div class="mt-8">
    <x-pricing-table 
        title="Quantity-Based Pricing"
        :prices="$pricingTiers"
        :note="$pricingNote"
    />
</div>
```

---

## 4. Adding to Product Configuration Pages

### Example: Book Configuration

File: `resources/views/products/configure/book.blade.php`

Add before the configuration form:

```blade
<!-- Pricing Section -->
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">মূল্য তালিকা</h2>
            <p class="text-gray-600">পরিমাণ অনুযায়ী মূল্য</p>
        </div>
        
        <div class="max-w-3xl mx-auto">
            <x-pricing-table 
                title="বই প্রিন্টিং মূল্য"
                :prices="[
                    ['min' => 1, 'max' => 50, 'price' => 150, 'unit' => 'কপি'],
                    ['min' => 51, 'max' => 100, 'price' => 135, 'unit' => 'কপি'],
                    ['min' => 101, 'max' => 250, 'price' => 120, 'unit' => 'কপি'],
                    ['min' => 251, 'price' => 100, 'unit' => 'কপি']
                ]"
                note="স্ট্যান্ডার্ড বাইন্ডিং সহ মূল্য। প্রিমিয়াম বাইন্ডিং অতিরিক্ত খরচে উপলব্ধ।"
            />
        </div>
    </div>
</section>
```

---

## 5. Available Pricing Categories

The PricingHelper includes default pricing for:

- `books` - Book printing
- `business-cards` - Business cards
- `brochures` - Brochures and flyers
- `banners` - Banners and signs
- `stickers` - Stickers and labels
- `catalogs` - Catalogs
- `magazines` - Magazines
- `stationery` - Stationery items

---

## 6. Customizing Pricing Data

### Edit Pricing Tiers

File: `app/Helpers/PricingHelper.php`

```php
'books' => [
    ['min' => 1, 'max' => 50, 'price' => 150, 'unit' => 'copy'],
    ['min' => 51, 'max' => 100, 'price' => 135, 'unit' => 'copy'],
    ['min' => 101, 'max' => 250, 'price' => 120, 'unit' => 'copy'],
    ['min' => 251, 'price' => 100, 'unit' => 'copy'],
],
```

### Add New Category

```php
'new-category' => [
    ['min' => 1, 'max' => 25, 'price' => 200, 'unit' => 'piece'],
    ['min' => 26, 'max' => 50, 'price' => 180, 'unit' => 'piece'],
    ['min' => 51, 'price' => 150, 'unit' => 'piece'],
],
```

---

## 7. Dynamic Pricing in JavaScript

For real-time price calculation in configuration forms:

```javascript
// Get pricing tiers from helper
const pricingTiers = @json(App\Helpers\PricingHelper::getPricingTiers($category));

function calculatePrice(quantity) {
    for (let tier of pricingTiers) {
        if (quantity >= tier.min) {
            if (!tier.max || quantity <= tier.max) {
                return tier.price;
            }
        }
    }
    return pricingTiers[0].price;
}

// Update price when quantity changes
document.getElementById('quantity').addEventListener('input', function(e) {
    const quantity = parseInt(e.target.value) || 1;
    const unitPrice = calculatePrice(quantity);
    const total = unitPrice * quantity;
    
    document.getElementById('totalPrice').textContent = `৳${total.toFixed(2)}`;
});
```

---

## 8. Example: Complete Product Page with Pricing

```blade
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Product Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <div>
            <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </div>
        <div>
            <h1 class="text-4xl font-bold mb-4">{{ $product->title }}</h1>
            <p class="text-gray-600 mb-6">{{ $product->description }}</p>
            
            <!-- Pricing Table -->
            <x-pricing-table 
                title="Quantity Pricing"
                :prices="$pricingTiers"
                :note="$pricingNote"
            />
        </div>
    </div>
</div>
@endsection
```

---

## 9. Styling Customization

The pricing table component uses Tailwind CSS classes. You can customize by:

### Passing Additional Classes

```blade
<x-pricing-table 
    class="shadow-xl border-2 border-blue-500"
    title="Special Pricing"
    :prices="$pricingTiers"
/>
```

### Modifying Component

File: `resources/views/components/pricing-table.blade.php`

Change colors, spacing, or layout as needed.

---

## 10. Best Practices

1. **Always show pricing** - Transparency builds trust
2. **Use clear units** - Specify "per copy", "per set", etc.
3. **Add notes** - Explain what's included in the price
4. **Highlight savings** - Show percentage saved for bulk orders
5. **Mobile responsive** - Ensure table works on all devices

---

## Support

For questions about pricing implementation, contact the development team.

**Last Updated**: January 19, 2026
