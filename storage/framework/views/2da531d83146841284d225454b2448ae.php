<?php $__env->startSection('title', 'Chapakhana - Every page tells your story'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Slider Section -->
    <section class="relative bg-white py-3">
        <div class="max-w-7xl mx-auto relative h-[500px] md:h-[600px] overflow-hidden rounded-3xl">
            <!-- Stats Badge - Top Right -->
            <?php if(isset($homeContent['hero_slider']['stats'])): ?>
            <div class="absolute top-8 right-8 z-20 bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-6 max-w-xs">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex-shrink-0">
                        <div class="text-4xl font-bold text-emerald-600"><?php echo e($homeContent['hero_slider']['stats']['percentage'] ?? '93'); ?>%</div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 leading-tight"><?php echo e($homeContent['hero_slider']['stats']['label'] ?? 'of our customers would buy again'); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-2 pt-3 border-t border-gray-200">
                    <div class="flex text-yellow-400">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm text-gray-600"><?php echo e($homeContent['hero_slider']['stats']['reviews_count'] ?? '256,839'); ?> reviews</span>
                </div>
            </div>
            <?php endif; ?>

            <!-- Slider Container -->
            <div id="heroSlider" class="relative h-full">
                <?php
                    $slides = $homeContent['hero_slider']['slides'] ?? [];
                    $defaultSlides = [
                        ['title' => 'স্বাগতম একাওয়াইজের স্টু এবং কলেজ', 'subtitle' => 'এর পক্ষ থেকে!', 'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1920&h=1080&fit=crop'],
                        ['title' => 'আপনার গল্প, আমাদের ছাপা', 'subtitle' => 'মানসম্মত প্রিন্টিং সেবা, সাশ্রয়ী মূল্যে', 'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1920&h=1080&fit=crop'],
                        ['title' => 'শুধু প্রিন্টার নয়, আপনার বিশ্বস্ত সঙ্গী', 'subtitle' => 'প্রতিটি পদক্ষেপে আমরা আছি আপনার পাশে', 'image' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=1920&h=1080&fit=crop']
                    ];
                    $slides = empty($slides) ? $defaultSlides : $slides;
                ?>

                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slider-item <?php echo e($index === 0 ? 'active' : ''); ?> absolute inset-0">
                    <img src="<?php echo e($slide['image'] ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1920&h=1080&fit=crop'); ?>" 
                         alt="Hero Background <?php echo e($index + 1); ?>" 
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/50"></div>
                    <div class="relative h-full flex items-center justify-center text-center px-4">
                        <div class="max-w-4xl">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-2xl">
                                <?php echo e($slide['title'] ?? ''); ?>

                                <?php if(isset($slide['subtitle']) && $slide['subtitle']): ?>
                                <span class="block text-lg sm:text-xl md:text-2xl lg:text-3xl mt-3 font-normal"><?php echo e($slide['subtitle']); ?></span>
                                <?php endif; ?>
                            </h1>
                            <?php if(isset($slide['cta_text']) && $slide['cta_text']): ?>
                            <div class="mt-8">
                                <a href="<?php echo e($slide['cta_url'] ?? '#'); ?>" 
                                   class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-8 py-4 rounded-lg shadow-lg transition-all duration-300 hover:scale-105">
                                    <?php echo e($slide['cta_text']); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Navigation Dots - Bottom Left -->
            <?php if(count($slides) > 1): ?>
            <div class="absolute bottom-8 left-8 flex gap-2.5 z-20">
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button onclick="goToSlide(<?php echo e($index); ?>)" 
                        class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 <?php echo e($index === 0 ? 'active' : ''); ?>"></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php endif; ?>
        </div>
    </section>

    <!-- Headline & Short Description in Bangla Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-foreground mb-6">
                <?php echo e($homeContent['headline']['title'] ?? 'আপনার স্বপ্নকে বাস্তবে রূপান্তরিত করুন'); ?>

            </h2>
            <p class="text-lg sm:text-xl text-muted-foreground max-w-4xl mx-auto leading-relaxed">
                <?php echo e($homeContent['headline']['description'] ?? 'চাপাখানা হলো আপনার বিশ্বস্ত প্রিন্টিং সঙ্গী। উচ্চমানের প্রিন্টিং সেবা, দ্রুত ডেলিভারি এবং প্রতিযোগিতামূলক মূল্যে আমরা আপনার ব্যবসায়িক লক্ষ্য অর্জনে সহায়তা করি। বই, ম্যাগাজিন, ব্যানার থেকে শুরু করে সকল ধরনের মার্কেটিং ম্যাটেরিয়াল - সবকিছুই পাবেন এক জায়গায়।'); ?>

            </p>
        </div>
    </section>

    <!-- Features Section -->
    

    <!-- How to Order Banner Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Side - Order Instructions -->
                <div class="space-y-6">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-foreground leading-tight">
                        <span class="text-primary"><?php echo e($homeContent['how_to_order']['title'] ?? '০ টাকা বিনিয়োগে শুরু করুন'); ?></span>
                    </h2>
                    
                    <div class="space-y-6">
                        <?php if(isset($homeContent['how_to_order']['steps']) && count($homeContent['how_to_order']['steps']) > 0): ?>
                            <?php $__currentLoopData = $homeContent['how_to_order']['steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                                            <span class="text-lg font-bold text-primary-foreground"><?php echo e($step['number'] ?? $loop->iteration); ?></span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-foreground mb-1"><?php echo e($step['title']); ?></h3>
                                        <p class="text-muted-foreground text-base leading-relaxed">
                                            <?php echo e($step['description']); ?>

                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
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
                        <?php endif; ?>
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
                        <?php
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
                        ?>

                        <?php if($isYouTube && !empty($videoId)): ?>
                            <!-- YouTube Video Embed -->
                            <iframe 
                                class="w-full h-full" 
                                src="<?php echo e($embedUrl); ?>" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        <?php else: ?>
                            <!-- Regular Video Player -->
                            <video 
                                class="w-full h-full object-cover" 
                                controls 
                                poster="<?php echo e($posterUrl); ?>">
                                <source src="<?php echo e($videoUrl); ?>" type="video/mp4">
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
                        <?php endif; ?>
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
            <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-8 sm:mb-12"><?php echo e($homeContent['best_sellers']['title'] ?? 'জনপ্রিয় পণ্য'); ?></h2>
            <div class="relative">
                <div class="flex gap-4 sm:gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory pb-4 cursor-grab scroll-smooth select-none touch-pan-y" id="bestSellersContainer">
                    <?php if(isset($homeContent['best_sellers']['products']) && count($homeContent['best_sellers']['products']) > 0): ?>
                        <?php $__currentLoopData = $homeContent['best_sellers']['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex-none w-64 sm:w-72 snap-center">
                                <a href="<?php echo e($product['url'] ?? '#'); ?>" class="block bg-card rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <div class="aspect-square bg-muted flex items-center justify-center p-8">
                                        <img src="<?php echo e($product['image'] ?? 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=400&fit=crop'); ?>" alt="<?php echo e($product['title']); ?>" class="w-full h-full object-contain">
                                    </div>
                                    <div class="p-4 text-center">
                                        <h3 class="text-lg font-semibold text-card-foreground"><?php echo e($product['title']); ?></h3>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
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
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-4"><?php echo e($homeContent['testimonials']['title'] ?? 'গ্রাহকদের মতামত'); ?></h2>
                <p class="text-lg text-muted-foreground"><?php echo e($homeContent['testimonials']['subtitle'] ?? 'সারা বাংলাদেশ জুড়ে হাজারো ব্যবসায়ীর বিশ্বস্ত সঙ্গী'); ?></p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(isset($homeContent['testimonials']['items']) && count($homeContent['testimonials']['items']) > 0): ?>
                    <?php $__currentLoopData = $homeContent['testimonials']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-card rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-center mb-4">
                                    <?php for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++): ?>
                                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-card-foreground mb-4 leading-relaxed">"<?php echo e($testimonial['text']); ?>"</p>
                                <div class="flex items-center">
                                    <?php if(isset($testimonial['avatar_image']) && $testimonial['avatar_image']): ?>
                                        <img src="<?php echo e($testimonial['avatar_image']); ?>" alt="<?php echo e($testimonial['author']); ?>" class="w-12 h-12 rounded-full object-cover">
                                    <?php else: ?>
                                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center text-primary font-bold text-lg"><?php echo e($testimonial['avatar_initial'] ?? mb_substr($testimonial['author'], 0, 1)); ?></div>
                                    <?php endif; ?>
                                    <div class="ml-3">
                                        <p class="font-semibold text-foreground"><?php echo e($testimonial['author']); ?></p>
                                        <p class="text-sm text-muted-foreground"><?php echo e($testimonial['designation']); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Who Trust Us Section -->


    <!-- Offer Banner Section -->
  

    <!-- Magazines, Books, and Catalogs Section -->
    

    <section class="py-12 sm:py-16 lg:py-20 bg-primary relative overflow-hidden" 
        <?php if(isset($homeContent['offer_banner']['background_image']) && $homeContent['offer_banner']['background_image']): ?>
        style="background-image: url('<?php echo e($homeContent['offer_banner']['background_image']); ?>'); background-size: cover; background-position: center;"
        <?php endif; ?>>
        <?php if(isset($homeContent['offer_banner']['background_image']) && $homeContent['offer_banner']['background_image']): ?>
        <div class="absolute inset-0 bg-black/50"></div>
        <?php endif; ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center text-primary-foreground">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4"><?php echo e($homeContent['offer_banner']['title'] ?? 'বিশেষ অফার!'); ?></h2>
                <p class="text-xl sm:text-2xl mb-6"><?php echo e($homeContent['offer_banner']['subtitle'] ?? 'প্রথম অর্ডারে পাচ্ছেন ২০% ছাড়'); ?></p>
                <p class="text-lg mb-8 max-w-2xl mx-auto"><?php echo e($homeContent['offer_banner']['description'] ?? 'নতুন গ্রাহকরা সকল প্রিন্টিং সার্ভিসে বিশেষ ছাড় উপভোগ করতে পারবেন। সীমিত সময়ের অফার!'); ?></p>
                <a href="<?php echo e($homeContent['offer_banner']['cta_url'] ?? '/shop'); ?>" class="inline-block bg-background text-primary hover:bg-muted font-bold py-4 px-10 rounded-full text-lg shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <?php echo e($homeContent['offer_banner']['cta_text'] ?? 'এখনই অফার নিন'); ?>

                </a>
            </div>
        </div>
    </section>

    <!-- Trust Section - Brand Logos Carousel -->
    <section class="py-12 sm:py-16 lg:py-20 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-4"><?php echo e($homeContent['trust_section']['title'] ?? 'যারা আমাদের বিশ্বাস করেন'); ?></h2>
                <p class="text-lg text-muted-foreground"><?php echo e($homeContent['trust_section']['subtitle'] ?? 'শত শত প্রতিষ্ঠান তাদের প্রিন্টিং এর জন্য আমাদের উপর আস্থা রাখেন'); ?></p>
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
                        <?php
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
                        ?>
                        
 <?php $__currentLoopData = $allBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="brand-item"
style="
display: flex;
flex-direction: column;
padding: 10px;
transition: transform 0.2s ease-in-out;
"
data-brand-index="<?php echo e($index); ?>"
onmouseover="this.style.transform='translateY(-4px)'"
onmouseout="this.style.transform='translateY(0)'"
>
<div style="
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
padding: 24px;
background-color: #ffffff;
border-radius: 12px;
box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
border: 1px solid #f3f4f6;
height: 160px;
text-align: center;
">
<div style="height: 64px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
<img
src="<?php echo e($brand['logo']); ?>"
alt="<?php echo e($brand['name']); ?>"
style="height: 100%; max-width: 100%; object-fit: contain;"
onerror="this.style.display='none'"
>
</div>
<div style="
font-size: 1.125rem;
font-weight: 600;
color: #374151;
font-family: sans-serif;
">
<?php echo e($brand['name']); ?>

</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" class="brand-indicator w-2 h-2 rounded-full bg-gray-300 hover:bg-gray-400 transition" data-index="<?php echo e($index); ?>"></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <script>
                // Store brand count in a data attribute for JS access
                window.BRANDS_COUNT = <?php echo e(count($brands)); ?>;
            </script>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views/pages/home.blade.php ENDPATH**/ ?>