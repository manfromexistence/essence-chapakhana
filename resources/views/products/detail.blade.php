@extends('layouts.app')

@section('title', $product->title . ' | Chapakhana')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="bg-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                <span>/</span>
                <a href="{{ route('shop') }}" class="hover:text-blue-600">Shop</a>
                <span>/</span>
                <a href="{{ route('category.' . $product->category->slug) }}" class="hover:text-blue-600">{{ $product->category->name }}</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">{{ $product->title }}</span>
            </nav>

            <!-- Product Detail -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">
                <!-- Product Image -->
                <div class="space-y-4">
                    <div class="relative aspect-square bg-gray-100 rounded-2xl overflow-hidden">
                        <img src="{{ asset($product->image) }}" 
                             alt="{{ $product->title }}"
                             class="w-full h-full object-cover">
                        @if($product->badge)
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold border border-gray-200">
                                {{ $product->badge }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-sm uppercase tracking-wide text-blue-600 font-semibold">
                                {{ $product->category->name }}
                            </span>
                            <div class="flex items-center gap-1 text-sm">
                                <span class="text-yellow-500">★</span>
                                <span class="font-semibold text-gray-900">{{ number_format($product->rating, 1) }}</span>
                                <span class="text-gray-500">({{ $product->rating }})</span>
                            </div>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">{{ $product->title }}</h1>
                        <p class="text-lg text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Price and Stock -->
                    <div class="border-t border-b border-gray-200 py-6 space-y-4">
                        <div class="flex items-baseline gap-3">
                            <span class="text-4xl font-bold text-gray-900">৳{{ number_format($product->price, 2) }}</span>
                            <span class="text-sm text-gray-500">per unit</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-sm font-medium {{ $product->stock ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ $product->stock ? 'In Stock' : 'Out of Stock' }}
                            </span>
                            <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700">
                                Format: {{ $product->format }}
                            </span>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    @if($product->stock)
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="title" value="{{ $product->title }}">
                            <input type="hidden" name="category" value="{{ $product->category->slug }}">
                            <input type="hidden" name="format" value="{{ $product->format }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="rating" value="{{ $product->rating }}">
                            <input type="hidden" name="desc" value="{{ $product->description }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                            <input type="hidden" name="stock" value="{{ $product->stock ? '1' : '0' }}">
                            
                            <div class="flex items-center gap-4">
                                <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
                                <input type="number" 
                                       id="quantity" 
                                       name="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="999"
                                       class="w-24 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center gap-3 text-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.4 5.4M17 13l2.4 5.4M9.5 21h5m0 0a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center">
                            <p class="text-gray-600 font-medium">This product is currently out of stock.</p>
                        </div>
                    @endif

                    <!-- Product Features -->
                    <div class="bg-gray-50 rounded-xl p-6 space-y-3">
                        <h3 class="font-semibold text-gray-900 mb-4">Product Features</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm text-gray-700">High Quality Print</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm text-gray-700">Fast Delivery</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm text-gray-700">Professional Finish</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm text-gray-700">Customer Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description & Details -->
            <div class="border-t border-gray-200 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Description -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Product Description</h2>
                            <div class="prose prose-gray max-w-none">
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                                
                                <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">About This Product</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    This high-quality {{ strtolower($product->category->name) }} product is designed to meet your printing needs. 
                                    With professional-grade materials and expert craftsmanship, we ensure that every detail meets the highest standards.
                                </p>
                                
                                <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Key Benefits</h3>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>Premium quality printing and materials</li>
                                    <li>Fast turnaround time with reliable delivery</li>
                                    <li>Professional finish for outstanding results</li>
                                    <li>Competitive pricing with no hidden costs</li>
                                    <li>Expert customer support throughout your order</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-xl p-6 sticky top-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Specifications</h3>
                            <dl class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <dt class="text-sm font-medium text-gray-600">Category</dt>
                                    <dd class="text-sm font-semibold text-gray-900">{{ $product->category->name }}</dd>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <dt class="text-sm font-medium text-gray-600">Format</dt>
                                    <dd class="text-sm font-semibold text-gray-900">{{ $product->format }}</dd>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <dt class="text-sm font-medium text-gray-600">Price</dt>
                                    <dd class="text-sm font-semibold text-gray-900">৳{{ number_format($product->price, 2) }}</dd>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <dt class="text-sm font-medium text-gray-600">Rating</dt>
                                    <dd class="text-sm font-semibold text-gray-900">{{ number_format($product->rating, 1) }} / 5.0</dd>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <dt class="text-sm font-medium text-gray-600">Availability</dt>
                                    <dd class="text-sm font-semibold {{ $product->stock ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock ? 'In Stock' : 'Out of Stock' }}
                                    </dd>
                                </div>
                                @if($product->badge)
                                <div class="flex justify-between py-2">
                                    <dt class="text-sm font-medium text-gray-600">Badge</dt>
                                    <dd class="text-sm font-semibold text-blue-600">{{ $product->badge }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="border-t border-gray-200 pt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                            <article class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                                <a href="{{ route('product.detail', ['category' => $relatedProduct->category->slug, 'product' => $relatedProduct->slug]) }}" class="block">
                                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                                        <img src="{{ asset($relatedProduct->image) }}" 
                                             alt="{{ $relatedProduct->title }}"
                                             class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        @if($relatedProduct->badge)
                                            <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-gray-800 border border-gray-200">
                                                {{ $relatedProduct->badge }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs uppercase tracking-wide text-blue-600 font-semibold">
                                            {{ $relatedProduct->category->name }}
                                        </span>
                                        <div class="flex items-center gap-1 text-xs text-yellow-500">
                                            <span class="font-semibold">{{ number_format($relatedProduct->rating, 1) }}</span>
                                            <span>★</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('product.detail', ['category' => $relatedProduct->category->slug, 'product' => $relatedProduct->slug]) }}">
                                        <h3 class="text-sm font-bold text-gray-900 leading-snug hover:text-blue-600 transition-colors line-clamp-2">
                                            {{ $relatedProduct->title }}
                                        </h3>
                                    </a>
                                    <div class="flex items-center justify-between pt-2">
                                        <div class="text-lg font-bold text-gray-900">৳{{ number_format($relatedProduct->price, 2) }}</div>
                                        <span class="text-xs rounded-full bg-gray-100 px-2 py-1">{{ $relatedProduct->format }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
