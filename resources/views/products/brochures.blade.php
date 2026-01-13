@extends('layouts.app')

@section('title', 'Marketing Material | Chapakhana')

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
                <span class="text-gray-800">Marketing Material</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Content -->
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Marketing Material</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Promote your brand with professionally printed marketing materials: brochures, flyers, posters, rack cards, door hangers, leaflets, and menus. Perfect for events, retail, and campaigns.
                    </p>

                    <div class="flex items-center gap-6">
                        <!-- Feefo Rating -->
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.8</span>
                                <div class="flex text-yellow-400 text-xs">★★★★★</div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br>
                                <span class="font-normal text-gray-500">Read 1,045 reviews</span>
                            </div>
                        </div>

                        <!-- FSC Badge -->
                        <div class="flex items-center gap-2">
                            <div class="bg-green-800 text-white text-xs font-bold p-1 rounded-sm">FSC</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">Eco-friendly paper options available</p>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=800&h=400&fit=crop" alt="Marketing Materials" class="w-full h-auto object-cover rounded-lg">
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
                        ['title' => 'Flyers', 'url' => '/brochures/flyers', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=300&h=300&fit=crop'],
                        ['title' => 'Tri-fold Brochures', 'url' => '/brochures/tri-fold', 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=300&h=300&fit=crop'],
                        ['title' => 'Bi-fold Brochures', 'url' => '/brochures/bi-fold', 'img' => 'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?w=300&h=300&fit=crop'],
                        ['title' => 'Posters', 'url' => '/brochures/posters', 'img' => 'https://images.unsplash.com/photo-1519455953755-af3b1d8f13b3?w=300&h=300&fit=crop'],
                        ['title' => 'Rack Cards', 'url' => '/brochures/rack-cards', 'img' => 'https://images.unsplash.com/photo-1542751110-97427bbecf20?w=300&h=300&fit=crop'],
                        ['title' => 'Door Hangers', 'url' => '/brochures/door-hangers', 'img' => 'https://images.unsplash.com/photo-1557682224-5b8590b4b74c?w=300&h=300&fit=crop'],
                        ['title' => 'Leaflets', 'url' => '/brochures/leaflets', 'img' => 'https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf?w=300&h=300&fit=crop'],
                        ['title' => 'Menus', 'url' => '/brochures/menus', 'img' => 'https://images.unsplash.com/photo-1526312426976-593c64c0eb18?w=300&h=300&fit=crop'],
                        ['title' => 'Presentation Folders', 'url' => '/brochures/presentation-folders', 'img' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=300&h=300&fit=crop'],
                        ['title' => 'Event Handouts', 'url' => '/brochures/event-handouts', 'img' => 'https://images.unsplash.com/photo-1517433456452-f9633a875f6f?w=300&h=300&fit=crop'],
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
                <h2 class="text-2xl font-bold text-gray-900 mb-4">High-Impact Marketing Prints</h2>
                <p class="text-gray-600 mb-4">
                    From brochures to posters, we offer professional printing with premium stocks, vivid colors, and fast turnaround—ideal for brands in Bangladesh.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Popular Options</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Tri-fold & bi-fold brochures</li>
                            <li>Flyers for events and promotions</li>
                            <li>Posters with vibrant, durable inks</li>
                            <li>Rack cards and leaflets for retail</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Perfect For</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Restaurants, cafes, and retail</li>
                            <li>Exhibitions, trade shows, and fairs</li>
                            <li>Corporate campaigns and launches</li>
                            <li>Community events and NGOs</li>
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
