@extends('layouts.app')

@section('title', ($productTitle ?? 'Banner') . ' | Chapakhana')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-xs text-gray-500 flex items-center gap-1">
                <a href="/" class="hover:text-blue-600 hover:underline">হোম</a>
                <span>/</span>
                <a href="/banners" class="hover:text-blue-600 hover:underline">ব্যানার</a>
                <span>/</span>
                <span class="text-gray-800">{{ $productTitle ?? 'Vinyl Banners' }}</span>
            </nav>
        </div>
    </div>

    <!-- Hero Banner -->
    <section class="bg-orange-50 py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        {{ $productTitle ?? 'Vinyl Banners' }}
                    </h1>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Create eye-catching banners for any occasion. Choose from various materials, sizes, and finishing options to make your message stand out.
                    </p>
                    <div class="flex flex-wrap gap-6">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-green-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-base text-gray-800 font-medium">Weather Resistant</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-green-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-base text-gray-800 font-medium">High Quality Print</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-green-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-base text-gray-800 font-medium">Fast Turnaround</span>
                        </div>
                    </div>
                </div>
                <!-- Right Image -->
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ $productImage ?? 'https://images.unsplash.com/photo-1540317580384-e5d43616528e?w=800&h=600&fit=crop' }}" 
                             alt="{{ $productTitle ?? 'Banners' }}" 
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Configure Your Product Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Configure your product and get a quote</h2>
                <button type="button" class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
            </div>
            
            <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="service_product" value="1">
                <input type="hidden" name="title" value="{{ $productTitle ?? 'Banner' }}">
                <input type="hidden" name="category" value="{{ $category ?? 'banners' }}">
                <input type="hidden" name="product_type" value="{{ $productType ?? 'banner' }}">
                <input type="hidden" name="image" value="{{ $productImage ?? '' }}">
                <input type="hidden" name="price" id="cartPrice" value="45.00">
                <input type="hidden" name="configurations" id="cartConfigurations" value="{}">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Configuration Options -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Orientation Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Orientation</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div data-category="orientation" data-value="horizontal" data-price="0" class="orientation-option border-2 border-blue-600 bg-blue-50 rounded-lg p-6 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center">
                                <svg class="w-20 h-16 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="4" y="6" width="16" height="10" rx="1" stroke-width="2"/>
                                    <text x="12" y="12" text-anchor="middle" font-size="4" fill="currentColor" class="font-bold">hello</text>
                                    <path d="M8 14 L10 16 L8 18" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="16" cy="9" r="1.5" stroke-width="1.5"/>
                                </svg>
                                <span class="text-sm font-medium text-blue-600">Horizontal</span>
                            </div>
                            <div data-category="orientation" data-value="vertical" data-price="0" class="orientation-option border-2 border-gray-200 rounded-lg p-6 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center">
                                <svg class="w-16 h-20 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="7" y="3" width="10" height="18" rx="1" stroke-width="2"/>
                                    <text x="12" y="10" text-anchor="middle" font-size="3" fill="currentColor" class="font-bold">hello</text>
                                    <path d="M10 15 L12 17 L10 19" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="12" cy="7" r="1.2" stroke-width="1.5"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Vertical</span>
                            </div>
                            <div data-category="orientation" data-value="square" data-price="5" class="orientation-option border-2 border-gray-200 rounded-lg p-6 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center">
                                <svg class="w-20 h-20 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="4" y="4" width="16" height="16" rx="1" stroke-width="2"/>
                                    <text x="12" y="11" text-anchor="middle" font-size="3" fill="currentColor" class="font-bold">hello</text>
                                    <path d="M9 14 L11 16 L9 18" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="15" cy="8" r="1.2" stroke-width="1.5"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Square</span>
                            </div>
                        </div>
                    </div>

                    <!-- Size Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Size</h3>
                        <div class="flex items-center gap-3">
                            <select id="sizeSelect" class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="3x2" selected>3ft x 2ft</option>
                                <option value="4x3">4ft x 3ft</option>
                                <option value="5x3">5ft x 3ft</option>
                                <option value="6x3">6ft x 3ft</option>
                                <option value="8x4">8ft x 4ft</option>
                                <option value="10x5">10ft x 5ft</option>
                            </select>
                            <button class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Material Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Material</h3>
                        <div class="flex items-center gap-3">
                            <select id="materialSelect" class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="12oz-vinyl" selected>12 oz Premium Vinyl</option>
                                <option value="13oz-vinyl">13 oz Heavy Duty Vinyl</option>
                                <option value="fabric">Fabric Banner</option>
                                <option value="mesh">Mesh Banner</option>
                                <option value="canvas">Canvas</option>
                            </select>
                            <button class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Printed Side Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Printed Side</h3>
                        <div class="flex items-center gap-3">
                            <select id="printedSideSelect" class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="single" selected>Single Sided</option>
                                <option value="double">Double Sided</option>
                            </select>
                            <button class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Grommets Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Grommets</h3>
                        <div class="flex items-center gap-3">
                            <select id="grommetsSelect" class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="none" selected>None</option>
                                <option value="corners">4 Corners</option>
                                <option value="all-sides">All Sides (Every 2ft)</option>
                                <option value="top-bottom">Top & Bottom Only</option>
                            </select>
                            <button class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Hemming Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Hemming</h3>
                        <div class="flex items-center gap-3">
                            <select id="hemmingSelect" class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="all-perimeter" selected>All of Perimeter</option>
                                <option value="none">None</option>
                                <option value="top-bottom">Top & Bottom Only</option>
                                <option value="left-right">Left & Right Only</option>
                            </select>
                            <button class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Coating Section -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Coating</h3>
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="coating" value="none" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700">None</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <span class="text-sm font-medium text-blue-600">Protective Glossy Coating</span>
                                <button class="text-blue-600 hover:bg-blue-50 rounded-full p-1 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                            </label>
                        </div>
                    </div>

                    <!-- Accessories Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Accessories</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="accessories" value="none" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700">None</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="accessories" value="bungees-20" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-blue-600">Bungees 20"</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="accessories" value="bungees-40" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-blue-600">Bungees 40"</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="accessories" value="hanging-clips" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-blue-600">Hanging Clips</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="accessories" value="zip-ties-8" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-blue-600">Zip Ties (8)</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="accessories" value="zip-ties-25" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-medium text-blue-600">Zip Ties (25)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Item Name Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Item name</h3>
                        <input 
                            type="text" 
                            placeholder="Name this print job" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <!-- Select Price and Delivery Date Section -->
                    <div class="flex items-center gap-3">
                        <h3 class="text-lg font-semibold text-gray-900">Select price and delivery date</h3>
                        <button type="button" class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Custom Quantity Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Custom quantity</h3>
                        <input 
                            type="number" 
                            name="quantity"
                            id="quantityInput" 
                            value="1" 
                            min="1" 
                            step="1" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                </div>

                <!-- Right Column - Job Recap -->
                <div class="lg:col-span-1">
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Job recap and quotation</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Quantity</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-quantity">1</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Orientation</span>
                                <span class="text-sm font-semibold text-gray-900">Horizontal</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Size</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-size">3ft x 2ft</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Material</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-material">12 oz Premium Vinyl</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Printed Side</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-printed">Single Sided</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Grommets</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-grommets">None</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Hemming</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-hemming">All of Perimeter</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Expected Delivery</span>
                                <span class="text-sm font-semibold text-gray-900">{{ date('M d, Y', strtotime('+5 days')) }}</span>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-medium">Subtotal</span>
                                <span class="text-gray-900 font-semibold" id="subtotal">$45.00</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-medium">Tax (15%)</span>
                                <span class="text-gray-900 font-semibold" id="tax">$6.75</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t-2 border-blue-200">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-blue-600" id="total">$51.75</span>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-full hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                            Add to Cart
                        </button>
                        
                        <div class="mt-4 text-center">
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Need help? Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceState = {
                basePrice: 45.00,
                orientationPrice: 0,
                materialPrice: 0,
                printedSidePrice: 0,
                grommetsPrice: 0,
                coatingPrice: 0,
                accessoriesPrice: 0,
                quantity: 1,
                taxRate: 0.15
            };

            function updateDisplay() {
                const subtotal = (priceState.basePrice + priceState.orientationPrice + priceState.materialPrice + priceState.printedSidePrice + 
                                 priceState.grommetsPrice + priceState.coatingPrice + priceState.accessoriesPrice) * priceState.quantity;
                const tax = subtotal * priceState.taxRate;
                const total = subtotal + tax;

                document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
                document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
                document.getElementById('total').textContent = `$${total.toFixed(2)}`;
                document.getElementById('recap-quantity').textContent = priceState.quantity;
            }

            // Handle orientation option clicks
            function wireOrientationOptions() {
                const options = document.querySelectorAll('.orientation-option');
                options.forEach(opt => {
                    opt.addEventListener('click', function() {
                        // Remove selected state from all
                        options.forEach(o => {
                            o.classList.remove('border-blue-600', 'bg-blue-50');
                            o.classList.add('border-gray-200');
                            o.querySelector('svg').classList.remove('text-blue-600');
                            o.querySelector('svg').classList.add('text-gray-600');
                            o.querySelector('span').classList.remove('text-blue-600');
                            o.querySelector('span').classList.add('text-gray-700');
                        });
                        // Add selected state to clicked
                        this.classList.remove('border-gray-200');
                        this.classList.add('border-blue-600', 'bg-blue-50');
                        this.querySelector('svg').classList.remove('text-gray-600');
                        this.querySelector('svg').classList.add('text-blue-600');
                        this.querySelector('span').classList.remove('text-gray-700');
                        this.querySelector('span').classList.add('text-blue-600');
                        
                        priceState.orientationPrice = parseFloat(this.dataset.price) || 0;
                        updateDisplay();
                    });
                });
            }

            wireOrientationOptions();

            // Size select
            const sizeSelect = document.getElementById('sizeSelect');
            if (sizeSelect) {
                sizeSelect.addEventListener('change', function(e) {
                    document.getElementById('recap-size').textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Material select
            const materialSelect = document.getElementById('materialSelect');
            if (materialSelect) {
                materialSelect.addEventListener('change', function(e) {
                    const materialPrices = {
                        '12oz-vinyl': 0,
                        '13oz-vinyl': 10.00,
                        'fabric': 15.00,
                        'mesh': 12.00,
                        'canvas': 20.00
                    };
                    priceState.materialPrice = materialPrices[e.target.value] || 0;
                    document.getElementById('recap-material').textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Printed Side select
            const printedSideSelect = document.getElementById('printedSideSelect');
            if (printedSideSelect) {
                printedSideSelect.addEventListener('change', function(e) {
                    priceState.printedSidePrice = e.target.value === 'double' ? 20.00 : 0;
                    document.getElementById('recap-printed').textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Grommets select
            const grommetsSelect = document.getElementById('grommetsSelect');
            if (grommetsSelect) {
                grommetsSelect.addEventListener('change', function(e) {
                    const grommetsPrices = {
                        'none': 0,
                        'corners': 5.00,
                        'all-sides': 15.00,
                        'top-bottom': 8.00
                    };
                    priceState.grommetsPrice = grommetsPrices[e.target.value] || 0;
                    document.getElementById('recap-grommets').textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Hemming select
            const hemmingSelect = document.getElementById('hemmingSelect');
            if (hemmingSelect) {
                hemmingSelect.addEventListener('change', function(e) {
                    document.getElementById('recap-hemming').textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Coating radio buttons
            const coatingRadios = document.querySelectorAll('input[name="coating"]');
            coatingRadios.forEach(radio => {
                radio.addEventListener('change', function(e) {
                    priceState.coatingPrice = e.target.value === 'glossy' ? 10.00 : 0;
                    updateDisplay();
                });
            });

            // Accessories radio buttons
            const accessoriesRadios = document.querySelectorAll('input[name="accessories"]');
            accessoriesRadios.forEach(radio => {
                radio.addEventListener('change', function(e) {
                    const accessoriesPrices = {
                        'none': 0,
                        'bungees-20': 5.00,
                        'bungees-40': 8.00,
                        'hanging-clips': 6.00,
                        'zip-ties-8': 3.00,
                        'zip-ties-25': 7.00
                    };
                    priceState.accessoriesPrice = accessoriesPrices[e.target.value] || 0;
                    updateDisplay();
                });
            });

            // Quantity input
            const quantityInput = document.getElementById('quantity');
            if (quantityInput) {
                quantityInput.addEventListener('input', function(e) {
                    priceState.quantity = parseInt(e.target.value) || 1;
                    updateDisplay();
                });
            }

            updateDisplay();
        });
    </script>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
