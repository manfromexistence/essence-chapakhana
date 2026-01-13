<?php $__env->startSection('title', $categoryTitle . ' | Chapakhana'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumbs -->
    <div class="bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-xs text-gray-500 flex items-center gap-1">
                <a href="/" class="hover:text-blue-600 hover:underline">হোম</a>
                <span>/</span>
                <span class="text-gray-800"><?php echo e($categoryTitle); ?></span>
            </nav>
        </div>
    </div>

    <!-- Hero Banner Slider -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Slider Container -->
            <div class="hero-slider relative">
                <?php $__currentLoopData = $heroSlides ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slider-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <!-- Left Content -->
                        <div class="space-y-6">
                            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900">
                                <?php echo e($slide['title'] ?? $categoryTitle); ?>

                            </h1>
                            <p class="text-lg text-gray-700 leading-relaxed">
                                <?php echo e($slide['description'] ?? $categoryDescription); ?>

                            </p>
                            <div class="flex gap-4 pt-4">
                                <a href="#products" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                                    এখনই অর্ডার করুন
                                </a>
                                <a href="#info" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold border-2 border-blue-600 hover:bg-blue-50 transition">
                                    আরও জানুন
                                </a>
                            </div>
                        </div>
                        <!-- Right Image -->
                        <div class="relative">
                            <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                                <img src="<?php echo e($slide['image'] ?? 'https://images.unsplash.com/photo-1604866830893-c13cafa515d5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Ym9va3N8ZW58MHx8MHx8fDA%3D'); ?>" 
                                     alt="<?php echo e($slide['title'] ?? $categoryTitle); ?>" 
                                     class="w-full h-full object-cover">
                            </div>
                            <!-- Decorative elements -->
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-200 rounded-full opacity-50 blur-2xl"></div>
                            <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-indigo-200 rounded-full opacity-50 blur-2xl"></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Slider Navigation Dots -->
            <?php if(count($heroSlides ?? []) > 1): ?>
            <div class="flex justify-center gap-2 mt-8">
                <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button class="slider-dot w-3 h-3 rounded-full transition <?php echo e($index === 0 ? 'bg-blue-600' : 'bg-gray-300'); ?>" 
                        data-slide="<?php echo e($index); ?>"></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Headline & Short Description in Bangla -->
    <section class="bg-white py-12" id="info">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                <?php echo e($headline ?? 'আপনার প্রিন্টিং সমাধান'); ?>

            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                <?php echo e($shortDescription ?? 'উচ্চ মানের প্রিন্টিং সেবা দ্রুত সময়ে এবং সাশ্রয়ী মূল্যে। আমরা আপনার প্রতিটি প্রয়োজন পূরণ করতে প্রতিশ্রুতিবদ্ধ।'); ?>

            </p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="bg-gray-50 py-16" id="products">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-3 text-center"><?php echo e($gridTitle ?? 'পণ্য নির্বাচন করুন'); ?></h2>
            <p class="text-gray-600 text-center mb-10"><?php echo e($gridSubtitle ?? 'আপনার পছন্দের পণ্য খুঁজে নিন'); ?></p>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($product['url']); ?>" class="group flex flex-col bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="aspect-square bg-gray-100 overflow-hidden relative">
                            <img src="<?php echo e($product['img']); ?>" 
                                 alt="<?php echo e($product['title']); ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php if(isset($product['badge'])): ?>
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                <?php echo e($product['badge']); ?>

                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors mb-1">
                                <?php echo e($product['title']); ?>

                            </h3>
                            <?php if(isset($product['price'])): ?>
                            <p class="text-blue-600 font-bold">৳<?php echo e($product['price']); ?> থেকে</p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Offer Banner -->
    <section class="bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-48 translate-y-48"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center text-white">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4">
                    <?php echo e($offerTitle ?? '🎉 বিশেষ অফার 🎉'); ?>

                </h2>
                <p class="text-xl lg:text-2xl mb-6 font-medium">
                    <?php echo e($offerText ?? 'প্রথম অর্ডারে পাচ্ছেন ২৫% ছাড়!'); ?>

                </p>
                <p class="text-lg mb-8 opacity-90">
                    <?php echo e($offerDetails ?? 'এখনই অর্ডার করুন এবং আপনার প্রিন্টিং খরচ বাঁচান। অফারটি সীমিত সময়ের জন্য বৈধ।'); ?>

                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#products" class="bg-white text-purple-600 px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl transform hover:scale-105">
                        এখনই অর্ডার করুন
                    </a>
                    <div class="text-white text-sm">
                        <span class="font-semibold">কুপন কোড:</span> 
                        <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full font-mono font-bold">FIRST25</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">উচ্চ মানের প্রিন্টিং</h3>
                    <p class="text-gray-600">সর্বোচ্চ মানের উপকরণ এবং আধুনিক প্রযুক্তি ব্যবহার</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">দ্রুত ডেলিভারি</h3>
                    <p class="text-gray-600">দ্রুততম সময়ে আপনার দোরগোড়ায় পৌঁছে দিই</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">সাশ্রয়ী মূল্য</h3>
                    <p class="text-gray-600">প্রতিযোগিতামূলক দামে সেরা সেবা নিশ্চিত</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Info Section -->
    <?php if(isset($additionalInfo) && !empty($additionalInfo)): ?>
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <?php echo \Illuminate\Support\Str::markdown($additionalInfo); ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Hero Slider functionality
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slider-item');
        const dots = document.querySelectorAll('.slider-dot');
        let currentSlide = 0;

        if (slides.length > 1) {
            // Auto slide every 5 seconds
            setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }, 5000);

            // Dot click handlers
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });
        }

        function updateSlider() {
            slides.forEach((slide, index) => {
                if (index === currentSlide) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });

            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-blue-600');
                } else {
                    dot.classList.remove('bg-blue-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\pages\category.blade.php ENDPATH**/ ?>