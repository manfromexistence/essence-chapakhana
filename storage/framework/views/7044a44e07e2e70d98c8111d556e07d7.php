<?php $__env->startSection('title', ($productTitle ?? 'Marketing Material') . ' | Chapakhana'); ?>

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
                <a href="/brochures" class="hover:text-blue-600 hover:underline">মার্কেটিং ম্যাটেরিয়াল</a>
                <span>/</span>
                <span class="text-gray-800"><?php echo e($productTitle ?? 'Tri-fold Brochures'); ?></span>
            </nav>
        </div>
    </div>

    <!-- Hero Banner -->
    <section class="bg-gray-100 py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        <?php echo e($productTitle ?? 'Service Catalogs'); ?>

                    </h1>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        আপনার প্রজেক্টে অন্যন্য রূপ দিন আমাদের প্রিমিয়াম service catalogs প্রিন্টিং এর মাধ্যমে। পেশাদার মান
                        এবং টেকসই গুণমান সহ আপনার কন্টেন্ট প্রদর্শনের জন্য পারফেক্ট।
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-base text-gray-800">প্রিমিয়াম মানের প্রিন্টিং</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-base text-gray-800">একাধিক বাইন্ডিং অপশন</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-base text-gray-800">৪০ পৃষ্ঠা থেকে উপলব্ধ</span>
                        </div>
                    </div>
                    <div class="flex gap-4 pt-6">
                        <a href="#configure"
                            class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-xl text-center">
                            এখনই কনফিগার করুন
                        </a>
                        <a href="#info"
                            class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold border-2 border-blue-600 hover:bg-blue-50 transition text-center">
                            বিস্তারিত দেখুন
                        </a>
                    </div>
                </div>
                <!-- Right Image -->
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="<?php echo e($productImage ?? 'https://placehold.co/800x600?text=' . urlencode($productTitle ?? 'Marketing Materials')); ?>"
                            alt="<?php echo e($productTitle ?? 'Marketing Materials'); ?>" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Configure Your Product Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Configuration Options -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Size Section -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Size</h3>
                            <button class="flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Show all
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                            <div data-category="size" data-value="4x6" data-price="0"
                                class="size-option border-2 border-blue-600 bg-blue-50 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center aspect-square">
                                <div class="w-12 h-16 border-2 border-blue-600 rounded mb-2 relative">
                                    <div class="absolute top-1 right-1 w-2 h-2 bg-blue-600 rounded-sm transform rotate-45">
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-blue-600">4" x 6"</span>
                            </div>
                            <div data-category="size" data-value="4.2x5.5" data-price="0"
                                class="size-option border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center aspect-square">
                                <div class="w-12 h-14 border-2 border-gray-400 rounded mb-2 relative">
                                    <div class="absolute top-1 right-1 w-2 h-2 bg-gray-400 rounded-sm transform rotate-45">
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">4.2" x 5.5"</span>
                            </div>
                            <div data-category="size" data-value="5x7" data-price="2"
                                class="size-option border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center aspect-square">
                                <div class="w-14 h-16 border-2 border-gray-400 rounded mb-2 relative">
                                    <div class="absolute top-1 right-1 w-2 h-2 bg-gray-400 rounded-sm transform rotate-45">
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">5" x 7"</span>
                            </div>
                            <div data-category="size" data-value="5.5x8.5" data-price="5"
                                class="size-option border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center aspect-square">
                                <div class="w-14 h-18 border-2 border-gray-400 rounded mb-2 relative">
                                    <div class="absolute top-1 right-1 w-2 h-2 bg-gray-400 rounded-sm transform rotate-45">
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">5.5" x 8.5"</span>
                            </div>
                            <div data-category="size" data-value="6x9" data-price="8"
                                class="size-option border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center aspect-square">
                                <div class="w-16 h-20 border-2 border-gray-400 rounded mb-2 relative">
                                    <div class="absolute top-1 right-1 w-2 h-2 bg-gray-400 rounded-sm transform rotate-45">
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">6" x 9"</span>
                            </div>
                        </div>
                    </div>

                    <!-- Corners Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Corners</h3>
                        <div class="flex items-center gap-3">
                            <select id="cornersSelect"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="standard" selected>Standard</option>
                                <option value="rounded">Rounded Corners</option>
                            </select>
                            <button
                                class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Orientation Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Orientation</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div data-category="orientation" data-value="vertical" data-price="0"
                                class="orientation-option border-2 border-gray-200 rounded-lg p-6 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center">
                                <svg class="w-16 h-20 text-gray-600 mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <rect x="7" y="3" width="10" height="18" rx="1" stroke-width="2" />
                                    <line x1="9" y1="6" x2="15" y2="6" stroke-width="1.5" />
                                    <line x1="9" y1="8.5" x2="15" y2="8.5" stroke-width="1.5" />
                                    <line x1="9" y1="11" x2="15" y2="11" stroke-width="1.5" />
                                    <circle cx="12" cy="15" r="2" stroke-width="1.5" />
                                    <path d="M10 17 L12 18.5 L14 17" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Vertical</span>
                            </div>
                            <div data-category="orientation" data-value="horizontal" data-price="0"
                                class="orientation-option border-2 border-blue-600 bg-blue-50 rounded-lg p-6 cursor-pointer hover:border-blue-500 transition-colors flex flex-col items-center justify-center">
                                <svg class="w-20 h-16 text-blue-600 mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <rect x="4" y="6" width="16" height="10" rx="1" stroke-width="2" />
                                    <line x1="6" y1="8" x2="10" y2="8" stroke-width="1.5" />
                                    <line x1="6" y1="10" x2="10" y2="10" stroke-width="1.5" />
                                    <line x1="6" y1="12" x2="10" y2="12" stroke-width="1.5" />
                                    <circle cx="16" cy="11" r="2" stroke-width="1.5" />
                                    <path d="M14 13 L16 14.5 L18 13" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="text-sm font-medium text-blue-600">Horizontal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Printed Side Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Printed Side</h3>
                        <div class="flex items-center gap-3">
                            <select id="printedSideSelect"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-blue-600 font-medium">
                                <option value="front" selected>Front Only</option>
                                <option value="both">Both Sides</option>
                            </select>
                            <button
                                class="p-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Paper Type Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Paper Type</h3>
                        <div class="border-2 border-gray-200 rounded-lg overflow-hidden">
                            <div class="grid grid-cols-3 border-b border-gray-200">
                                <button
                                    class="px-6 py-3 text-sm font-semibold bg-white text-gray-900 border-b-2 border-blue-600 hover:bg-gray-50 transition-colors tab-button"
                                    data-tab="standard">
                                    Standard
                                </button>
                                <button
                                    class="px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors tab-button"
                                    data-tab="premium">
                                    Premium
                                </button>
                                <button
                                    class="px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors tab-button"
                                    data-tab="premium-plus">
                                    Premium Plus
                                </button>
                            </div>

                            <div class="p-6 bg-white tab-content" data-tab-content="standard">
                                <div class="space-y-4">
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="paper-type" value="13pt-recycled" checked
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm font-medium text-blue-600">13pt Recycled</span>
                                        </div>
                                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="paper-type" value="14pt-glossy"
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm font-medium text-blue-600">14pt Glossy</span>
                                        </div>
                                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                            </div>

                            <div class="p-6 bg-white hidden tab-content" data-tab-content="premium">
                                <div class="space-y-4">
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="paper-type" value="14pt-matte"
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm font-medium text-blue-600">14pt Matte</span>
                                        </div>
                                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                            </div>

                            <div class="p-6 bg-white hidden tab-content" data-tab-content="premium-plus">
                                <div class="space-y-4">
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="paper-type" value="14pt-uncoated"
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm font-medium text-blue-600">14pt Uncoated</span>
                                        </div>
                                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Finishes Section -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Finishes</h3>
                            <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="text" value="None" readonly
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-50 text-gray-700 font-medium" />
                            <button class="p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Item Name Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Item name</h3>
                        <input type="text" placeholder="Name this print job"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <!-- Right Column - Job Recap -->
                <div class="lg:col-span-1">
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Job recap and quotation</h3>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Size</span>
                                <span class="text-sm font-semibold text-gray-900">4" x 6"</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Corners</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-corners">Standard</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Orientation</span>
                                <span class="text-sm font-semibold text-gray-900">Horizontal</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Printed Side</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-printed">Front Only</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Paper Type</span>
                                <span class="text-sm font-semibold text-gray-900" id="recap-paper">13pt Recycled</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Finishes</span>
                                <span class="text-sm font-semibold text-gray-900">None</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Expected Delivery</span>
                                <span
                                    class="text-sm font-semibold text-gray-900"><?php echo e(date('M d, Y', strtotime('+3 days'))); ?></span>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-medium">Subtotal</span>
                                <span class="text-gray-900 font-semibold" id="subtotal">$25.00</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-medium">Tax (15%)</span>
                                <span class="text-gray-900 font-semibold" id="tax">$3.75</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t-2 border-blue-200">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-blue-600" id="total">$28.75</span>
                            </div>
                        </div>

                        <button
                            class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-full hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                            Add to Cart
                        </button>

                        <div class="mt-4 text-center">
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Need help? Contact
                                us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceState = {
                basePrice: 25.00,
                sizePrice: 0,
                orientationPrice: 0,
                cornersPrice: 0,
                printedSidePrice: 0,
                paperTypePrice: 0,
                taxRate: 0.15
            };

            function updateDisplay() {
                const subtotal = priceState.basePrice + priceState.sizePrice + priceState.orientationPrice +
                    priceState.cornersPrice + priceState.printedSidePrice + priceState.paperTypePrice;
                const tax = subtotal * priceState.taxRate;
                const total = subtotal + tax;

                document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
                document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
                document.getElementById('total').textContent = `$${total.toFixed(2)}`;
            }

            // Generic option selection handler
            function wireClickableOptions(className, priceKey) {
                const options = document.querySelectorAll(`.${className}`);
                options.forEach(opt => {
                    opt.addEventListener('click', function () {
                        // Remove selected state from all
                        options.forEach(o => {
                            o.classList.remove('border-blue-600', 'bg-blue-50');
                            o.classList.add('border-gray-200');
                            const svg = o.querySelector('svg');
                            const span = o.querySelector('span');
                            const innerDiv = o.querySelector('div');
                            if (svg) {
                                svg.classList.remove('text-blue-600');
                                svg.classList.add('text-gray-600');
                            }
                            if (span) {
                                span.classList.remove('text-blue-600');
                                span.classList.add('text-gray-700');
                            }
                            if (innerDiv) {
                                innerDiv.classList.remove('border-blue-600');
                                innerDiv.classList.add('border-gray-400');
                                const innerShape = innerDiv.querySelector('div');
                                if (innerShape) {
                                    innerShape.classList.remove('bg-blue-600');
                                    innerShape.classList.add('bg-gray-400');
                                }
                            }
                        });

                        // Add selected state to clicked
                        this.classList.remove('border-gray-200');
                        this.classList.add('border-blue-600', 'bg-blue-50');
                        const svg = this.querySelector('svg');
                        const span = this.querySelector('span');
                        const innerDiv = this.querySelector('div');
                        if (svg) {
                            svg.classList.remove('text-gray-600');
                            svg.classList.add('text-blue-600');
                        }
                        if (span) {
                            span.classList.remove('text-gray-700');
                            span.classList.add('text-blue-600');
                        }
                        if (innerDiv) {
                            innerDiv.classList.remove('border-gray-400');
                            innerDiv.classList.add('border-blue-600');
                            const innerShape = innerDiv.querySelector('div');
                            if (innerShape) {
                                innerShape.classList.remove('bg-gray-400');
                                innerShape.classList.add('bg-blue-600');
                            }
                        }

                        priceState[priceKey] = parseFloat(this.dataset.price) || 0;
                        updateDisplay();
                    });
                });
            }

            wireClickableOptions('size-option', 'sizePrice');
            wireClickableOptions('orientation-option', 'orientationPrice');

            // Tab switching for Paper Type
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const tabName = this.getAttribute('data-tab');

                    tabButtons.forEach(btn => {
                        btn.classList.remove('bg-white', 'text-gray-900', 'border-b-2', 'border-blue-600');
                        btn.classList.add('text-gray-600');
                    });
                    this.classList.add('bg-white', 'text-gray-900', 'border-b-2', 'border-blue-600');
                    this.classList.remove('text-gray-600');

                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    document.querySelector(`[data-tab-content="${tabName}"]`).classList.remove('hidden');
                });
            });

            // Corners select
            const cornersSelect = document.getElementById('cornersSelect');
            if (cornersSelect) {
                cornersSelect.addEventListener('change', function (e) {
                    priceState.cornersPrice = e.target.value === 'rounded' ? 3.00 : 0;
                    const recapEl = document.getElementById('recap-corners');
                    if (recapEl) recapEl.textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Printed Side select
            const printedSideSelect = document.getElementById('printedSideSelect');
            if (printedSideSelect) {
                printedSideSelect.addEventListener('change', function (e) {
                    priceState.printedSidePrice = e.target.value === 'both' ? 10.00 : 0;
                    const recapEl = document.getElementById('recap-printed');
                    if (recapEl) recapEl.textContent = e.target.options[e.target.selectedIndex].text;
                    updateDisplay();
                });
            }

            // Paper Type radio buttons
            const paperTypeRadios = document.querySelectorAll('input[name="paper-type"]');
            paperTypeRadios.forEach(radio => {
                radio.addEventListener('change', function (e) {
                    const paperTypePrices = {
                        '13pt-recycled': 0,
                        '14pt-glossy': 5.00,
                        '14pt-matte': 6.00,
                        '14pt-uncoated': 7.00
                    };
                    priceState.paperTypePrice = paperTypePrices[e.target.value] || 0;

                    const labels = {
                        '13pt-recycled': '13pt Recycled',
                        '14pt-glossy': '14pt Glossy',
                        '14pt-matte': '14pt Matte',
                        '14pt-uncoated': '14pt Uncoated'
                    };
                    const recapEl = document.getElementById('recap-paper');
                    if (recapEl) recapEl.textContent = labels[e.target.value] || '13pt Recycled';
                    updateDisplay();
                });
            });

            updateDisplay();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\products\configure\marketing-material.blade.php ENDPATH**/ ?>