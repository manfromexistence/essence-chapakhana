<?php $__env->startSection('title', ($productTitle ?? 'Book') . ' | Chapakhana'); ?>

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
                <a href="/books" class="hover:text-blue-600 hover:underline">বই</a>
                <span>/</span>
                <span class="text-gray-800"><?php echo e($productTitle ?? 'Book'); ?></span>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900">
                        <?php echo e($productTitle ?? 'Book'); ?>

                    </h1>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        আপনার প্রজেক্টকে অনন্য রূপ দিন আমাদের প্রিমিয়াম <?php echo e(strtolower($productTitle ?? 'বই')); ?> প্রিন্টিং
                        এর মাধ্যমে। পেশাদার মান এবং টেকসই গুণমান সহ আপনার কন্টেন্ট প্রদর্শনের জন্য পারফেক্ট।
                    </p>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>প্রিমিয়াম মানের প্রিন্টিং</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>একাধিক বাইন্ডিং অপশন</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>৪০ পৃষ্ঠা থেকে উপলব্ধ</span>
                        </li>
                    </ul>
                    <div class="flex gap-4 pt-4">
                        <a href="#configure"
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                            এখনই কনফিগার করুন
                        </a>
                        <a href="#details"
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold border-2 border-blue-600 hover:bg-blue-50 transition">
                            বিস্তারিত দেখুন
                        </a>
                    </div>
                </div>
                <!-- Right Image -->
                <div class="relative">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                        <img src="<?php echo e($productImage ?? 'https://placehold.co/800x600?text=' . urlencode($productTitle ?? 'Book')); ?>"
                            alt="<?php echo e($productTitle ?? 'Book'); ?>" class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-200 rounded-full opacity-50 blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-indigo-200 rounded-full opacity-50 blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Configuration Form -->
    <section class="bg-white py-16" id="configure">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">আপনার পণ্য কনফিগার করুন এবং কোট পান</h2>
                <p class="text-lg text-gray-600">আপনার প্রয়োজন অনুযায়ী অপশন নির্বাচন করুন</p>
            </div>

            <form id="addToCartForm" action="<?php echo e(route('cart.add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="service_product" value="1">
                <input type="hidden" name="title" value="<?php echo e($productTitle ?? 'Book'); ?>">
                <input type="hidden" name="category" value="<?php echo e($category ?? 'books'); ?>">
                <input type="hidden" name="product_type" value="<?php echo e($productType ?? 'book'); ?>">
                <input type="hidden" name="image" value="<?php echo e($productImage ?? ''); ?>">
                <input type="hidden" name="price" id="cartPrice" value="15.80">
                <input type="hidden" name="configurations" id="cartConfigurations" value="{}">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Configuration Options -->
                    <div class="lg:col-span-2 space-y-8">

                        <!-- Binding -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-6">Binding</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <?php $__empty_1 = true; $__currentLoopData = $configOptions['bindings'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $binding): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <button type="button" data-category="binding"
                                        data-price="<?php echo e(is_array($binding) ? ($binding['price'] ?? 0) : 0); ?>"
                                        class="binding-option group border border-gray-300 rounded-xl p-6 bg-white hover:border-blue-600 hover:shadow-lg transition text-center">
                                        <div
                                            class="w-full h-40 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center mb-4">
                                            <!-- Generic Icon or Logic to pick icon based on label -->
                                            <svg class="w-24 h-24 text-gray-400" viewBox="0 0 100 100" fill="none"
                                                class="w-24 h-24 text-gray-400" viewBox="0 0 100 100" fill="none"
                                                stroke="currentColor" stroke-width="1.5">
                                                <?php $bindingLabel = is_array($binding) ? ($binding['label'] ?? '') : (is_string($binding) ? $binding : ''); ?>
                                                <?php if(stripos($bindingLabel, 'saddle') !== false): ?>
                                                    <path d="M30 50 L45 65 Q55 60 65 50 L65 30" />
                                                    <line x1="35" y1="40" x2="35" y2="70" />
                                                    <line x1="40" y1="35" x2="40" y2="75" />
                                                <?php elseif(stripos($bindingLabel, 'perfect') !== false): ?>
                                                    <rect x="25" y="20" width="40" height="60" rx="2" fill="white" />
                                                    <line x1="25" y1="20" x2="25" y2="80" stroke-width="3" />
                                                    <line x1="28" y1="25" x2="60" y2="25" />
                                                    <line x1="28" y1="32" x2="60" y2="32" />
                                                    <line x1="28" y1="39" x2="55" y2="39" />
                                                <?php else: ?>
                                                    <rect x="30" y="20" width="40" height="60" rx="2" />
                                                    <path d="M30 20 L70 80" />
                                                    <path d="M70 20 L30 80" />
                                                <?php endif; ?>
                                            </svg>
                                        </div>
                                        <div class="text-base font-semibold text-blue-600"><?php echo e($bindingLabel); ?></div>
                                        <?php if(is_array($binding) && ($binding['price'] ?? 0) > 0): ?>
                                            <div class="text-sm text-gray-500 mt-1">+$<?php echo e(number_format($binding['price'], 2)); ?>

                                            </div>
                                        <?php endif; ?>
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-span-2 text-center text-gray-500">No binding options available</div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Size -->
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-700">Size</h3>
                                <button
                                    class="text-gray-700 hover:text-gray-900 text-sm font-semibold flex items-center gap-1">
                                    Show all
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex gap-4 overflow-x-auto pb-2">
                                <?php $__empty_1 = true; $__currentLoopData = $configOptions['sizes'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <button data-category="size" data-price="<?php echo e(is_array($size) ? ($size['price'] ?? 0) : 0); ?>"
                                        class="price-option border border-gray-300 rounded-lg p-4 text-center hover:border-blue-600 transition flex-shrink-0"
                                        style="min-width: 160px;">
                                        <div
                                            class="w-20 h-24 mx-auto mb-3 bg-white rounded border border-gray-300 flex items-center justify-center">
                                            <div class="text-gray-600 text-xs font-medium">
                                                <?php echo e(is_array($size) ? ($size['label'] ?? '') : $size); ?></div>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-700">
                                            <?php echo e(is_array($size) ? ($size['label'] ?? '') : $size); ?></div>
                                        <?php if(is_array($size) && ($size['price'] ?? 0) > 0): ?>
                                            <div class="text-xs text-blue-600 mt-1">+$<?php echo e(number_format($size['price'], 2)); ?></div>
                                        <?php endif; ?>
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-gray-500">No size options available</div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Printing orientation -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-6">Printing orientation</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <?php $__empty_1 = true; $__currentLoopData = $configOptions['orientations'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orientation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <button data-category="orientation"
                                        data-price="<?php echo e(is_array($orientation) ? ($orientation['price'] ?? 0) : 0); ?>"
                                        class="price-option border border-gray-300 rounded-lg p-6 text-center hover:border-blue-600 transition flex items-center justify-center flex-col gap-4">
                                        <div class="text-lg font-bold text-gray-700">
                                            <?php echo e(is_array($orientation) ? ($orientation['label'] ?? '') : $orientation); ?></div>
                                        <?php if(is_array($orientation) && ($orientation['price'] ?? 0) > 0): ?>
                                            <div class="text-sm text-blue-600">+$<?php echo e(number_format($orientation['price'], 2)); ?></div>
                                        <?php endif; ?>
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-span-2 text-center text-gray-500">No orientation options available</div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Pages -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <h3 class="text-2xl font-bold text-gray-700">Pages</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="relative">
                                <input type="number" id="numPages" value="40" min="8" step="4"
                                    class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg font-medium text-blue-600 bg-white">
                            </div>
                        </div>

                        <!-- Paper Type -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-4">Paper Type (Interior)</h3>
                            <div class="border border-gray-300 rounded-lg overflow-hidden">
                                <div class="p-6 space-y-4">
                                    <?php $__empty_1 = true; $__currentLoopData = $configOptions['paperTypes'] ?? $configOptions['paper_types'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="radio" name="paper_type"
                                                value="<?php echo e(is_array($paper) ? ($paper['value'] ?? ($paper['label'] ?? '')) : $paper); ?>"
                                                data-category="paper"
                                                data-price="<?php echo e(is_array($paper) ? ($paper['price'] ?? 0) : 0); ?>"
                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <div class="flex-1 flex items-center justify-between">
                                                <span
                                                    class="text-base font-semibold text-blue-600"><?php echo e(is_array($paper) ? ($paper['label'] ?? '') : $paper); ?></span>
                                                <?php if(is_array($paper) && ($paper['price'] ?? 0) > 0): ?>
                                                    <div class="text-sm font-medium text-gray-500">
                                                        +$<?php echo e(number_format($paper['price'], 2)); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="text-gray-500">No interior paper options available</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Cover Paper Type -->
                        <?php if(!empty($configOptions['coverPaperTypes']) || !empty($configOptions['cover_papers'])): ?>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-700 mb-4">Cover Paper Type</h3>
                                <div class="border border-gray-300 rounded-lg overflow-hidden">
                                    <div class="p-6 space-y-4">
                                        <?php $__empty_1 = true; $__currentLoopData = $configOptions['coverPaperTypes'] ?? $configOptions['cover_papers'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cover): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <label class="flex items-center gap-3 cursor-pointer group">
                                                <input type="radio" name="cover_paper_type"
                                                    value="<?php echo e(is_array($cover) ? ($cover['value'] ?? ($cover['label'] ?? '')) : $cover); ?>"
                                                    data-category="cover"
                                                    data-price="<?php echo e(is_array($cover) ? ($cover['price'] ?? 0) : 0); ?>"
                                                    class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                <div class="flex-1 flex items-center justify-between">
                                                    <span
                                                        class="text-base font-semibold text-blue-600"><?php echo e(is_array($cover) ? ($cover['label'] ?? '') : $cover); ?></span>
                                                    <?php if(is_array($cover) && ($cover['price'] ?? 0) > 0): ?>
                                                        <div class="text-sm font-medium text-gray-500">
                                                            +$<?php echo e(number_format($cover['price'], 2)); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="text-gray-500">No cover paper options available</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Coating -->
                        <?php if(!empty($configOptions['coatings'])): ?>
                            <div>
                                <div class="flex items-center gap-2 mb-4">
                                    <h3 class="text-2xl font-bold text-gray-700">Coating</h3>
                                </div>
                                <div class="relative">
                                    <select id="coatingSelect" data-category="coating"
                                        class="w-full px-6 py-4 pr-12 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base font-medium text-blue-600 bg-white appearance-none">
                                        <option value="none" data-price="0.00" selected>Select a coating...</option>
                                        <?php $__currentLoopData = $configOptions['coatings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e(is_array($coating) ? ($coating['value'] ?? ($coating['label'] ?? '')) : $coating); ?>"
                                                data-price="<?php echo e(is_array($coating) ? ($coating['price'] ?? 0) : 0); ?>">
                                                <?php echo e(is_array($coating) ? ($coating['label'] ?? '') : $coating); ?>

                                                <?php if(is_array($coating) && ($coating['price'] ?? 0) > 0): ?>(+$<?php echo e(number_format($coating['price'], 2)); ?>)<?php endif; ?>
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Finishes -->
                        <?php if(!empty($configOptions['finishes'])): ?>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-700 mb-4">Finishes</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php $__currentLoopData = $configOptions['finishes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finish): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label
                                            class="flex items-center gap-3 cursor-pointer group border border-gray-300 rounded-lg p-3 hover:border-blue-500 transition">
                                            <input type="checkbox" name="finish[]"
                                                value="<?php echo e($finish['value'] ?? $finish['label']); ?>" data-category="finish"
                                                data-price="<?php echo e($finish['price'] ?? 0); ?>"
                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500 rounded">
                                            <div class="flex-1 flex items-center justify-between">
                                                <span
                                                    class="text-base font-medium text-gray-700"><?php echo e(is_array($finish) ? ($finish['label'] ?? '') : $finish); ?></span>
                                                <?php if(is_array($finish) && ($finish['price'] ?? 0) > 0): ?>
                                                    <div class="text-sm font-medium text-blue-600">
                                                        +$<?php echo e(number_format($finish['price'], 2)); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Spine Size -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-4">Spine Size (In)</h3>
                            <div class="relative">
                                <input type="text" value="0.11" readonly
                                    class="w-full px-6 py-4 pr-16 rounded-full border border-gray-300 bg-white text-base font-medium text-gray-700">
                                <button
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Item Name -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-4">Item name</h3>
                            <input type="text" placeholder="Name this print job"
                                class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base placeholder-gray-400">
                        </div>

                        <!-- Select price and delivery date -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <h3 class="text-2xl font-bold text-gray-700">Select price and delivery date</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Custom quantity -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-700 mb-4">Custom quantity</h3>
                            <input type="number" name="quantity" id="quantityInput" value="1" min="1"
                                class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base font-medium text-blue-600">
                        </div>
                    </div>

                    <!-- Right Column - Price Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-800 text-white rounded-lg overflow-hidden sticky top-24">
                            <!-- Header Tabs -->
                            <div class="grid grid-cols-2 border-b border-gray-700">
                                <button type="button"
                                    class="px-4 py-3 bg-gray-700 font-semibold text-sm hover:bg-gray-600">Job recap</button>
                                <button type="button" class="px-4 py-3 font-semibold text-sm hover:bg-gray-700">Job
                                    quotation</button>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="space-y-4 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Quantity</span>
                                        <span class="font-semibold">1</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Estimated delivery date</span>
                                        <span class="font-semibold">01/07</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Net price</span>
                                        <span id="netPrice" class="font-semibold">$15.80</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Shipping costs</span>
                                        <span class="text-gray-400">Calculated at checkout</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-300">Sales Tax</span>
                                        <span class="text-gray-400">Calculated at checkout</span>
                                    </div>

                                    <div class="border-t border-gray-700 pt-4 flex justify-between">
                                        <span class="font-semibold">Total quote</span>
                                        <span id="totalQuote" class="text-lg font-bold text-green-400">$15.80</span>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-full flex items-center justify-center gap-2 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                    </svg>
                                    ADD TO BASKET
                                </button>

                                <p class="text-xs text-gray-400 mt-4">
                                    • Free delivery on orders over $50<br>
                                    • Estimated delivery: 5-6 working days<br>
                                    • 100% satisfaction guaranteed
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Price aggregation across left-side options
        document.addEventListener('DOMContentLoaded', () => {
            // AJAX form submission
            const addToCartForm = document.getElementById('addToCartForm');
            if (addToCartForm) {
                addToCartForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.textContent;

                    // Disable button and show loading state
                    submitButton.disabled = true;
                    submitButton.textContent = 'ADDING...';

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showToast(data.message || 'Product added to cart!', 'success');
                                updateCartCount();
                            } else {
                                showToast(data.message || 'Failed to add product to cart', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Cart error:', error);
                            showToast('Failed to add product to cart', 'error');
                        })
                        .finally(() => {
                            // Re-enable button
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                        });
                });
            }

            const netPriceEl = document.getElementById('netPrice');
            const totalQuoteEl = document.getElementById('totalQuote');
            const numPagesInput = document.getElementById('numPages');
            const quantityInput = document.querySelector('input[type="number"][min="1"]');

            const priceState = {
                binding: 0,
                size: 0,
                orientation: 0,
                paper: 0,
                cover: 0,
                coating: 0,
                classes: 0, // finishes
                pages: 0,
            };

            let quantity = 1;
            let basePrice = 5.00; // Base price per unit

            function format(val) {
                return `$${val.toFixed(2)}`;
            }

            function updateDisplay() {
                const optionsTotal = Object.values(priceState).reduce((a, b) => a + b, 0);
                const unitPrice = basePrice + optionsTotal;
                const total = unitPrice * quantity;
                if (netPriceEl) netPriceEl.textContent = format(total);
                if (totalQuoteEl) totalQuoteEl.textContent = format(total);

                // Update quantity display
                const quantityDisplay = document.querySelector('.space-y-4 .flex:first-child span.font-semibold');
                if (quantityDisplay) quantityDisplay.textContent = quantity;

                // Update hidden form fields for cart submission
                const cartPriceInput = document.getElementById('cartPrice');
                const cartConfigInput = document.getElementById('cartConfigurations');
                if (cartPriceInput) cartPriceInput.value = total.toFixed(2);
                if (cartConfigInput) cartConfigInput.value = JSON.stringify(configState);
            }

            // Track configuration selections
            const configState = {
                finish: []
            };

            // Deselect all siblings and select the clicked button
            function selectOption(btn, cat) {
                const siblings = document.querySelectorAll(`button[data-category="${cat}"]`);
                siblings.forEach(sib => {
                    // Remove selected styles
                    sib.classList.remove('border-2', 'border-blue-600', 'bg-blue-50', 'shadow-md');
                    // Add unselected styles
                    sib.classList.add('border', 'border-gray-300');
                    if (!sib.classList.contains('bg-gray-50')) {
                        sib.classList.add('bg-white');
                    }
                });
                // Add selected styles to clicked button
                btn.classList.remove('border', 'border-gray-300', 'bg-white');
                btn.classList.add('border-2', 'border-blue-600', 'bg-blue-50', 'shadow-md');
            }

            // Handle generic option clicks (buttons)
            function wireButtons() {
                const buttons = document.querySelectorAll('button[data-category][data-price]');
                buttons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        const cat = btn.dataset.category;
                        const price = parseFloat(btn.dataset.price || '0');

                        if (cat) {
                            selectOption(btn, cat);
                            priceState[cat] = price;
                            // Track the selected option name
                            const optionText = btn.querySelector('div:last-child')?.textContent?.trim() ||
                                btn.textContent?.trim() || cat;
                            configState[cat] = optionText;
                            updateDisplay();
                        }
                    });
                });
            }

            // Handle radio inputs with data-price
            function wireRadios() {
                const radios = document.querySelectorAll('input[type="radio"][data-category][data-price]');
                radios.forEach(r => {
                    r.addEventListener('change', () => {
                        if (!r.checked) return;
                        const cat = r.dataset.category;
                        const price = parseFloat(r.dataset.price || '0');
                        priceState[cat] = price;
                        // Track the selected option
                        const label = r.closest('label');
                        configState[cat] = label?.querySelector('span')?.textContent?.trim() || r.value;
                        updateDisplay();

                        // Highlight the selected radio's label
                        const radioGroup = document.querySelectorAll(`input[name="${r.name}"]`);
                        radioGroup.forEach(radio => {
                            const label = radio.closest('label');
                            if (label) {
                                if (radio.checked) {
                                    label.classList.add('border-blue-500', 'bg-blue-50');
                                    label.classList.remove('border-gray-300');
                                } else {
                                    label.classList.remove('border-blue-500', 'bg-blue-50');
                                    label.classList.add('border-gray-300');
                                }
                            }
                        });
                    });
                });
            }

            // Handle Checkboxes (Finishes)
            function wireCheckboxes() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"][data-category][data-price]');
                checkboxes.forEach(cb => {
                    cb.addEventListener('change', () => {
                        const cat = cb.dataset.category;
                        // Recalculate total for this category (e.g., 'finish')
                        const allCatCheckboxes = document.querySelectorAll(`input[type="checkbox"][data-category="${cat}"]:checked`);
                        let catTotal = 0;
                        const selectedLabels = [];

                        allCatCheckboxes.forEach(checkedBox => {
                            catTotal += parseFloat(checkedBox.dataset.price || '0');
                            const label = checkedBox.closest('label');
                            selectedLabels.push(label?.querySelector('span')?.textContent?.trim() || checkedBox.value);
                        });

                        priceState[cat] = catTotal;
                        configState[cat] = selectedLabels;
                        updateDisplay();

                        // Highlight/Unhighlight
                        const label = cb.closest('label');
                        if (label) {
                            if (cb.checked) {
                                label.classList.add('border-blue-500', 'bg-blue-50');
                                label.classList.remove('border-gray-300');
                            } else {
                                label.classList.remove('border-blue-500', 'bg-blue-50');
                                label.classList.add('border-gray-300');
                            }
                        }
                    });
                });
            }

            // Coating select
            function wireCoating() {
                const select = document.getElementById('coatingSelect');
                if (!select) return;
                select.addEventListener('change', () => {
                    const option = select.selectedOptions[0];
                    const price = parseFloat(option?.dataset.price || '0');
                    priceState.coating = price;
                    configState.coating = option?.textContent?.trim() || 'None';
                    updateDisplay();
                });
            }

            // Pages price: add a small increment per 4 pages over base 40
            function wirePages() {
                if (!numPagesInput) return;
                const handler = () => {
                    const pages = Math.max(40, parseInt(numPagesInput.value || '40', 10));
                    const steps = Math.max(0, Math.floor((pages - 40) / 4));
                    priceState.pages = steps * 0.50;
                    configState.pages = pages;
                    updateDisplay();
                };
                numPagesInput.addEventListener('input', handler);
                handler();
            }

            // Quantity input
            function wireQuantity() {
                const qtyInput = document.getElementById('quantityInput');
                if (!qtyInput) return;
                qtyInput.addEventListener('input', () => {
                    quantity = Math.max(1, parseInt(qtyInput.value || '1', 10));
                    updateDisplay();
                });
                quantity = Math.max(1, parseInt(qtyInput.value || '1', 10));
            }

            // Pricing table buttons
            function wirePriceDateOptions() {
                const priceDateButtons = document.querySelectorAll('.price-date-option');

                priceDateButtons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();

                        priceDateButtons.forEach(b => {
                            b.classList.remove('bg-blue-600', 'text-white');
                            b.classList.add('bg-white', 'text-gray-900');
                        });

                        btn.classList.remove('bg-white', 'text-gray-900');
                        btn.classList.add('bg-blue-600', 'text-white');

                        const selectedPrice = parseFloat(btn.dataset.price || '0');
                        basePrice = selectedPrice;
                        updateDisplay();
                    });
                });
            }

            // Paper type tabs
            function wirePaperTabs() {
                const paperTabs = document.querySelectorAll('.grid.grid-cols-3.bg-gray-100 button');
                paperTabs.forEach(tab => {
                    tab.addEventListener('click', (e) => {
                        e.preventDefault();
                        const parent = tab.closest('.grid.grid-cols-3');
                        if (!parent) return;

                        parent.querySelectorAll('button').forEach(t => {
                            t.classList.remove('bg-white', 'font-semibold', 'text-gray-900');
                            t.classList.add('font-medium', 'text-gray-600');
                        });

                        tab.classList.remove('font-medium', 'text-gray-600');
                        tab.classList.add('bg-white', 'font-semibold', 'text-gray-900');
                    });
                });
            }

            // Initialize everything
            wireButtons();
            wireRadios();
            wireCheckboxes();
            wireCoating();
            wirePages();
            wireQuantity();
            wirePriceDateOptions();
            wirePaperTabs();

            // Initialize defaults based on preselected elements
            document.querySelectorAll('button.border-blue-600[data-category][data-price], button.border-2[data-category][data-price]').forEach(btn => {
                const cat = btn.dataset.category;
                const price = parseFloat(btn.dataset.price || '0');
                if (cat) {
                    priceState[cat] = price;
                    const optionText = btn.querySelector('div:last-child')?.textContent?.trim() ||
                        btn.textContent?.trim() || cat;
                    configState[cat] = optionText;
                }
            });

            document.querySelectorAll('input[type="radio"][data-category][data-price]:checked').forEach(r => {
                priceState[r.dataset.category] = parseFloat(r.dataset.price || '0');
                const label = r.closest('label');
                configState[r.dataset.category] = label?.querySelector('span')?.textContent?.trim() || r.value;

                // Set initial visual state for radios
                if (label) {
                    label.classList.add('border-blue-500', 'bg-blue-50');
                    label.classList.remove('border-gray-300');
                }
            });

            const select = document.getElementById('coatingSelect');
            if (select) {
                const option = select.selectedOptions[0];
                priceState.coating = parseFloat(option?.dataset.price || '0');
                configState.coating = option?.textContent?.trim() || 'None';
            }

            updateDisplay();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\products\configure\book.blade.php ENDPATH**/ ?>