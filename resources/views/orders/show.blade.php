@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - ' . config('site.name'))

@section('header')
    @include('partials.header')
@endsection

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Orders
            </a>
        </div>

        <!-- Order Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                    <p class="text-gray-600 mt-1">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-medium
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Status Timeline -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex items-center justify-between">
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 mx-auto rounded-full bg-green-500 flex items-center justify-center text-white mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-900">Placed</p>
                    </div>
                    <div class="flex-1 h-1 {{ in_array($order->status, ['processing', 'completed']) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 mx-auto rounded-full {{ in_array($order->status, ['processing', 'completed']) ? 'bg-green-500' : 'bg-gray-200' }} flex items-center justify-center text-white mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium {{ in_array($order->status, ['processing', 'completed']) ? 'text-gray-900' : 'text-gray-400' }}">Processing</p>
                    </div>
                    <div class="flex-1 h-1 {{ $order->status === 'completed' ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 mx-auto rounded-full {{ $order->status === 'completed' ? 'bg-green-500' : 'bg-gray-200' }} flex items-center justify-center text-white mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium {{ $order->status === 'completed' ? 'text-gray-900' : 'text-gray-400' }}">Completed</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-start gap-4 pb-4 border-b border-gray-200 last:border-0 last:pb-0">
                                @if($item->product_image)
                                    <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_title }}" class="w-20 h-20 object-cover rounded-lg">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $item->product_title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">Quantity: {{ $item->quantity }}</p>
                                    @if($item->format)
                                        <p class="text-sm text-gray-500">Format: {{ $item->format }}</p>
                                    @endif
                                    <p class="text-sm text-gray-600">Unit Price: ৳{{ number_format($item->price / $item->quantity, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">৳{{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary & Details -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium text-gray-900">৳{{ number_format($order->subtotal ?? $order->total, 2) }}</span>
                        </div>
                        @if($order->tax)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium text-gray-900">৳{{ number_format($order->tax, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-green-600">Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between">
                            <span class="font-semibold text-gray-900">Total</span>
                            <span class="font-bold text-xl text-gray-900">৳{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Information</h2>
                    <div class="space-y-3 text-sm">
                        @if($order->shipping_name)
                            <div>
                                <p class="text-gray-600">Name</p>
                                <p class="font-medium text-gray-900">{{ $order->shipping_name }}</p>
                            </div>
                        @endif
                        @if($order->shipping_email)
                            <div>
                                <p class="text-gray-600">Email</p>
                                <p class="font-medium text-gray-900">{{ $order->shipping_email }}</p>
                            </div>
                        @endif
                        @if($order->shipping_phone)
                            <div>
                                <p class="text-gray-600">Phone</p>
                                <p class="font-medium text-gray-900">{{ $order->shipping_phone }}</p>
                            </div>
                        @endif
                        @if($order->shipping_address)
                            <div>
                                <p class="text-gray-600">Address</p>
                                <p class="font-medium text-gray-900">{{ $order->shipping_address }}</p>
                                @if($order->shipping_city)
                                    <p class="font-medium text-gray-900">{{ $order->shipping_city }}@if($order->shipping_zip), {{ $order->shipping_zip }}@endif</p>
                                @endif
                            </div>
                        @endif
                        @if($order->payment_method)
                            <div>
                                <p class="text-gray-600">Payment Method</p>
                                <p class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if($order->has_design_request)
                <!-- Design Request -->
                <div class="bg-purple-50 rounded-lg border border-purple-200 p-6">
                    <h3 class="font-semibold text-purple-900 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        Design Request
                    </h3>
                    <p class="text-sm text-purple-800 mb-2">You requested design assistance for this order.</p>
                    @if($order->design_request_notes)
                        <div class="bg-white rounded p-3 text-sm text-gray-700 mb-2">
                            {{ $order->design_request_notes }}
                        </div>
                    @endif
                    @if($order->design_file_path)
                        <a href="{{ asset('storage/' . $order->design_file_path) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-purple-700 hover:text-purple-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            View Uploaded File
                        </a>
                    @endif
                </div>
                @endif

                <!-- Need Help -->
                <div class="bg-blue-50 rounded-lg border border-blue-200 p-6">
                    <h3 class="font-semibold text-blue-900 mb-2">Need Help?</h3>
                    <p class="text-sm text-blue-800 mb-4">Contact us if you have any questions about your order.</p>
                    <a href="mailto:support@chapakhana.com" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
