@extends('layouts.app')

@section('title', $product->name . ' | Chapakhana')

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
                <a href="/{{ $category->slug }}" class="hover:text-blue-600 hover:underline">{{ $category->name }}</a>
                <span>/</span>
                <span class="text-gray-800">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900">
                        {{ $product->name }}
                    </h1>
                    @if($product->description)
                    <p class="text-lg text-gray-700 leading-relaxed">
                        {{ $product->description }}
                    </p>
                    @endif
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>প্রিমিয়াম মানের প্রিন্টিং</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>দ্রুত ডেলিভারি</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>কাস্টমাইজেবল অপশনস</span>
                        </li>
                    </ul>
                    <div class="flex gap-4 pt-4">
                        <a href="#configure" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                            এখনই কনফিগার করুন
                        </a>
                    </div>
                </div>
                <!-- Right Image -->
                <div class="relative">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ $product->image ? (filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('uploads/service-products/' . $product->image)) : 'https://placehold.co/800x600?text=' . urlencode($product->name) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-200 rounded-full opacity-50 blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-indigo-200 rounded-full opacity-50 blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Configuration Form -->
    <section class="bg-white py-16" id="configure">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">আপনার পণ্য কনফিগার করুন এবং কোট পান</h2>
                <p class="text-lg text-gray-600">আপনার প্রয়োজন অনুযায়ী অপশন নির্বাচন করুন</p>
            </div>
            
            <form id="productConfigForm" action="{{ route('cart.add') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf
                <input type="hidden" name="service_product" value="1">
                <input type="hidden" name="title" value="{{ $product->name }}">
                <input type="hidden" name="category" value="{{ $category->slug }}">
                <input type="hidden" name="product_type" value="{{ $product->slug }}">
                <input type="hidden" name="image" value="{{ $product->image ? (filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('uploads/service-products/' . $product->image)) : '' }}">
                <input type="hidden" name="price" id="cartPrice" value="{{ $product->price }}">
                <input type="hidden" name="quantity" id="cartQuantity" value="1">
                <input type="hidden" name="configurations" id="cartConfigurations" value="{}">
                
                <!-- Left Column: Configuration Options -->
                <div class="lg:col-span-2 space-y-8">
                    @if($product->configOptions->count() > 0)
                        @foreach($product->configOptions as $option)
                            <!-- {{ $option->option_name }} -->
                            <div class="config-section" data-option-id="{{ $option->id }}">
                                <div class="flex items-center gap-2 mb-6">
                                    <h3 class="text-2xl font-bold text-gray-700">{{ $option->option_name }}</h3>
                                    @if($option->is_required)
                                        <span class="text-red-500 text-sm">*</span>
                                    @endif
                                </div>

                                @if($option->option_type === 'button')
                                    <!-- Button Group -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        @foreach($option->option_values as $index => $value)
                                            <button type="button" 
                                                    data-category="{{ Str::slug($option->option_name) }}" 
                                                    data-price="{{ $option->option_prices[$index] ?? 0 }}"
                                                    data-option-name="{{ $option->option_name }}"
                                                    data-value="{{ $value }}"
                                                    class="price-option group border border-gray-300 rounded-xl p-6 bg-white hover:border-blue-600 hover:shadow-lg transition text-center {{ $loop->first ? 'border-blue-600 bg-blue-50' : '' }}">
                                                <div class="text-xl font-bold text-gray-900 mb-2">{{ $value }}</div>
                                                @if(isset($option->option_prices[$index]) && $option->option_prices[$index] > 0)
                                                    <div class="text-blue-600 font-semibold">+৳{{ number_format($option->option_prices[$index], 2) }}</div>
                                                @endif
                                            </button>
                                        @endforeach
                                    </div>

                                @elseif($option->option_type === 'tabs')
                                    <!-- Tabs -->
                                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                                        <div class="grid grid-cols-{{ min(count($option->option_values), 4) }} bg-gray-100">
                                            @foreach($option->option_values as $index => $value)
                                                <button type="button" 
                                                        data-category="{{ Str::slug($option->option_name) }}" 
                                                        data-price="{{ $option->option_prices[$index] ?? 0 }}"
                                                        data-option-name="{{ $option->option_name }}"
                                                        data-value="{{ $value }}"
                                                        class="tab-option px-4 py-3 text-sm font-medium hover:bg-gray-200 transition {{ $option->default_value === $value || $loop->first ? 'text-gray-900 bg-white' : 'text-gray-600' }}">
                                                    {{ $value }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                @elseif($option->option_type === 'radio')
                                    <!-- Radio Buttons -->
                                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                                        <div class="p-6 space-y-4">
                                            @foreach($option->option_values as $index => $value)
                                                <label class="flex items-center gap-3 cursor-pointer group">
                                                    <input type="radio" 
                                                           name="option_{{ $option->id }}" 
                                                           value="{{ $value }}"
                                                           data-category="{{ Str::slug($option->option_name) }}" 
                                                           data-price="{{ $option->option_prices[$index] ?? 0 }}"
                                                           data-option-name="{{ $option->option_name }}"
                                                           {{ $option->default_value === $value || $loop->first ? 'checked' : '' }}
                                                           {{ $option->is_required ? 'required' : '' }}
                                                           class="price-option w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <div class="flex-1 flex items-center justify-between">
                                                        <span class="text-base font-semibold text-gray-700">{{ $value }}</span>
                                                        @if(isset($option->option_prices[$index]) && $option->option_prices[$index] > 0)
                                                            <span class="text-blue-600 font-semibold">+৳{{ number_format($option->option_prices[$index], 2) }}</span>
                                                        @endif
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                @elseif($option->option_type === 'number')
                                    <!-- Number Input -->
                                    <div class="relative">
                                        <input type="number" 
                                               name="option_{{ $option->id }}"
                                               id="option_{{ $option->id }}"
                                               value="{{ $option->default_value ?? 1 }}"
                                               min="1"
                                               data-category="{{ Str::slug($option->option_name) }}" 
                                               data-price="{{ $option->option_prices[0] ?? 0 }}"
                                               data-option-name="{{ $option->option_name }}"
                                               {{ $option->is_required ? 'required' : '' }}
                                               class="price-option w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg font-medium text-blue-600 bg-white">
                                    </div>

                                @elseif($option->option_type === 'select')
                                    <!-- Select Dropdown -->
                                    <select name="option_{{ $option->id }}"
                                            data-category="{{ Str::slug($option->option_name) }}"
                                            data-option-name="{{ $option->option_name }}"
                                            {{ $option->is_required ? 'required' : '' }}
                                            class="price-option w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        @foreach($option->option_values as $index => $value)
                                            <option value="{{ $value }}" 
                                                    data-price="{{ $option->option_prices[$index] ?? 0 }}"
                                                    {{ $option->default_value === $value || $loop->first ? 'selected' : '' }}>
                                                {{ $value }}
                                                @if(isset($option->option_prices[$index]) && $option->option_prices[$index] > 0)
                                                    (+৳{{ number_format($option->option_prices[$index], 2) }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12 border-2 border-dashed border-gray-300 rounded-lg">
                            <p class="text-gray-500 text-lg">এই পণ্যের জন্য কোন কনফিগারেশন অপশন উপলব্ধ নেই।</p>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">অর্ডার সামারি</h2>

                        <!-- Selected Options -->
                        <div id="selectedOptions" class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                            <!-- Will be populated by JavaScript -->
                        </div>

                        <!-- Pricing -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-700">
                                <span>বেস মূল্য</span>
                                <span id="basePrice" class="font-semibold">৳{{ number_format($product->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>অপশনস মূল্য</span>
                                <span id="optionsPrice" class="font-semibold">৳0.00</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-gray-900 pt-3 border-t border-gray-300">
                                <span>মোট মূল্য</span>
                                <span id="totalPrice">৳{{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <button type="button" 
                                    onclick="addToCart()" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                কার্টে যোগ করুন
                            </button>
                            <a href="/{{ $category->slug }}" 
                               class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-lg transition">
                                ফিরে যান
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')
@endsection

@section('scripts')
<script>
const basePrice = {{ $product->price }};
let optionsPrice = 0;
const selectedOptions = {};

function updatePricing() {
    optionsPrice = 0;
    const selectedOptionsDiv = document.getElementById('selectedOptions');
    selectedOptionsDiv.innerHTML = '';

    // Get all selected options
    document.querySelectorAll('.price-option').forEach(input => {
        let selectedOption, price = 0, optionName = '';

        if (input.type === 'radio' && input.checked) {
            selectedOption = input.value;
            price = parseFloat(input.dataset.price) || 0;
            optionName = input.dataset.optionName;
            selectedOptions[input.name] = { value: selectedOption, price: price };
        } else if (input.tagName === 'SELECT') {
            const selected = input.options[input.selectedIndex];
            selectedOption = selected.value;
            price = parseFloat(selected.dataset.price) || 0;
            optionName = input.dataset.optionName;
            selectedOptions[input.name] = { value: selectedOption, price: price };
        } else if (input.type === 'number') {
            selectedOption = input.value;
            const unitPrice = parseFloat(input.dataset.price) || 0;
            price = unitPrice * parseInt(input.value || 1);
            optionName = input.dataset.optionName;
            selectedOptions[input.name] = { value: selectedOption, price: price };
        } else if (input.classList.contains('border-blue-600') && input.type !== 'radio') {
            // Button option
            selectedOption = input.dataset.value;
            price = parseFloat(input.dataset.price) || 0;
            optionName = input.dataset.optionName;
            const category = input.dataset.category;
            selectedOptions[category] = { value: selectedOption, price: price };
        } else if (input.classList.contains('tab-option') && input.classList.contains('bg-white')) {
            // Tab option
            selectedOption = input.dataset.value;
            price = parseFloat(input.dataset.price) || 0;
            optionName = input.dataset.optionName;
            const category = input.dataset.category;
            selectedOptions[category] = { value: selectedOption, price: price };
        }

        if (selectedOption && optionName) {
            optionsPrice += price;
            
            const optionHtml = `
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">${optionName}</span>
                    <span class="font-medium text-gray-900">${selectedOption}</span>
                </div>
            `;
            selectedOptionsDiv.insertAdjacentHTML('beforeend', optionHtml);
        }
    });

    document.getElementById('optionsPrice').textContent = '৳' + optionsPrice.toFixed(2);
    document.getElementById('totalPrice').textContent = '৳' + (basePrice + optionsPrice).toFixed(2);

    // Update hidden form fields for cart submission
    const cartPriceInput = document.getElementById('cartPrice');
    const cartConfigInput = document.getElementById('cartConfigurations');
    if (cartPriceInput) cartPriceInput.value = (basePrice + optionsPrice).toFixed(2);
    if (cartConfigInput) cartConfigInput.value = JSON.stringify(selectedOptions);
}

// Handle button group selections
document.querySelectorAll('.price-option[type="button"]').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const category = this.dataset.category;
        
        // Remove active class from all buttons in this group
        document.querySelectorAll(`[data-category="${category}"]`).forEach(btn => {
            if(btn.type === 'button') {
                btn.classList.remove('border-blue-600', 'bg-blue-50');
                btn.classList.add('border-gray-300');
            }
        });
        
        // Add active class to selected button
        this.classList.remove('border-gray-300');
        this.classList.add('border-blue-600', 'bg-blue-50');
        
        updatePricing();
    });
});

// Handle tab selections
document.querySelectorAll('.tab-option').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const category = this.dataset.category;
        
        // Remove active class from all tabs in this group
        this.parentElement.querySelectorAll('.tab-option').forEach(btn => {
            btn.classList.remove('text-gray-900', 'bg-white');
            btn.classList.add('text-gray-600');
        });
        
        // Add active class to selected tab
        this.classList.remove('text-gray-600');
        this.classList.add('text-gray-900', 'bg-white');
        
        updatePricing();
    });
});

// Handle radio buttons, selects, and number inputs
document.querySelectorAll('.price-option').forEach(input => {
    if (input.type === 'radio' || input.tagName === 'SELECT' || input.type === 'number') {
        input.addEventListener('change', updatePricing);
        if (input.type === 'number') {
            input.addEventListener('input', updatePricing);
        }
    }
});

function addToCart() {
    const form = document.getElementById('productConfigForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Update hidden form fields before submission
    const cartPriceInput = document.getElementById('cartPrice');
    const cartConfigInput = document.getElementById('cartConfigurations');
    
    if (cartPriceInput) cartPriceInput.value = (basePrice + optionsPrice).toFixed(2);
    if (cartConfigInput) cartConfigInput.value = JSON.stringify(selectedOptions);

    // Submit the form
    form.submit();
}

// Initialize pricing on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePricing();
});
</script>
@endsection
