@extends('layouts.app')

@section('title', 'Checkout | Chapakhana')

@section('header')
    @include('partials.header')
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="text-gray-600 mt-2">Complete your order</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Customer Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Customer Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="shipping_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="shipping_name" name="shipping_name" 
                                       value="{{ old('shipping_name', $user->name ?? '') }}" 
                                       required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="Enter your full name">
                                @error('shipping_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="shipping_email" name="shipping_email" 
                                       value="{{ old('shipping_email', $user->email ?? '') }}" 
                                       required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="your@email.com">
                                @error('shipping_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="shipping_phone" name="shipping_phone" 
                                       value="{{ old('shipping_phone') }}" 
                                       required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="+880 1XXX-XXXXXX">
                                @error('shipping_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address <span class="text-red-500">*</span>
                                </label>
                                <textarea id="shipping_address" name="shipping_address" 
                                          rows="3" 
                                          required 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                          placeholder="Enter your complete address">{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-2">
                                    City <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="shipping_city" name="shipping_city" 
                                       value="{{ old('shipping_city') }}" 
                                       required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="City">
                                @error('shipping_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_zip" class="block text-sm font-medium text-gray-700 mb-2">
                                    Postal Code <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="shipping_zip" name="shipping_zip" 
                                       value="{{ old('shipping_zip') }}" 
                                       required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="Postal code">
                                @error('shipping_zip')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information (Dynamic Fields) -->
                    @if(isset($fields['shipping']))
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Additional Shipping Details</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($fields['shipping'] as $field)
                            <div class="{{ $field->type == 'textarea' ? 'md:col-span-2' : '' }}">
                                <label for="{{ $field->field_key }}" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $field->label }}
                                    @if($field->is_required)<span class="text-red-500">*</span>@endif
                                </label>

                                @if($field->type == 'textarea')
                                    <textarea id="{{ $field->field_key }}" name="{{ $field->field_key }}" rows="3" {{ $field->is_required ? 'required' : '' }} class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $field->placeholder }}">{{ old($field->field_key) }}</textarea>
                                @else
                                    <input type="{{ $field->type }}" id="{{ $field->field_key }}" name="{{ $field->field_key }}" value="{{ old($field->field_key) }}" {{ $field->is_required ? 'required' : '' }} class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $field->placeholder }}">
                                @endif

                                @error($field->field_key)
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Payment Method -->
                    @if(isset($fields['payment']))
                    @foreach($fields['payment'] as $field)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $field->label }}</h2>

                        <div class="space-y-3">
                            @if($field->options)
                            @foreach($field->options as $option)
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 transition">
                                <input type="radio" name="{{ $field->field_key }}" value="{{ $option['value'] }}" {{ old($field->field_key) == $option['value'] ? 'checked' : ($loop->first ? 'checked' : '') }} class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <div class="font-medium text-gray-900">{{ $option['label'] }}</div>
                                    @if(isset($option['description']))
                                    <div class="text-sm text-gray-500">{{ $option['description'] }}</div>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                            @endif
                        </div>
                        @error($field->field_key)
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach
                    @endif

                    <!-- Order Notes -->
                    @if(isset($fields['notes']))
                    @foreach($fields['notes'] as $field)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $field->label }}</h2>
                        <textarea id="{{ $field->field_key }}" name="{{ $field->field_key }}" rows="4" placeholder="{{ $field->placeholder }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old($field->field_key) }}</textarea>
                        @error($field->field_key)
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('cart.index') }}" class="flex-1 px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition text-center">
                            Back to Cart
                        </a>
                        <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        @foreach($cart as $item)
                        <div class="flex gap-3">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-900">{{ $item['title'] }}</h3>
                                <p class="text-xs text-gray-500">{{ $item['format'] }}</p>
                                <p class="text-sm text-gray-700">Qty: {{ $item['quantity'] }} × ৳{{ number_format($item['price'], 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal ({{ $itemCount }} {{ $itemCount == 1 ? 'item' : 'items' }})</span>
                            <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-green-600">Free</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax (8%)</span>
                            <span class="font-medium text-gray-900">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-2 flex justify-between">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-lg font-bold text-blue-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-xs text-blue-800">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Secure checkout powered by Stripe
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
