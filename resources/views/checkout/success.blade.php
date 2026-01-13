@extends('layouts.app')

@section('title', 'Order Confirmed | Chapakhana')

@section('header')
    @include('partials.header')
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        <div class="bg-white rounded-xl shadow-lg p-8 text-center mb-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Placed Successfully!</h1>
            <p class="text-gray-600 mb-6">Thank you for your order. We'll send you a confirmation email shortly.</p>

            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600">Order Number</p>
                <p class="text-2xl font-bold text-blue-600">{{ $order['order_number'] }}</p>
            </div>

            <p class="text-sm text-gray-500">Order placed on {{ $order['date']->format('F j, Y \a\t g:i A') }}</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Order Details</h2>

            <div class="space-y-4 mb-6">
                @foreach($order['items'] as $item)
                <div class="flex gap-4 pb-4 border-b border-gray-200">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-900">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $item['format'] }}</p>
                        <p class="text-sm text-gray-700 mt-1">Quantity: {{ $item['quantity'] }} × ৳{{ number_format($item['price'], 2) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900">৳{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="border-t border-gray-200 pt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-900">৳{{ number_format($order['subtotal'], 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Shipping</span>
                    <span class="text-green-600">Free</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tax</span>
                    <span class="text-gray-900">৳{{ number_format($order['tax'], 2) }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-2">
                    <span class="text-gray-900">Total</span>
                    <span class="text-blue-600">${{ number_format($order['total'], 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping Information -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Shipping Information</h2>
            <div class="text-gray-700 space-y-1">
                <p class="font-medium">{{ $order['shipping']['shipping_name'] }}</p>
                <p>{{ $order['shipping']['shipping_address'] }}</p>
                <p>{{ $order['shipping']['shipping_city'] }}, {{ $order['shipping']['shipping_state'] }} {{ $order['shipping']['shipping_zip'] }}</p>
                <p>{{ $order['shipping']['shipping_country'] }}</p>
                <p class="mt-3">{{ $order['shipping']['shipping_email'] }}</p>
                <p>{{ $order['shipping']['shipping_phone'] }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 justify-center">
            <a href="{{ route('shop') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection
