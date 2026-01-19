@extends('layouts.app')

@section('title', 'My Orders - ' . config('site.name'))

@section('header')
    @include('partials.header')
@endsection

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
                    <p class="text-gray-600 mt-2">Track and manage your printing orders</p>
                </div>
                <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Continue Shopping
                </a>
            </div>
        </div>

        @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No orders yet</h3>
                <p class="text-gray-600 mb-6">Start shopping and your orders will appear here</p>
                <a href="/" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Browse Products
                </a>
            </div>
        @else
            <!-- Orders List -->
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <!-- Order Items -->
                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="space-y-3">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center gap-4">
                                            @if($item->product_image)
                                                <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_title }}" class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <h4 class="font-medium text-gray-900">{{ $item->product_title }}</h4>
                                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                                @if($item->format)
                                                    <p class="text-sm text-gray-500">Format: {{ $item->format }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <p class="font-semibold text-gray-900">৳{{ number_format($item->price, 2) }}</p>
                                                <p class="text-sm text-gray-600">৳{{ number_format($item->price / $item->quantity, 2) }} each</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium">{{ $order->items->count() }}</span> item(s)
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Total Amount</p>
                                        <p class="text-xl font-bold text-gray-900">৳{{ number_format($order->total, 2) }}</p>
                                    </div>
                                    <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
