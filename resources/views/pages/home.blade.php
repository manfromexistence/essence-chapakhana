@extends('layouts.app')

@section('title', 'Chapakhana - Every page tells your story')

@section('header')
    @include('partials.header')
@endsection

@push('styles')
<style>
    .slider-item {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
    }
    .slider-item.active {
        opacity: 1;
        visibility: visible;
        z-index: 10;
    }
    .slider-dot.active {
        background-color: white !important;
        transform: scale(1.2);
    }
</style>
@endpush

@section('content')
    <!-- Hero Slider Section -->
    <section class="relative bg-white py-3">
        <div class="max-w-7xl mx-auto relative h-[500px] md:h-[600px] overflow-hidden rounded-3xl">
            <!-- Stats Badge - Top Right -->
            @if(isset($homeContent['hero_slider']['stats']))
            <div class="absolute top-8 right-8 z-20 bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-6 max-w-xs">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex-shrink-0">
                        <div class="text-4xl font-bold text-emerald-600">{{ $homeContent['hero_slider']['stats']['percentage'] ?? '93' }}%</div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 leading-tight">{{ $homeContent['hero_slider']['stats']['label'] ?? 'of our customers would buy again' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 pt-3 border-t border-gray-200">
                    <div class="flex text-yellow-400">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">{{ $homeContent['hero_slider']['stats']['reviews_count'] ?? '256,839' }} reviews</span>
                </div>
            </div>
            @endif

            <!-- Slider Container -->
            <div id="heroSlider" class="relative h-full">
                @php
                    $slides = $homeContent['hero_slider']['slides'] ?? [];
                    $defaultSlides = [
                        ['title' => 'স্বাগতম একাওয়াইজের স্টু এবং কলেজ', 'subtitle' => 'এর পক্ষ থেকে!', 'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1920&h=1080&fit=crop'],
                        ['title' => 'আপনার গল্প, আমাদের ছাপা', 'subtitle' => 'মানসম্মত প্রিন্টিং সেবা, সাশ্রয়ী মূল্যে', 'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1920&h=1080&fit=crop'],
                        ['title' => 'শুধু প্রিন্টার নয়, আপনার বিশ্বস্ত সঙ্গী', 'subtitle' => 'প্রতিটি পদক্ষেপে আমরা আছি আপনার পাশে', 'image' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=1920&h=1080&fit=crop']
                    ];
                    $slides = empty($slides) ? $defaultSlides : $slides;
                @endphp

                @foreach($slides as $index => $slide)
                <div class="slider-item {{ $index === 0 ? 'active' : '' }} absolute inset-0">
                    <img src="{{ $slide['image'] ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1920&h=1080&fit=crop' }}" 
                         alt="Hero Background {{ $index + 1 }}" 
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/50"></div>
                    <div class="relative h-full flex items-center justify-center text-center px-4">
                        <div class="max-w-4xl">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-2xl">
                                {{ $slide['title'] ?? '' }}
                                @if(isset($slide['subtitle']) && $slide['subtitle'])
                                <span class="block text-lg sm:text-xl md:text-2xl lg:text-3xl mt-3 font-normal">{{ $slide['subtitle'] }}</span>
                                @endif
                            </h1>
                            @if(isset($slide['cta_text']) && $slide['cta_text'])
                            <div class="mt-8">
                                <a href="{{ $slide['cta_url'] ?? '#' }}" 
                                   class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-8 py-4 rounded-lg shadow-lg transition-all duration-300 hover:scale-105">
                                    {{ $slide['cta_text'] }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Dots - Bottom Left -->
            @if(count($slides) > 1)
            <div class="absolute bottom-8 left-8 flex gap-2.5 z-20">
                @foreach($slides as $index => $slide)
                <button onclick="goToSlide({{ $index }})" 
                        class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 {{ $index === 0 ? 'active' : '' }}"></button>
                @endforeach
            </div>

            <!-- Navigation Arrows - Bottom Right -->
            <div class="absolute bottom-8 right-8 flex gap-3 z-20">
                <button onclick="prevSlide()" class="bg-emerald-600/90 hover:bg-emerald-600 text-white p-3 rounded-lg shadow-lg transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button onclick="nextSlide()" class="bg-emerald-600/90 hover:bg-emerald-600 text-white p-3 rounded-lg shadow-lg transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Headline & Short Description in Bangla Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-foreground mb-6">
                {{ $homeContent['headline']['title'] ?? 'আপনার স্বপ্নকে বাস্তবে রূপান্তরিত করুন' }}
            </h2>
            <p class="text-lg sm:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
                {{ $homeContent['headline']['description'] ?? 'চাপাখানা হলো আপনার বিশ্বস্ত প্রিন্টিং সঙ্গী। উচ্চমানের প্রিন্টিং সেবা, দ্রুত ডেলিভারি এবং প্রতিযোগিতামূলক মূল্যে আমরা আপনার ব্যবসায়িক লক্ষ্য অর্জনে সহায়তা করি। বই, ম্যাগাজিন, ব্যানার থেকে শুরু করে সকল ধরনের মার্কেটিং ম্যাটেরিয়াল - সবকিছুই পাবেন এক জায়গায়।' }}
            </p>
        </div>
    </section>

    <!-- Features Section -->
    {{-- <section class="py-12 sm:py-14 lg:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 sm:gap-8">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mb-3 sm:mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">মান নিশ্চিতকরণ</h3>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mb-3 sm:mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">সাশ্রয়ী মূল্য</h3>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mb-3 sm:mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">দ্রুত ডেলিভারি</h3>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mb-3 sm:mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">গ্রাহক সন্তুষ্টি</h3>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mb-3 sm:mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">পেশাদার পরামর্শ</h3>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mb-3 sm:mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">বিশাল সংগ্রহ</h3>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- How to Order Banner Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Side - Order Instructions -->
                <div class="space-y-6">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-foreground leading-tight">
                        <span class="text-primary">{{ $homeContent['how_to_order']['title'] ?? '০ টাকা বিনিয়োগে শুরু করুন' }}</span>
                    </h2>
                    
                    <div class="space-y-6">
                        @if(isset($homeContent['how_to_order']['steps']) && count($homeContent['how_to_order']['steps']) > 0)
                            @foreach($homeContent['how_to_order']['steps'] as $step)
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                                            <span class="text-lg font-bold text-primary-foreground">{{ $step['number'] ?? $loop->iteration }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-foreground mb-1">{{ $step['title'] }}</h3>
                                        <p class="text-muted-foreground text-base leading-relaxed">
                                            {{ $step['description'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Step 1 -->
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                                        <span class="text-lg font-bold text-primary-foreground">১</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-foreground mb-1">পণ্য নির্বাচন করুন</h3>
                                    <p class="text-muted-foreground text-base leading-relaxed">
                                        ১০০০+ উচ্চমানের পণ্য থেকে আপনার পছন্দের পণ্য বেছে নিন
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                                        <span class="text-lg font-bold text-primary-foreground">২</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-foreground mb-1">ডিজাইন যুক্ত করুন</h3>
                                    <p class="text-muted-foreground text-base leading-relaxed">
                                        সহজ এবং মজাদার উপায়ে আপনার পণ্যের ডিজাইন করুন!
                                    </p>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                                        <span class="text-lg font-bold text-primary-foreground">৩</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-foreground mb-1">বিক্রয় শুরু করুন</h3>
                                    <p class="text-muted-foreground text-base leading-relaxed">
                                        আপনি লাভের মার্জিন নির্ধারণ করুন, উৎপাদন ও ডেলিভারি আমরা করবো
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="/shop" class="inline-flex items-center justify-center bg-primary hover:bg-primary/90 text-primary-foreground font-bold py-3 px-8 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-base">
                            ডিজাইন শুরু করুন
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#learn-more" class="inline-flex items-center justify-center bg-background hover:bg-muted text-foreground font-bold py-3 px-8 rounded-lg border-2 border-border hover:border-input transition-all duration-300 text-base">
                            আরও জানুন
                        </a>
                    </div>
                </div>

                <!-- Right Side - Video Frame -->
                <div class="relative flex items-center justify-start lg:justify-center lg:pl-8">
                    <!-- Video Container -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-card w-full max-w-md aspect-square">
                        @php
                            $videoUrl = $homeContent['how_to_order']['video_url'] ?? '';
                            $posterUrl = $homeContent['how_to_order']['video_poster'] ?? '';
                            
                            // Check if URLs are swapped (YouTube URL in poster field)
                            if ((str_contains($posterUrl, 'youtube.com') || str_contains($posterUrl, 'youtu.be')) && !str_contains($videoUrl, 'youtube.com')) {
                                // Swap them
                                $temp = $videoUrl;
                                $videoUrl = $posterUrl;
                                $posterUrl = $temp;
                            }
                            
                            // Use default if still empty
                            if (empty($videoUrl)) {
                                $videoUrl = 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4';
                            }
                            if (empty($posterUrl)) {
                                $posterUrl = 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=1200&h=1200&fit=crop';
                            }
                            
                            $isYouTube = str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be');
                            
                            // Convert YouTube URL to embed URL
                            if ($isYouTube) {
                                if (str_contains($videoUrl, 'youtu.be/')) {
                                    preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $videoUrl, $matches);
                                    $videoId = $matches[1] ?? '';
                                } else {
                                    preg_match('/[?&]v=([a-zA-Z0-9_-]+)/', $videoUrl, $matches);
                                    $videoId = $matches[1] ?? '';
                                }
                                $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                            }
                        @endphp

                        @if($isYouTube && !empty($videoId))
                            <!-- YouTube Video Embed -->
                            <iframe 
                                class="w-full h-full" 
                                src="{{ $embedUrl }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        @else
                            <!-- Regular Video Player -->
                            <video 
                                class="w-full h-full object-cover" 
                                controls 
                                poster="{{ $posterUrl }}">
                                <source src="{{ $videoUrl }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            
                            <!-- Play Button Overlay (visible before video starts) -->
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-20 hover:bg-opacity-30 transition-all duration-300 cursor-pointer group" onclick="this.previousElementSibling.play(); this.style.display='none';">
                                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-10 h-10 text-primary ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-primary/20 rounded-full -z-10"></div>
                    <div class="absolute -top-4 -left-4 w-32 h-32 bg-primary/20 rounded-full -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-8 sm:mb-12">{{ $homeContent['best_sellers']['title'] ?? 'জনপ্রিয় পণ্য' }}</h2>
            <div class="relative">
                <div class="flex gap-4 sm:gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory pb-4 cursor-grab scroll-smooth select-none touch-pan-y" id="bestSellersContainer">
                    @if(isset($homeContent['best_sellers']['products']) && count($homeContent['best_sellers']['products']) > 0)
                        @foreach($homeContent['best_sellers']['products'] as $product)
                            <div class="flex-none w-64 sm:w-72 snap-center">
                                <a href="{{ $product['url'] ?? '#' }}" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                        <img src="{{ $product['image'] ?? 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=400&fit=crop' }}" alt="{{ $product['title'] }}" class="w-full h-full object-contain">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="text-lg font-semibold text-card-foreground">{{ $product['title'] }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/magazines" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=400&fit=crop" alt="Magazines" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Magazines</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/books" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=400&fit=crop" alt="Books" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Books</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/catalogs" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1489515217757-5fd1be406fef?w=400&h=400&fit=crop" alt="Catalogs" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Catalog</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/brochures" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400&h=400&fit=crop" alt="Marketing Material" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Marketing Material</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/business-cards" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=400&h=400&fit=crop" alt="Business Cards" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Business Cards</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/postcards-invitations" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1557682224-5b8590cd9ec5?w=400&h=400&fit=crop" alt="Invitation & Stationery" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Invitation & Stationery</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/banners" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1504198458632-1631c46f4506?w=400&h=400&fit=crop" alt="Banners" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Banners</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex-none w-64 sm:w-72 snap-center">
                            <a href="/promotional-items" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                    <img src="https://images.unsplash.com/photo-1611532736579-6b16e2b50449?w=400&h=400&fit=crop" alt="Promotional Items" class="w-full h-full object-contain">
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold text-card-foreground">Promotional Items</h3>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
                <button onclick="scrollBestSellers('left')" class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-card hover:bg-muted text-foreground p-3 rounded-full shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button onclick="scrollBestSellers('right')" class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-card hover:bg-muted text-foreground p-3 rounded-full shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-4">{{ $homeContent['testimonials']['title'] ?? 'গ্রাহকদের মতামত' }}</h2>
                <p class="text-lg text-muted-foreground">{{ $homeContent['testimonials']['subtitle'] ?? 'সারা বাংলাদেশ জুড়ে হাজারো ব্যবসায়ীর বিশ্বস্ত সঙ্গী' }}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($homeContent['testimonials']['items']) && count($homeContent['testimonials']['items']) > 0)
                    @foreach($homeContent['testimonials']['items'] as $testimonial)
                            <div class="bg-card rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-center mb-4">
                                    @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-card-foreground mb-4 leading-relaxed">"{{ $testimonial['text'] }}"</p>
                                <div class="flex items-center">
                                    @if(isset($testimonial['avatar_image']) && $testimonial['avatar_image'])
                                        <img src="{{ $testimonial['avatar_image'] }}" alt="{{ $testimonial['author'] }}" class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center text-primary font-bold text-lg">{{ $testimonial['avatar_initial'] ?? mb_substr($testimonial['author'], 0, 1) }}</div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="font-semibold text-foreground">{{ $testimonial['author'] }}</p>
                                        <p class="text-sm text-muted-foreground">{{ $testimonial['designation'] }}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @else
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 mb-4 leading-relaxed">"অসাধারণ প্রিন্ট কোয়ালিটি এবং দ্রুত ডেলিভারি! আমাদের সব মার্কেটিং ম্যাটেরিয়ালের জন্য চাপাখানা এখন প্রথম পছন্দ। অবশ্যই সুপারিশ করব!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-lg">আ</div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-900">আহমেদ রহমান</p>
                            <p class="text-sm text-gray-500">সিইও, টেক সলিউশন্স লিমিটেড</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 mb-4 leading-relaxed">"চমৎকার সেবা এবং সাশ্রয়ী মূল্য। আমাদের কোম্পানির ক্যাটালগ তারা অসাধারণভাবে প্রিন্ট করেছে এবং সময়মতো ডেলিভারি দিয়েছে। আবারও ব্যবহার করবো!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-700 font-bold text-lg">সা</div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-900">সাদিয়া করিম</p>
                            <p class="text-sm text-gray-500">মার্কেটিং ম্যানেজার, ফ্যাশন হাব</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 mb-4 leading-relaxed">"পেশাদার টিম এবং দারুণ কাস্টমার সাপোর্ট। আমাদের বিয়ের কার্ড ডিজাইন ও প্রিন্ট করতে তারা সাহায্য করেছে। ধন্যবাদ চাপাখানা!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-700 font-bold text-lg">র</div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-900">রফিক হোসেন</p>
                            <p class="text-sm text-gray-500">ব্যবসায়ী</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Who Trust Us Section -->


    <!-- Offer Banner Section -->
  

    <!-- Magazines, Books, and Catalogs Section -->
    {{-- <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                        Magazines, Books, and Catalogs
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                        Describe your brand, tell your story, or showcase all your products in style. Choose the size, material, and binding that suit you, and customize magazines, books and catalogs quickly and easily—just the way you like.
                    </p>
                    <a href="/books" class="inline-block border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                        Discover More
                    </a>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&h=500&fit=crop" alt="Magazines, Books, and Catalogs" class="w-full h-auto rounded-lg shadow-2xl">
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-500 rounded-lg -z-10 hidden sm:block"></div>
                        <div class="absolute -top-4 -left-4 w-32 h-32 bg-green-500 rounded-lg -z-10 hidden sm:block"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Signs & Banners Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-gray-100 to-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 items-center">
                <div class="lg:col-span-3">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Stickers & Labels</h2>
                    <p class="text-base text-gray-700 mb-6 leading-relaxed">
                        Enhance your brand visibility with custom stickers and labels. Perfect for product packaging, promotions, and branding. Durable, high-quality materials for indoor and outdoor use.
                    </p>
                    <a href="/stickers" class="inline-block border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-semibold py-2.5 px-6 rounded-full transition-all duration-300">
                        Browse All
                    </a>
                </div>
                <div class="lg:col-span-9 grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-5">
                    <a href="/stickers/die-cut" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-[4/3] bg-white flex items-center justify-center p-4">
                            <img src="https://images.unsplash.com/photo-1611532736579-6b16e2b50449?w=400&h=300&fit=crop" alt="Die Cut Stickers" class="w-full h-full object-contain">
                        </div>
                        <div class="p-3 text-center border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">Die Cut Stickers</h3>
                        </div>
                    </a>
                    <a href="/stickers/vinyl" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-[4/3] bg-white flex items-center justify-center p-4">
                            <img src="https://images.unsplash.com/photo-1599080876691-3e99ed1ab7e6?w=400&h=300&fit=crop" alt="Roll Labels" class="w-full h-full object-contain">
                        </div>
                        <div class="p-3 text-center border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">Roll Labels</h3>
                        </div>
                    </a>
                    <a href="/stickers/kiss-cut" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-[4/3] bg-white flex items-center justify-center p-4">
                            <img src="https://images.unsplash.com/photo-1585308317918-d1ab32fe8e90?w=400&h=300&fit=crop" alt="Sheet Labels" class="w-full h-full object-contain">
                        </div>
                        <div class="p-3 text-center border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">Sheet Labels</h3>
                        </div>
                    </a>
                    <a href="/stickers/holographic" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-[4/3] bg-white flex items-center justify-center p-4">
                            <img src="https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400&h=300&fit=crop" alt="Holographic Stickers" class="w-full h-full object-contain">
                        </div>
                        <div class="p-3 text-center border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">Holographic Stickers</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Categories Section (Individual Items Slider) -->
    <section class="py-12 sm:py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative">
                <div class="flex gap-4 sm:gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory pb-4 cursor-grab scroll-smooth select-none touch-pan-y" id="productItemsContainer">
                    <!-- Paperback Book -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/books/paperback" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=225&fit=crop" alt="Paperback book" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Paperback book</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Hardback Book -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/books/hardback" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=225&fit=crop" alt="Hardback book" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Hardback book</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Special Finish Hardback -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/books/special-finish-hardback" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=225&fit=crop" alt="Special Finish Hardback" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-blue-600">Special Finish Hardback</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Comics -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/books/comics" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?w=300&h=225&fit=crop" alt="Comics" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Comics</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Self-published book -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/books/self-published" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=300&h=225&fit=crop" alt="Self-published book" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Self-published book</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Business Cards Classic -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/business-cards/classic" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=300&h=225&fit=crop" alt="Classic Business Cards" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Classic Business Cards</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Roll Labels -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/stickers" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1599080876691-3e99ed1ab7e6?w=300&h=225&fit=crop" alt="Roll Labels" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Roll Labels</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Die Cut Stickers -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/stickers" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1611532736579-6b16e2b50449?w=300&h=225&fit=crop" alt="Die Cut Stickers" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Die Cut Stickers</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Magazine -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/magazines" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=300&h=225&fit=crop" alt="Magazine" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Magazine</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Vinyl Banner -->
                    <div class="flex-none w-48 sm:w-56 snap-center">
                        <a href="/banners/vinyl-banners" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full">
                            <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-4">
                                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=225&fit=crop" alt="Vinyl Banner" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="p-3 text-center bg-white">
                                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Vinyl Banner</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <button onclick="scrollProductItems('left')" class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white hover:bg-gray-50 text-gray-800 p-3 rounded-full shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button onclick="scrollProductItems('right')" class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white hover:bg-gray-50 text-gray-800 p-3 rounded-full shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Stickers & Labels Section (Individual Layout) -->
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                        Stickers & Labels
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                        Enhance your brand visibility with custom stickers and labels. Perfect for product packaging, promotions, and branding. Durable, high-quality materials for indoor and outdoor use.
                    </p>
                    <a href="/stickers" class="inline-block border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                        Discover More
                    </a>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1611532736579-6b16e2b50449?w=800&h=500&fit=crop" alt="Stickers & Labels" class="w-full h-auto rounded-lg shadow-2xl">
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-500 rounded-lg -z-10 hidden sm:block"></div>
                        <div class="absolute -top-4 -left-4 w-32 h-32 bg-purple-500 rounded-lg -z-10 hidden sm:block"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore our Display Signs Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-8 sm:mb-12">Explore our Display Signs</h2>
            <div class="relative">
                <div class="flex gap-4 sm:gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory pb-4" id="displaySignsContainer">
                    <a href="/banners" class="flex-none w-64 sm:w-72 snap-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center p-8">
                                <img src="https://images.unsplash.com/photo-1557425493-6f90ae4659fc?w=400&h=400&fit=crop" alt="Step & Repeat Banners" class="w-full h-full object-contain">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Step & Repeat Banners</h3>
                            </div>
                        </div>
                    </a>
                    <a href="/banners" class="flex-none w-64 sm:w-72 snap-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center p-8">
                                <img src="https://images.unsplash.com/photo-1533073526757-2c8ca1df9f1c?w=400&h=400&fit=crop" alt="Pop-up Displays" class="w-full h-full object-contain">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Pop-up Displays</h3>
                            </div>
                        </div>
                    </a>
                    <a href="/banners" class="flex-none w-64 sm:w-72 snap-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center p-8">
                                <img src="https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=400&h=400&fit=crop" alt="Retractable Banners" class="w-full h-full object-contain">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Retractable Banners</h3>
                            </div>
                        </div>
                    </a>
                    <a href="/banners" class="flex-none w-64 sm:w-72 snap-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center p-8">
                                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=400&fit=crop" alt="Feather Flags" class="w-full h-full object-contain">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Feather Flags</h3>
                            </div>
                        </div>
                    </a>
                    <a href="/banners" class="flex-none w-64 sm:w-72 snap-center">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center p-8">
                                <img src="https://images.unsplash.com/photo-1606663889134-b1dedb5ed8b7?w=400&h=400&fit=crop" alt="Tension Fabric Banners" class="w-full h-full object-contain">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Tension Fabric Banners</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <button onclick="scrollDisplaySigns('left')" class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white hover:bg-gray-50 text-gray-800 p-3 rounded-full shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button onclick="scrollDisplaySigns('right')" class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white hover:bg-gray-50 text-gray-800 p-3 rounded-full shadow-lg transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </section> --}}

    <section class="py-12 sm:py-16 lg:py-20 bg-primary relative overflow-hidden" 
        @if(isset($homeContent['offer_banner']['background_image']) && $homeContent['offer_banner']['background_image'])
        style="background-image: url('{{ $homeContent['offer_banner']['background_image'] }}'); background-size: cover; background-position: center;"
        @endif>
        @if(isset($homeContent['offer_banner']['background_image']) && $homeContent['offer_banner']['background_image'])
        <div class="absolute inset-0 bg-black/50"></div>
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center text-primary-foreground">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">{{ $homeContent['offer_banner']['title'] ?? 'বিশেষ অফার!' }}</h2>
                <p class="text-xl sm:text-2xl mb-6">{{ $homeContent['offer_banner']['subtitle'] ?? 'প্রথম অর্ডারে পাচ্ছেন ২০% ছাড়' }}</p>
                <p class="text-lg mb-8 max-w-2xl mx-auto">{{ $homeContent['offer_banner']['description'] ?? 'নতুন গ্রাহকরা সকল প্রিন্টিং সার্ভিসে বিশেষ ছাড় উপভোগ করতে পারবেন। সীমিত সময়ের অফার!' }}</p>
                <a href="{{ $homeContent['offer_banner']['cta_url'] ?? '/shop' }}" class="inline-block bg-background text-primary hover:bg-muted font-bold py-4 px-10 rounded-full text-lg shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    {{ $homeContent['offer_banner']['cta_text'] ?? 'এখনই অফার নিন' }}
                </a>
            </div>
        </div>
    </section>

    <!-- Trust Section - Brand Logos Carousel -->
    <section class="py-12 sm:py-16 lg:py-20 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-4">{{ $homeContent['trust_section']['title'] ?? 'যারা আমাদের বিশ্বাস করেন' }}</h2>
                <p class="text-lg text-muted-foreground">{{ $homeContent['trust_section']['subtitle'] ?? 'শত শত প্রতিষ্ঠান তাদের প্রিন্টিং এর জন্য আমাদের উপর আস্থা রাখেন' }}</p>
            </div>
            
            <!-- Carousel Container -->
            <div class="relative">
                <!-- Previous Button -->
                <button id="prevBrandBtn" type="button"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-gray-100 text-gray-800 rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110 -ml-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Brands Carousel -->
                <div id="brandsCarousel" class="overflow-hidden">
                    <div id="brandsTrack" class="flex gap-4 sm:gap-8 items-center pb-4" style="transition: transform 0.5s ease-in-out;">
                        @php
                            $brands = [];
                            if(isset($homeContent['trust_section']['brands']) && count($homeContent['trust_section']['brands']) > 0) {
                                $brands = $homeContent['trust_section']['brands'];
                            } else {
                                for($i = 1; $i <= 6; $i++) {
                                    $brands[] = ['name' => 'Brand ' . $i, 'logo' => ''];
                                }
                            }
                            // Duplicate brands for infinite loop
                            $allBrands = array_merge($brands, $brands, $brands);
                        @endphp
                        
                        @foreach($allBrands as $index => $brand)
                            <div class="brand-item flex-shrink-0 w-40 sm:w-48 md:w-44 lg:w-48" data-brand-index="{{ $index }}">
                                <div class="flex items-center justify-center p-6 bg-card rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105 h-24">
                                    @if(!empty($brand['logo']))
                                        <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }}" class="h-16 max-w-full object-contain">
                                    @else
                                        <!-- <div class="text-xl font-bold text-muted-foreground">{{ $brand['name'] }}</div> -->
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Next Button -->
                <button id="nextBrandBtn" type="button"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-gray-100 text-gray-800 rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110 -mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Carousel Indicators -->
            <div id="brandIndicators" class="flex justify-center gap-2 mt-6">
                @foreach($brands as $index => $brand)
                    <button type="button" class="brand-indicator w-2 h-2 rounded-full bg-gray-300 hover:bg-gray-400 transition" data-index="{{ $index }}"></button>
                @endforeach
            </div>
            
            <script>
                // Store brand count in a data attribute for JS access
                window.BRANDS_COUNT = {{ count($brands) }};
            </script>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@push('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slider-item');
    const dots = document.querySelectorAll('.slider-dot');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('bg-white'));
        dots.forEach(dot => dot.classList.add('bg-white/60'));
        slides[index].classList.add('active');
        dots[index].classList.remove('bg-white/60');
        dots[index].classList.add('bg-white');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 30000);
    showSlide(0);

    function scrollBestSellers(direction) {
        const container = document.getElementById('bestSellersContainer');
        const scrollAmount = 320;
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    function scrollDisplaySigns(direction) {
        const container = document.getElementById('displaySignsContainer');
        const scrollAmount = 300;
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    function scrollProductItems(direction) {
        const container = document.getElementById('productItemsContainer');
        const scrollAmount = 240;
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    // Brand Carousel Functions
    (function() {
        let currentBrandIndex = 0;
        let isTransitioning = false;
        let brandsCount = 0;
        let autoPlayInterval = null;

        function initBrandCarousel() {
            // Get brand count from window variable
            brandsCount = window.BRANDS_COUNT || 0;
            if (brandsCount === 0) return;

            const prevBtn = document.getElementById('prevBrandBtn');
            const nextBtn = document.getElementById('nextBrandBtn');
            const indicators = document.querySelectorAll('.brand-indicator');

            // Start from middle set for smooth infinite scroll
            currentBrandIndex = brandsCount;
            updateBrandCarousel(false);

            // Add event listeners
            if (prevBtn) {
                prevBtn.addEventListener('click', previousBrand);
            }
            if (nextBtn) {
                nextBtn.addEventListener('click', nextBrand);
            }
            
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => goToBrand(index));
            });

            // Auto-play carousel
            autoPlayInterval = setInterval(nextBrand, 3000);
        }

        function updateBrandCarousel(animated = true) {
            const track = document.getElementById('brandsTrack');
            const items = document.querySelectorAll('.brand-item');
            const indicators = document.querySelectorAll('.brand-indicator');
            
            if (!track || items.length === 0) return;

            const firstItem = items[0];
            const itemWidth = firstItem.offsetWidth;
            const computedStyle = window.getComputedStyle(track);
            const gap = parseFloat(computedStyle.gap) || 16;
            
            const offset = currentBrandIndex * (itemWidth + gap);

            if (animated) {
                track.style.transition = 'transform 0.5s ease-in-out';
            } else {
                track.style.transition = 'none';
            }

            track.style.transform = `translateX(-${offset}px)`;

            // Update indicators
            const actualIndex = currentBrandIndex % brandsCount;
            indicators.forEach((indicator, index) => {
                if (index === actualIndex) {
                    indicator.classList.remove('bg-gray-300');
                    indicator.classList.add('bg-gray-600');
                } else {
                    indicator.classList.remove('bg-gray-600');
                    indicator.classList.add('bg-gray-300');
                }
            });
        }

        function nextBrand(e) {
            if (e) e.preventDefault();
            console.log('Next brand clicked, current:', currentBrandIndex, 'total:', brandsCount);
            
            if (isTransitioning || brandsCount === 0) {
                console.log('Blocked - transitioning:', isTransitioning, 'brandsCount:', brandsCount);
                return;
            }
            isTransitioning = true;

            currentBrandIndex++;
            console.log('Moving to index:', currentBrandIndex);
            updateBrandCarousel(true);

            // Reset to start of middle set when reaching end
            setTimeout(() => {
                if (currentBrandIndex >= brandsCount * 2) {
                    console.log('Resetting to middle set');
                    currentBrandIndex = brandsCount;
                    updateBrandCarousel(false);
                }
                isTransitioning = false;
            }, 500);
        }

        function previousBrand(e) {
            if (e) e.preventDefault();
            console.log('Previous brand clicked');
            
            if (isTransitioning || brandsCount === 0) return;
            isTransitioning = true;

            currentBrandIndex--;
            updateBrandCarousel(true);

            // Reset to end of middle set when reaching start
            setTimeout(() => {
                if (currentBrandIndex < brandsCount) {
                    currentBrandIndex = brandsCount * 2 - 1;
                    updateBrandCarousel(false);
                }
                isTransitioning = false;
            }, 500);
        }

        function goToBrand(index) {
            if (isTransitioning || brandsCount === 0) return;
            isTransitioning = true;
            
            // Always use middle set for clicked indicators
            currentBrandIndex = brandsCount + index;
            updateBrandCarousel(true);
            
            setTimeout(() => {
                isTransitioning = false;
            }, 500);
        }

        // Initialize on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initBrandCarousel);
        } else {
            initBrandCarousel();
        }

        // Recalculate on resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                updateBrandCarousel(false);
            }, 250);
        });

        // Expose functions globally for button onclick if needed
        window.nextBrand = nextBrand;
        window.previousBrand = previousBrand;
        window.goToBrand = goToBrand;
    })();

    // Smooth drag scrolling with momentum
    function initDragScroll() {
        const container = document.getElementById('bestSellersContainer');
        if (!container) return;

        let isDown = false;
        let startX = 0;
        let scrollLeft = 0;
        let velocity = 0;
        let lastX = 0;
        let lastTime = 0;
        let animationId = null;

        const maxVelocity = 5.5;

        const stopMomentum = () => {
            if (animationId) cancelAnimationFrame(animationId);
        };

        const applyMomentum = () => {
            let currentVelocity = velocity;
            const friction = 0.96;
            const minVelocity = 0.05;

            const animate = () => {
                if (Math.abs(currentVelocity) > minVelocity) {
                    container.scrollLeft += currentVelocity * 20;
                    currentVelocity *= friction;
                    animationId = requestAnimationFrame(animate);
                }
            };

            animationId = requestAnimationFrame(animate);
        };

        container.addEventListener('mousedown', (e) => {
            if (e.button !== 0) return;
            isDown = true;
            startX = e.pageX;
            scrollLeft = container.scrollLeft;
            lastX = startX;
            lastTime = Date.now();
            velocity = 0;
            container.style.cursor = 'grabbing';
            stopMomentum();
            e.preventDefault();
        });

        container.addEventListener('mouseleave', () => {
            if (isDown) {
                isDown = false;
                container.style.cursor = 'grab';
                if (Math.abs(velocity) > 0.5) {
                    applyMomentum();
                }
            }
        });

        container.addEventListener('mouseup', () => {
            if (isDown) {
                isDown = false;
                container.style.cursor = 'grab';
                if (Math.abs(velocity) > 0.5) {
                    applyMomentum();
                }
            }
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();

            const x = e.pageX;
            const walk = x - startX;
            const now = Date.now();
            const timeDelta = Math.max(now - lastTime, 1);

            velocity = Math.max(Math.min((lastX - x) / timeDelta, maxVelocity), -maxVelocity);
            lastX = x;
            lastTime = now;

            container.scrollLeft = scrollLeft - walk;
        });

        // Touch support
        container.addEventListener('touchstart', (e) => {
            isDown = true;
            startX = e.touches[0].pageX;
            scrollLeft = container.scrollLeft;
            lastX = startX;
            lastTime = Date.now();
            velocity = 0;
            stopMomentum();
        });

        container.addEventListener('touchend', () => {
            if (isDown) {
                isDown = false;
                if (Math.abs(velocity) > 0.5) {
                    applyMomentum();
                }
            }
        });

        container.addEventListener('touchmove', (e) => {
            if (!isDown) return;

            const x = e.touches[0].pageX;
            const walk = x - startX;
            const now = Date.now();
            const timeDelta = Math.max(now - lastTime, 1);

            velocity = Math.max(Math.min((lastX - x) / timeDelta, maxVelocity), -maxVelocity);
            lastX = x;
            lastTime = now;

            container.scrollLeft = scrollLeft - walk;
        });
    }

    // Initialize on page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDragScroll);
    } else {
        initDragScroll();
    }
</script>
@endpush
