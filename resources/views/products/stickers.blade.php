@extends('layouts.app')

@section('title', 'Stickers | Chapakhana')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-xs text-gray-500 flex items-center gap-1">
                <a href="/" class="hover:text-blue-600 hover:underline">Home</a>
                <span>/</span>
                <span class="text-gray-800">Stickers</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Content -->
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Stickers</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Create custom stickers that stick around! Perfect for branding, packaging, promotions, or personal projects. From die-cut designs to holographic finishes, we have options for every need.
                    </p>

                    <div class="flex items-center gap-6">
                        <!-- Feefo Rating -->
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.7</span>
                                <div class="flex text-yellow-400 text-xs">
                                    ★★★★★
                                </div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br>
                                <span class="font-normal text-gray-500">Read 892 reviews</span>
                            </div>
                        </div>

                        <!-- Waterproof Badge -->
                        <div class="flex items-center gap-2">
                            <div class="bg-blue-600 text-white text-xs font-bold p-1 rounded-sm">💧</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">
                                Waterproof and weatherproof options available
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Image Slider -->
                <div class="relative group">
                    <div id="hero-slider" class="overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=800&h=400&fit=crop" alt="Custom Stickers" class="w-full h-auto object-cover transition-opacity duration-500" id="slider-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="bg-white pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Choose by product type</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $stickers = [
                        ['title' => 'Die Cut Stickers', 'url' => '/stickers/die-cut', 'img' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=300&h=300&fit=crop'],
                        ['title' => 'Kiss Cut Stickers', 'url' => '/stickers/kiss-cut', 'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=300&fit=crop'],
                        ['title' => 'Vinyl Stickers', 'url' => '/stickers/vinyl', 'img' => 'https://images.unsplash.com/photo-1618609378039-b572f64c5b42?w=300&h=300&fit=crop'],
                        ['title' => 'Clear Stickers', 'url' => '/stickers/clear', 'img' => 'https://images.unsplash.com/photo-1599420186946-7b6fb4e297f0?w=300&h=300&fit=crop'],
                        ['title' => 'Holographic Stickers', 'url' => '/stickers/holographic', 'img' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?w=300&h=300&fit=crop'],
                        ['title' => 'Bumper Stickers', 'url' => '/stickers/bumper', 'img' => 'https://images.unsplash.com/photo-1593642532400-2682810df593?w=300&h=300&fit=crop'],
                    ];
                @endphp

                @foreach($stickers as $sticker)
                    <a href="{{ $sticker['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $sticker['img'] }}" alt="{{ $sticker['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $sticker['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Custom Sticker Printing for Every Purpose</h2>
                <p class="text-gray-600 mb-4">
                    Stickers are a versatile marketing tool perfect for branding, product packaging, event promotions, and personal expression. Our high-quality printing ensures vibrant colors and durable finishes.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Sticker Types</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Die Cut - Custom shaped stickers cut to your design</li>
                            <li>Kiss Cut - Easy peel-off backing for sheets</li>
                            <li>Vinyl - Durable, weatherproof outdoor stickers</li>
                            <li>Holographic - Eye-catching rainbow effect</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Perfect For</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Product packaging and branding</li>
                            <li>Promotional giveaways</li>
                            <li>Laptop and water bottle decoration</li>
                            <li>Bumper stickers and vehicle graphics</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
