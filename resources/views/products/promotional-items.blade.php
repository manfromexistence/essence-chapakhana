@extends('layouts.app')

@section('title', 'Promotional Items | Chapakhana')

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
                <span class="text-gray-800">Promotional Items</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Content -->
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Promotional Items</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Branded merchandise to boost awareness: mugs, t-shirts, pens, keychains, tote bags, caps, notebooks, badges, USB drives and more. Great for events, giveaways, and corporate branding.
                    </p>

                    <div class="flex items-center gap-6">
                        <!-- Feefo Rating -->
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.6</span>
                                <div class="flex text-yellow-400 text-xs">★★★★★</div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br>
                                <span class="font-normal text-gray-500">Read 862 reviews</span>
                            </div>
                        </div>

                        <!-- Eco Badge -->
                        <div class="flex items-center gap-2">
                            <div class="bg-green-800 text-white text-xs font-bold p-1 rounded-sm">Eco</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">Sustainable materials available</p>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1545235617-9465d2e5f327?w=800&h=400&fit=crop" alt="Promotional Items" class="w-full h-auto object-cover rounded-lg">
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
                    $items = [
                        ['title' => 'Mugs', 'url' => '/promotional-items/mugs', 'img' => 'https://images.unsplash.com/photo-1520975862376-6a1b19a8abcf?w=300&h=300&fit=crop'],
                        ['title' => 'T-Shirts', 'url' => '/promotional-items/t-shirts', 'img' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=300&h=300&fit=crop'],
                        ['title' => 'Pens', 'url' => '/promotional-items/pens', 'img' => 'https://images.unsplash.com/photo-1516826958883-1d92f80ed19f?w=300&h=300&fit=crop'],
                        ['title' => 'Keychains', 'url' => '/promotional-items/keychains', 'img' => 'https://images.unsplash.com/photo-1536440136628-364bdbf56a20?w=300&h=300&fit=crop'],
                        ['title' => 'Tote Bags', 'url' => '/promotional-items/tote-bags', 'img' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?w=300&h=300&fit=crop'],
                        ['title' => 'Caps', 'url' => '/promotional-items/caps', 'img' => 'https://images.unsplash.com/photo-1520974756888-1bfaac2d6c34?w=300&h=300&fit=crop'],
                        ['title' => 'Notebooks', 'url' => '/promotional-items/notebooks', 'img' => 'https://images.unsplash.com/photo-1506111583091-bb4fa0f6d64a?w=300&h=300&fit=crop'],
                        ['title' => 'Badges', 'url' => '/promotional-items/badges', 'img' => 'https://images.unsplash.com/photo-1553531888-a26f6d1f2b84?w=300&h=300&fit=crop'],
                        ['title' => 'USB Drives', 'url' => '/promotional-items/usb-drives', 'img' => 'https://images.unsplash.com/photo-1520367445093-1f5168391f53?w=300&h=300&fit=crop'],
                        ['title' => 'Water Bottles', 'url' => '/promotional-items/water-bottles', 'img' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=300&h=300&fit=crop'],
                    ];
                @endphp

                @foreach($items as $item)
                    <a href="{{ $item['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $item['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Branded Giveaways & Merchandise</h2>
                <p class="text-gray-600 mb-4">
                    Boost brand visibility with high-quality promotional products. Ideal for events, corporate gifts, and marketing campaigns in Bangladesh.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Popular Items</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Custom mugs, water bottles, and USB drives</li>
                            <li>Branded apparel: t-shirts and caps</li>
                            <li>Office essentials: pens and notebooks</li>
                            <li>Event-ready badges and keychains</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Perfect For</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Corporate campaigns and giveaways</li>
                            <li>Educational institutions and NGOs</li>
                            <li>Trade shows, fairs, and festivals</li>
                            <li>Retail promotions and loyalty programs</li>
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
