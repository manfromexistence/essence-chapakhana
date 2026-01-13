<?php $__env->startSection('title', 'Shop | Chapakhana'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden">
        <!-- Cover Image Background -->
        <?php if(isset($hero->cover_image) && $hero->cover_image): ?>
            <div class="absolute inset-0 z-0">
                <img src="<?php echo e($hero->cover_image); ?>" alt="Shop Hero" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900/85 via-slate-800/80 to-slate-900/85"></div>
            </div>
        <?php endif; ?>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6">
                    <p class="text-sm sm:text-base uppercase tracking-[0.2em] text-blue-300 font-medium">
                        <?php echo e($hero->subtitle ?? 'CURATED PRINT CATALOGUE'); ?>

                    </p>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                        <?php echo e($hero->title ?? 'Shop every format in one place.'); ?>

                    </h1>
                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed">
                        <?php echo e($hero->description ?? 'Browse books, marketing kits, signage, and packaging with ready-to-order specs. Filter fast, compare formats, and ship anywhere.'); ?>

                    </p>
                    <div class="flex flex-wrap gap-3 pt-2">
                        <?php if(isset($hero->badges) && $hero->badges): ?>
                            <?php $__currentLoopData = $hero->badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-sm px-4 py-2 text-sm font-medium border border-white/20">
                                    <?php echo e($badge); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-sm px-4 py-2 text-sm font-medium border border-white/20">Lead times 48h</span>
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-sm px-4 py-2 text-sm font-medium border border-white/20">Color-managed</span>
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-sm px-4 py-2 text-sm font-medium border border-white/20">Proofing included</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right Stats Grid -->
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl">
                    <div class="grid grid-cols-2 gap-4 sm:gap-5">
                        <!-- Stat 1 -->
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-5 sm:p-6 border border-white/10 hover:bg-white/15 transition-all duration-300">
                            <p class="text-xs sm:text-sm text-blue-200 font-medium mb-1">
                                <?php echo e($hero->stat1_label ?? 'Average rating'); ?>

                            </p>
                            <p class="text-3xl sm:text-4xl font-bold text-white mb-1">
                                <?php echo e($hero->stat1_value ?? '4.6'); ?>

                            </p>
                            <p class="text-xs sm:text-sm text-slate-300">
                                <?php echo e($hero->stat1_sublabel ?? 'Feefo verified'); ?>

                            </p>
                        </div>

                        <!-- Stat 2 -->
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-5 sm:p-6 border border-white/10 hover:bg-white/15 transition-all duration-300">
                            <p class="text-xs sm:text-sm text-blue-200 font-medium mb-1">
                                <?php echo e($hero->stat2_label ?? 'Formats'); ?>

                            </p>
                            <p class="text-3xl sm:text-4xl font-bold text-white mb-1">
                                <?php echo e($hero->stat2_value ?? '30+'); ?>

                            </p>
                            <p class="text-xs sm:text-sm text-slate-300">
                                <?php echo e($hero->stat2_sublabel ?? 'Books to boxes'); ?>

                            </p>
                        </div>

                        <!-- Stat 3 -->
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-5 sm:p-6 border border-white/10 hover:bg-white/15 transition-all duration-300">
                            <p class="text-xs sm:text-sm text-blue-200 font-medium mb-1">
                                <?php echo e($hero->stat3_label ?? 'Turnaround'); ?>

                            </p>
                            <p class="text-3xl sm:text-4xl font-bold text-white mb-1">
                                <?php echo e($hero->stat3_value ?? '48h'); ?>

                            </p>
                            <p class="text-xs sm:text-sm text-slate-300">
                                <?php echo e($hero->stat3_sublabel ?? 'Express available'); ?>

                            </p>
                        </div>

                        <!-- Stat 4 -->
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-5 sm:p-6 border border-white/10 hover:bg-white/15 transition-all duration-300">
                            <p class="text-xs sm:text-sm text-blue-200 font-medium mb-1">
                                <?php echo e($hero->stat4_label ?? 'Support'); ?>

                            </p>
                            <p class="text-3xl sm:text-4xl font-bold text-white mb-1">
                                <?php echo e($hero->stat4_value ?? '24/7'); ?>

                            </p>
                            <p class="text-xs sm:text-sm text-slate-300">
                                <?php echo e($hero->stat4_sublabel ?? 'Print specialists'); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-10 sm:py-12 lg:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-4 gap-8">
            <aside class="bg-gray-50 border border-gray-200 rounded-xl p-4 sm:p-5 h-fit space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-gray-900">Filters</h2>
                    <button id="clearFilters" class="text-xs text-blue-600 hover:text-blue-700">Clear all</button>
                </div>

                <div class="space-y-2">
                    <p class="text-xs font-semibold text-gray-700">Search</p>
                    <div class="relative">
                        <input id="searchProducts" type="text" placeholder="Find product or use case"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-3">
                    <p class="text-xs font-semibold text-gray-700">Categories</p>
                    <div class="space-y-2">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" value="<?php echo e($category->slug); ?>"
                                    class="category-filter rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span><?php echo e($category->name); ?></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between text-xs font-semibold text-gray-700">
                        <span>Max price</span>
                        <span id="priceValue" class="text-blue-600">$15000</span>
                    </div>
                    <input id="priceRange" type="range" min="5" max="15000" step="10" value="15000"
                        class="w-full accent-blue-600">
                </div>

                <div class="space-y-2">
                    <p class="text-xs font-semibold text-gray-700">Format</p>
                    <div class="flex flex-wrap gap-2">
                        <?php $__currentLoopData = $formats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button"
                                class="format-chip rounded-full border border-gray-300 px-3 py-1 text-xs text-gray-700 hover:border-blue-500"
                                data-format="<?php echo e($format->slug); ?>"><?php echo e($format->name); ?></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-xs font-semibold text-gray-700">Rating</p>
                    <div class="space-y-1 text-sm text-gray-700">
                        <label class="flex items-center gap-2"><input type="radio" name="rating" value="4.5"
                                class="rating-filter text-blue-600">4.5+ stars</label>
                        <label class="flex items-center gap-2"><input type="radio" name="rating" value="4.0"
                                class="rating-filter text-blue-600">4.0+ stars</label>
                        <label class="flex items-center gap-2"><input type="radio" name="rating" value="0"
                                class="rating-filter text-blue-600" checked>Any rating</label>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-xs font-semibold text-gray-700">Availability</p>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input id="stockToggle" type="checkbox"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                        In stock only
                    </label>
                </div>
            </aside>

            <div class="lg:col-span-3 space-y-6">
                <div class="flex flex-wrap items-center gap-3 justify-between">
                    <div class="text-sm text-gray-600">Showing <span id="resultCount"
                            class="font-semibold text-gray-900"><?php echo e(count($products)); ?></span> products</div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-gray-600">Sort</span>
                        <select id="sortSelect"
                            class="rounded-lg border border-gray-300 text-sm px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            <option value="latest" selected>Newest First</option>
                            <option value="popular">Most popular</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="rating-desc">Rating: High to Low</option>
                        </select>
                    </div>
                </div>

                <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article
                            class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                            data-product-card data-title="<?php echo e(strtolower($product->title)); ?>"
                            data-category="<?php echo e($product->category->slug); ?>" data-format="<?php echo e(strtolower($product->format)); ?>"
                            data-price="<?php echo e($product->price); ?>" data-rating="<?php echo e($product->rating); ?>"
                            data-popularity="<?php echo e($product->popularity); ?>" data-tags="<?php echo e(strtolower($product->description)); ?>"
                            data-stock="<?php echo e($product->stock ? '1' : '0'); ?>"
                            data-created="<?php echo e($product->created_at->timestamp); ?>">
                            <a href="<?php echo e(route('product.' . $product->category->slug, ['category' => $product->category->slug, 'product' => $product->slug])); ?>"
                                class="block">
                                <div class="relative h-44 bg-gray-100 overflow-hidden">
                                    <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->title); ?>"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    <?php if($product->badge): ?>
                                        <span
                                            class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-[11px] font-semibold text-gray-800 border border-gray-200"><?php echo e($product->badge); ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div class="p-4 space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="text-xs uppercase tracking-wide text-blue-600 font-semibold">
                                        <?php echo e($product->category->name); ?></div>
                                    <div class="flex items-center gap-1 text-xs text-yellow-500">
                                        <span class="font-semibold"><?php echo e(number_format($product->rating, 1)); ?></span>
                                        <span>★</span>
                                    </div>
                                </div>
                                <a href="<?php echo e(route('product.' . $product->category->slug, ['category' => $product->category->slug, 'product' => $product->slug])); ?>">
                                    <h3
                                        class="text-base font-bold text-gray-900 leading-snug hover:text-blue-600 transition-colors">
                                        <?php echo e($product->title); ?></h3>
                                </a>
                                <p class="text-xs text-gray-600 leading-relaxed"><?php echo e($product->description); ?></p>
                                <div class="flex items-center justify-between pt-2">
                                    <div class="text-lg font-bold text-gray-900">৳<?php echo e(number_format($product->price, 2)); ?></div>
                                    <div class="flex items-center gap-2 text-xs text-gray-600">
                                        <span class="rounded-full bg-gray-100 px-2 py-1"><?php echo e($product->format); ?></span>
                                        <span class="rounded-full bg-green-50 text-green-700 px-2 py-1">In stock</span>
                                    </div>
                                </div>
                                <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="w-full mt-3">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <input type="hidden" name="title" value="<?php echo e($product->title); ?>">
                                    <input type="hidden" name="category" value="<?php echo e($product->category->slug); ?>">
                                    <input type="hidden" name="format" value="<?php echo e($product->format); ?>">
                                    <input type="hidden" name="price" value="<?php echo e($product->price); ?>">
                                    <input type="hidden" name="rating" value="<?php echo e($product->rating); ?>">
                                    <input type="hidden" name="desc" value="<?php echo e($product->description); ?>">
                                    <input type="hidden" name="image" value="<?php echo e($product->image); ?>">
                                    <input type="hidden" name="stock" value="<?php echo e($product->stock ? '1' : '0'); ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2-8m-10 8h12m0 0h2m-2 0v2m0-2v-2">
                                            </path>
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchProducts');
            const categoryChecks = document.querySelectorAll('.category-filter');
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');
            const ratingRadios = document.querySelectorAll('.rating-filter');
            const stockToggle = document.getElementById('stockToggle');
            const sortSelect = document.getElementById('sortSelect');
            const clearBtn = document.getElementById('clearFilters');
            const formatButtons = document.querySelectorAll('.format-chip');
            const cards = Array.from(document.querySelectorAll('[data-product-card]'));
            const grid = document.getElementById('productGrid');
            const resultCount = document.getElementById('resultCount');
            let selectedFormat = '';

            const updatePriceOutput = () => {
                priceValue.textContent = `৳${priceRange.value}`;
            };

            const sortCards = () => {
                const sorted = cards.slice().sort((a, b) => {
                    const pa = parseFloat(a.dataset.price);
                    const pb = parseFloat(b.dataset.price);
                    const ra = parseFloat(a.dataset.rating);
                    const rb = parseFloat(b.dataset.rating);
                    const popA = parseFloat(a.dataset.popularity);
                    const popB = parseFloat(b.dataset.popularity);
                    const createdA = parseFloat(a.dataset.created);
                    const createdB = parseFloat(b.dataset.created);

                    switch (sortSelect.value) {
                        case 'price-asc':
                            return pa - pb;
                        case 'price-desc':
                            return pb - pa;
                        case 'rating-desc':
                            return rb - ra;
                        case 'latest':
                            return createdB - createdA;
                        case 'popular':
                            return popB - popA;
                        default:
                            return createdB - createdA;
                    }
                });
                sorted.forEach(card => grid.appendChild(card));
                return sorted;
            };

            const applyFilters = () => {
                const term = searchInput.value.trim().toLowerCase();
                const activeCategories = Array.from(categoryChecks).filter(c => c.checked).map(c => c.value);
                const maxPrice = parseFloat(priceRange.value);
                const ratingChoice = Array.from(ratingRadios).find(r => r.checked);
                const minRating = ratingChoice ? parseFloat(ratingChoice.value) : 0;
                const requireStock = stockToggle.checked;
                const sortedCards = sortCards();
                let visible = 0;

                sortedCards.forEach(card => {
                    const title = card.dataset.title;
                    const tags = card.dataset.tags;
                    const category = card.dataset.category;
                    const price = parseFloat(card.dataset.price);
                    const rating = parseFloat(card.dataset.rating);
                    const format = card.dataset.format;
                    const inStock = card.dataset.stock === '1';

                    const matchesTerm = term === '' || title.includes(term) || tags.includes(term);
                    const matchesCategory = activeCategories.length === 0 || activeCategories.includes(category);
                    const matchesPrice = price <= maxPrice;
                    const matchesRating = rating >= minRating;
                    const matchesStock = !requireStock || inStock;
                    const matchesFormat = selectedFormat === '' || format === selectedFormat;

                    const show = matchesTerm && matchesCategory && matchesPrice && matchesRating && matchesStock && matchesFormat;
                    card.classList.toggle('hidden', !show);
                    if (show) visible += 1;
                });

                resultCount.textContent = visible;
            };

            const resetFilters = () => {
                searchInput.value = '';
                categoryChecks.forEach(c => { c.checked = false; });
                ratingRadios.forEach(r => { r.checked = r.value === '0'; });
                priceRange.value = 15000;
                selectedFormat = '';
                stockToggle.checked = true;
                formatButtons.forEach(btn => btn.classList.remove('border-blue-500', 'bg-blue-50', 'text-blue-700'));
                updatePriceOutput();
                applyFilters();
            };

            formatButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const value = btn.dataset.format;
                    selectedFormat = selectedFormat === value ? '' : value;
                    formatButtons.forEach(b => b.classList.remove('border-blue-500', 'bg-blue-50', 'text-blue-700'));
                    if (selectedFormat) {
                        const activeBtn = Array.from(formatButtons).find(b => b.dataset.format === selectedFormat);
                        if (activeBtn) activeBtn.classList.add('border-blue-500', 'bg-blue-50', 'text-blue-700');
                    }
                    applyFilters();
                });
            });

            priceRange.addEventListener('input', () => { updatePriceOutput(); applyFilters(); });
            searchInput.addEventListener('input', applyFilters);
            categoryChecks.forEach(check => check.addEventListener('change', applyFilters));
            ratingRadios.forEach(radio => radio.addEventListener('change', applyFilters));
            stockToggle.addEventListener('change', applyFilters);
            sortSelect.addEventListener('change', applyFilters);
            clearBtn.addEventListener('click', resetFilters);

            updatePriceOutput();
            applyFilters();
        });
    </script>
<?php $__env->stopPush(); ?>

<!-- Product Detail Modal -->

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views/pages/shop.blade.php ENDPATH**/ ?>