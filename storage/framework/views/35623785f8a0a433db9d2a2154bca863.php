<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <a href="/" class="flex items-center">
                    <?php if(!empty($headerContent['logo'])): ?>
                        <img src="<?php echo e($headerContent['logo']); ?>" alt="<?php echo e($headerContent['site_name'] ?? config('site.name')); ?>" class="h-10 md:h-12 w-auto">
                    <?php else: ?>
                        <img src="<?php echo e(asset('logo.png')); ?>" alt="<?php echo e($headerContent['site_name'] ?? config('site.name')); ?>" class="h-10 md:h-12 w-auto">
                    <?php endif; ?>
                </a>
            </div>

            <!-- Search Bar - Hidden on mobile -->
            <div class="hidden md:flex flex-1 max-w-2xl lg:max-w-3xl mx-4 lg:mx-6">
                <div class="relative w-full">
                    <input
                        type="text"
                        placeholder="What are you looking for?"
                        class="w-full px-4 py-2 pr-12 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    >
                    <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Side Menu -->
            <div class="flex items-center gap-2 sm:gap-4">
                <a href="tel:<?php echo e($headerContent['phone'] ?? config('site.phone')); ?>" class="hidden lg:flex items-center gap-2 text-gray-700 hover:text-gray-900 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span><?php echo e($headerContent['phone'] ?? config('site.phone')); ?></span>
                </a>

                <button class="hidden md:flex items-center gap-1 text-gray-700 hover:text-gray-900 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Help</span>
                </button>

                <?php if(auth()->guard()->check()): ?>
                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-gray-100 transition">
                            <?php if(Auth::user()->profile_image): ?>
                                <img src="<?php echo e(Auth::user()->profile_image); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="w-8 h-8 rounded-full object-cover">
                            <?php else: ?>
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                                    <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                                </div>
                            <?php endif; ?>
                            <span class="hidden md:inline text-sm text-gray-700 font-medium"><?php echo e(Auth::user()->name); ?></span>
                            <svg class="w-4 h-4 text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50"
                             style="display: none;">
                            
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900"><?php echo e(Auth::user()->name); ?></p>
                                <p class="text-xs text-gray-500 truncate"><?php echo e(Auth::user()->email); ?></p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <?php if(Auth::user()->is_admin): ?>
                                    <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z"/>
                                        </svg>
                                        Admin Dashboard
                                    </a>
                                <?php endif; ?>
                                
                                <a href="/profile" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    View Profile
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="border-t border-gray-100 py-1">
                                <form action="/logout" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition w-full text-left">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="flex items-center gap-1 px-3 py-1.5 text-sm text-gray-700 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span class="hidden sm:inline">Login</span>
                    </a>
                    <a href="/register" class="flex items-center gap-1 px-3 py-1.5 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span class="hidden sm:inline">Sign Up</span>
                    </a>
                <?php endif; ?>

                <a href="<?php echo e(route('cart.index')); ?>" class="flex items-center gap-1 text-gray-700 hover:text-gray-900 text-sm md:text-base relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="hidden sm:inline font-semibold">Basket</span>
                    <span class="absolute -top-1 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center basket-count"><?php echo e(session()->get('cart') ? count(session()->get('cart')) : '0'); ?></span>
                </a>

                <!-- Mobile Menu Toggle -->
                <button id="mobile-menu-btn" class="md:hidden flex items-center text-gray-700 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Search Bar for Mobile -->
    <div class="md:hidden border-t border-gray-200 px-4 py-3 bg-gray-50">
        <div class="relative">
            <input
                type="text"
                placeholder="Search..."
                class="w-full px-4 py-2 pr-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
            >
            <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto scrollbar-hide -mx-4 sm:-mx-6 lg:-mx-8">
                <div class="flex items-center gap-4 sm:gap-6 md:gap-8 h-12 md:h-14 pl-4 sm:pl-6 lg:pl-8 pr-4 sm:pr-6 lg:pr-8">
                    <?php if(isset($headerContent['navigation']) && count($headerContent['navigation']) > 0): ?>
                        <?php $__currentLoopData = $headerContent['navigation']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($navItem['url']); ?>" class="<?php echo e(request()->is(ltrim($navItem['pattern'] ?? $navItem['url'], '/')) ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap"><?php echo e($navItem['title']); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <a href="/" class="<?php echo e(request()->is('/') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Home</a>
                        <a href="/shop" class="<?php echo e(request()->is('shop') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Shop</a>
                        <a href="/magazines" class="<?php echo e(request()->is('magazines*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Magazines</a>
                        <a href="/books" class="<?php echo e(request()->is('books*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Books</a>
                        <a href="/catalogs" class="<?php echo e(request()->is('catalogs*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Catalog</a>
                        <a href="/brochures" class="<?php echo e(request()->is('brochures*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Marketing Material</a>
                        <a href="/business-cards" class="<?php echo e(request()->is('business-cards*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Business Cards</a>
                        <a href="/postcards-invitations" class="<?php echo e(request()->is('postcards-invitations*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Invitation & Stationery</a>
                        <a href="/banners" class="<?php echo e(request()->is('banners*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Banners</a>
                        <a href="/promotional-items" class="<?php echo e(request()->is('promotional-items*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900'); ?> text-xs sm:text-sm md:text-base whitespace-nowrap">Promotional Items</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                alert('Mobile menu feature coming soon!');
            });
        }
    });
</script>
<?php /**PATH F:\Code\chapakhana\resources\views/partials/header.blade.php ENDPATH**/ ?>