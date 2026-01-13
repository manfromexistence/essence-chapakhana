@extends('layouts.app')

@section('title', 'Business Cards | Chapakhana')

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
                <span class="text-gray-800">Business Cards</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Content -->
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Business Cards</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Make a lasting impression with professionally printed business cards. Whether you're at a networking event, meeting a new client, or attending a trade show, a high-quality custom business card ensures your brand stands out.
                    </p>

                    <div class="flex items-center gap-6">
                        <!-- Feefo Rating -->
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.8</span>
                                <div class="flex text-yellow-400 text-xs">
                                    ★★★★★
                                </div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br>
                                <span class="font-normal text-gray-500">Read 1,248 reviews</span>
                            </div>
                        </div>

                        <!-- FSC Badge -->
                        <div class="flex items-center gap-2">
                            <div class="bg-green-800 text-white text-xs font-bold p-1 rounded-sm">FSC</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">
                                Eco-friendly cardstock options available
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Image Slider -->
                <div class="relative group">
                    <div id="hero-slider" class="overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&h=400&fit=crop" alt="Business Cards" class="w-full h-auto object-cover transition-opacity duration-500" id="slider-image">
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
                    $cards = [
                        ['title' => 'Classic Business Cards', 'url' => '/business-cards/classic', 'img' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=300&h=300&fit=crop'],
                        ['title' => 'Square Business Cards', 'url' => '/business-cards/square', 'img' => 'https://images.unsplash.com/photo-1563906267088-b029e7101114?w=300&h=300&fit=crop'],
                        ['title' => 'Rounded Corner Cards', 'url' => '/business-cards/rounded-corners', 'img' => 'https://images.unsplash.com/photo-1611926653670-1e4a8ef3cf70?w=300&h=300&fit=crop'],
                        ['title' => 'Matte Business Cards', 'url' => '/business-cards/matte', 'img' => 'https://images.unsplash.com/photo-1557821552-17105176677c?w=300&h=300&fit=crop'],
                        ['title' => 'Glossy Business Cards', 'url' => '/business-cards/glossy', 'img' => 'https://images.unsplash.com/photo-1635776062127-d379bfcba9f8?w=300&h=300&fit=crop'],
                        ['title' => 'Premium Business Cards', 'url' => '/business-cards/premium', 'img' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=300&h=300&fit=crop'],
                    ];
                @endphp

                @foreach($cards as $card)
                    <a href="{{ $card['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $card['img'] }}" alt="{{ $card['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $card['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">High-Quality Custom Business Card Printing</h2>
                <p class="text-gray-600 mb-4">
                    Even in today's digital world, business cards remain a powerful networking tool. A well-designed card provides essential contact details and showcases your brand personality—all in a pocket-sized format.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Wide Range of Options</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Classic paper business cards - affordable and professional</li>
                            <li>Glossy & matte finishes - enhanced durability</li>
                            <li>Ultra thick cards - premium sophisticated look</li>
                            <li>Square format - unique modern design</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Standard Size & Design</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Standard size: 3.5" x 2"</li>
                            <li>Fits easily in wallets and cardholders</li>
                            <li>Custom dimensions available</li>
                            <li>Single or double-sided printing</li>
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
