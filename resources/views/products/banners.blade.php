@extends('layouts.app')

@section('title', 'Banners | Chapakhana')

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
                <span class="text-gray-800">Banners</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Banners</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Eye-catching banners for trade shows, events, retail displays, and promotions. Choose from roll-up, fabric, vinyl, and custom banner options to make your message stand out.
                    </p>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.7</span>
                                <div class="flex text-yellow-400 text-xs">★★★★★</div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br><span class="font-normal text-gray-500">Read 1,089 reviews</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="bg-blue-600 text-white text-xs font-bold p-1 rounded-sm">🏆</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">Award-winning banner designs</p>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1504198458632-1631c46f4506?w=800&h=400&fit=crop" alt="Banners" class="w-full h-auto object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="bg-white pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Choose by banner type</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $banners = [
                        ['title' => 'Roll Up Banners', 'url' => '/banners/roll-up-banners', 'img' => 'https://images.unsplash.com/photo-1557425493-6f90ae4659fc?w=300&h=300&fit=crop'],
                        ['title' => 'Fabric Banners', 'url' => '/banners/fabric-banners', 'img' => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=300&h=300&fit=crop'],
                        ['title' => 'Vinyl Banners', 'url' => '/banners/vinyl-banners', 'img' => 'https://images.unsplash.com/photo-1504198458632-1631c46f4506?w=300&h=300&fit=crop'],
                        ['title' => 'Mesh Banners', 'url' => '/banners/mesh-banners', 'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=300&fit=crop'],
                        ['title' => 'Pop Up Banners', 'url' => '/banners/pop-up-banners', 'img' => 'https://images.unsplash.com/photo-1618609378039-b572f64c5b42?w=300&h=300&fit=crop'],
                        ['title' => 'Hanging Banners', 'url' => '/banners/hanging-banners', 'img' => 'https://images.unsplash.com/photo-1599420186946-7b6fb4e297f0?w=300&h=300&fit=crop'],
                    ];
                @endphp
                @foreach($banners as $banner)
                    <a href="{{ $banner['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $banner['img'] }}" alt="{{ $banner['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $banner['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Professional Banner Printing</h2>
            <p class="text-gray-600 mb-4">Make your brand visible with high-impact banners. From portable roll-up stands to large format vinyl banners, we have solutions for every event and venue.</p>
            <div class="grid md:grid-cols-2 gap-8 mt-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Banner Types</h3>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Roll Up - Portable and reusable</li>
                        <li>Fabric - Premium and lightweight</li>
                        <li>Vinyl - Durable and weatherproof</li>
                        <li>Pop Up - Eye-catching displays</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Perfect For</h3>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600">
                        <li>Trade shows and exhibitions</li>
                        <li>Corporate events</li>
                        <li>Retail displays</li>
                        <li>Promotional campaigns</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
