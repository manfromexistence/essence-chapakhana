@extends('layouts.app')

@section('title', 'Books | Chapakhana')

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
                <span class="text-gray-800">Books</span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Content -->
                <div class="space-y-6 pt-4">
                    <h1 class="text-4xl font-bold text-gray-900">Books</h1>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-lg">
                        Give your book the treatment it deserves: our catalogue contains all the paper and binding options and special finishes you need to customise your publication. And from just one copy.
                    </p>

                    <div class="flex items-center gap-6">
                        <!-- Feefo Rating -->
                        <div class="flex items-center gap-2 border border-gray-200 rounded p-2">
                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-xl font-bold text-gray-800">4.5</span>
                                <div class="flex text-yellow-400 text-xs">
                                    ★★★★☆
                                </div>
                            </div>
                            <div class="text-xs font-bold text-gray-800 border-l border-gray-200 pl-2">
                                feefo<br>
                                <span class="font-normal text-gray-500">Read 80 reviews</span>
                            </div>
                        </div>

                        <!-- FSC Badge -->
                        <div class="flex items-center gap-2">
                            <div class="bg-green-800 text-white text-xs font-bold p-1 rounded-sm">FSC</div>
                            <p class="text-xs text-gray-500 max-w-[150px]">
                                The majority of our products are FSC® certified – explore them now!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Image Slider -->
                <div class="relative group">
                    <div id="hero-slider" class="overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&h=400&fit=crop" alt="Books" class="w-full h-auto object-cover transition-opacity duration-500" id="slider-image">
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
                    $books = [
                        ['title' => 'Paperback book', 'url' => '/books/paperback', 'img' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=300&fit=crop'],
                        ['title' => 'Hardback book', 'url' => '/books/hardback', 'img' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300&h=300&fit=crop'],
                        ['title' => 'Special Finish Hardback', 'url' => '/books/special-finish-hardback', 'img' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?w=300&h=300&fit=crop'],
                        ['title' => 'Comics', 'url' => '/books/comics', 'img' => 'https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?w=300&h=300&fit=crop'],
                        ['title' => 'Self-published book', 'url' => '/books/self-published', 'img' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=300&fit=crop'],
                        ['title' => 'Recipe book', 'url' => '/books/recipe-book', 'img' => 'https://images.unsplash.com/photo-1592430599438-26d6e9a5b975?w=300&h=300&fit=crop'],
                        ['title' => 'Cookery Book', 'url' => '/books/cookery-book', 'img' => 'https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?w=300&h=300&fit=crop'],
                        ['title' => 'Pocket-sized book', 'url' => '/books/pocket-sized', 'img' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=300&fit=crop'],
                        ['title' => 'Lookbook', 'url' => '/books/lookbook', 'img' => 'https://images.unsplash.com/photo-1535905557558-afc4877a26fc?w=300&h=300&fit=crop'],
                        ['title' => 'Manga', 'url' => '/books/manga', 'img' => 'https://images.unsplash.com/photo-1608889825205-eebdb9fc5806?w=300&h=300&fit=crop'],

                    ];
                @endphp

                @foreach($books as $book)
                    <a href="{{ $book['url'] }}" class="group flex flex-col items-center text-center">
                        <div class="w-full aspect-square bg-gray-50 mb-3 overflow-hidden rounded-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <img src="{{ $book['img'] }}" alt="{{ $book['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $book['title'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">High-Quality Custom Book Printing</h2>
                <p class="text-gray-600 mb-4">
                    Give your book the treatment it deserves with our comprehensive book printing services. Whether you're publishing a novel, creating a photo book, or printing a cookbook, we offer all the paper, binding options, and special finishes you need to customize your publication—from just one copy.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Wide Range of Book Types</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Paperback books - lightweight and affordable for novels</li>
                            <li>Hardback books - durable and premium for special publications</li>
                            <li>Special finish hardbacks - luxury options with embossing and foil</li>
                            <li>Comics & manga - vibrant colors and quality paper</li>
                            <li>Self-published books - complete solutions for authors</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Professional Quality & Flexibility</h3>
                        <ul class="list-disc pl-6 space-y-2 text-gray-600">
                            <li>Custom dimensions and page counts available</li>
                            <li>Multiple binding options (perfect, saddle stitch, case bound)</li>
                            <li>FSC® certified paper options for eco-friendly printing</li>
                            <li>High-quality image reproduction for photo books</li>
                            <li>Print from 1 copy to bulk orders</li>
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
