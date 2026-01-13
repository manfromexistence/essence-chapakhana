@extends('layouts.app')

@section('title', 'Catalogs | Chapakhana')

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
                <span class="text-gray-800">Catalogs</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Catalogs</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Showcase your products and services with professionally printed catalogs. Perfect for retail, B2B, and trade shows with stunning visuals and premium finishes.
                    </p>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.7</span>
                                <div class="flex text-yellow-400 text-xs">★★★★★</div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br><span class="font-normal text-gray-500">Read 1,123 reviews</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="bg-green-800 text-white text-xs font-bold p-1 rounded-sm">FSC</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">Premium eco-friendly options</p>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1489515217757-5fd1be406fef?w=800&h=400&fit=crop" alt="Catalogs" class="w-full h-auto object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="bg-white pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Choose by catalog type</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $catalogs = [
                        ['title' => 'Product Catalogs', 'url' => '/catalogs/product-catalogs', 'img' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=300&h=300&fit=crop'],
                        ['title' => 'Service Catalogs', 'url' => '/catalogs/service-catalogs', 'img' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=300&h=300&fit=crop'],
                        ['title' => 'Fashion Catalogs', 'url' => '/catalogs/fashion-catalogs', 'img' => 'https://images.unsplash.com/photo-1590736969955-71cc94901144?w=300&h=300&fit=crop'],
                        ['title' => 'Trade Show', 'url' => '/catalogs/trade-show', 'img' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=300&h=300&fit=crop'],
                        ['title' => 'Digital Catalogs', 'url' => '/catalogs/digital-catalogs', 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop'],
                        ['title' => 'Luxury Catalogs', 'url' => '/catalogs/luxury-catalogs', 'img' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=300&h=300&fit=crop'],
                    ];
                @endphp
                @foreach($catalogs as $catalog)
                    <a href="{{ $catalog['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $catalog['img'] }}" alt="{{ $catalog['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $catalog['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Premium Catalog Printing</h2>
            <p class="text-gray-600 mb-4">From product showcases to service guides, our catalogs help you present your offerings professionally. With premium paper stocks and finishing options, your catalog will impress.</p>
            <div class="grid md:grid-cols-2 gap-8 mt-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Catalog Types</h3>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Product showcase catalogs</li>
                        <li>Service and capabilities guides</li>
                        <li>Fashion and seasonal catalogs</li>
                        <li>Luxury and premium editions</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Perfect For</h3>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Retail and wholesale distribution</li>
                        <li>Trade shows and exhibitions</li>
                        <li>Direct mail campaigns</li>
                        <li>Customer appreciation gifts</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
