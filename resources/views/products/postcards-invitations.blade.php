@extends('layouts.app')

@section('title', 'Postcards and Invitations | Chapakhana')

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
                <span class="text-gray-800">Postcards and Invitations</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Content -->
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Postcards and Invitations</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Create memorable moments with custom-printed postcards and invitations. From wedding invitations to promotional postcards, our premium printing ensures your message stands out with elegance and style.
                    </p>

                    <div class="flex items-center gap-6">
                        <!-- Feefo Rating -->
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.9</span>
                                <div class="flex text-yellow-400 text-xs">
                                    ★★★★★
                                </div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br>
                                <span class="font-normal text-gray-500">Read 1,567 reviews</span>
                            </div>
                        </div>

                        <!-- FSC Badge -->
                        <div class="flex items-center gap-2">
                            <div class="bg-green-800 text-white text-xs font-bold p-1 rounded-sm">FSC</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">
                                Premium paper stocks for elegant invitations
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Image Slider -->
                <div class="relative group">
                    <div id="hero-slider" class="overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&h=400&fit=crop" alt="Postcards and Invitations" class="w-full h-auto object-cover transition-opacity duration-500" id="slider-image">
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
                    $products = [
                        ['title' => 'Postcards', 'url' => '/postcards-invitations/postcards', 'img' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=300&h=300&fit=crop'],
                        ['title' => 'Wedding Invitations', 'url' => '/postcards-invitations/wedding-invitations', 'img' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=300&h=300&fit=crop'],
                        ['title' => 'Birthday Invitations', 'url' => '/postcards-invitations/birthday-invitations', 'img' => 'https://images.unsplash.com/photo-1530103043960-ef38714abb15?w=300&h=300&fit=crop'],
                        ['title' => 'Greeting Cards', 'url' => '/postcards-invitations/greeting-cards', 'img' => 'https://images.unsplash.com/photo-1543168256-418811576931?w=300&h=300&fit=crop'],
                        ['title' => 'Thank You Cards', 'url' => '/postcards-invitations/thank-you-cards', 'img' => 'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=300&h=300&fit=crop'],
                        ['title' => 'Announcements', 'url' => '/postcards-invitations/announcements', 'img' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=300&h=300&fit=crop'],
                    ];
                @endphp

                @foreach($products as $product)
                    <a href="{{ $product['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $product['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Custom Postcards and Invitations Printing</h2>
                <p class="text-gray-600 mb-4">
                    Make your special occasions unforgettable with professionally printed postcards and invitations. Our premium paper stocks and printing techniques ensure your invitations leave a lasting impression on your guests.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Popular Products</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Wedding invitations - Elegant designs on premium paper</li>
                            <li>Birthday invitations - Fun and colorful options</li>
                            <li>Promotional postcards - Cost-effective marketing</li>
                            <li>Thank you cards - Express gratitude in style</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Customization Options</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Multiple paper stocks and finishes</li>
                            <li>Standard and custom sizes available</li>
                            <li>Matte, glossy, or textured finishes</li>
                            <li>Envelopes included with invitations</li>
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
