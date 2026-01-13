<aside class="w-64 bg-white border-r border-gray-200 min-h-screen sticky top-16">
    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-gray-700 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="font-medium">Home</span>
        </a>



        <!-- Shop Dropdown -->
        <div class="space-y-1">
            <button type="button"
                onclick="toggleDropdown('shop-dropdown')"
                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-lg transition group {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.formats.*') || request()->routeIs('admin.orders.*') || request()->routeIs('admin.checkout-fields.*') || request()->routeIs('admin.shop-hero.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="font-medium">Shop</span>
                </div>
                <svg id="shop-dropdown-arrow" class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.formats.*') || request()->routeIs('admin.orders.*') || request()->routeIs('admin.checkout-fields.*') || request()->routeIs('admin.shop-hero.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="shop-dropdown" class="{{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.formats.*') || request()->routeIs('admin.orders.*') || request()->routeIs('admin.checkout-fields.*') || request()->routeIs('admin.shop-hero.*') ? '' : 'hidden' }} pl-12 space-y-1 mt-1">
                <a href="{{ route('admin.categories.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    Categories
                </a>
                <a href="{{ route('admin.products.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.products.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    Products
                </a>
                <a href="{{ route('admin.formats.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.formats.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    Formats
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.orders.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    Orders
                </a>
                <a href="{{ route('admin.checkout-fields.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.checkout-fields.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    Checkout Fields
                </a>
                <a href="{{ route('admin.shop-hero.edit') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.shop-hero.edit') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    Shop Hero
                </a>
            </div>
        </div>

        <!-- Services Dropdown -->
        <div class="space-y-1">
            <button type="button"
                onclick="toggleDropdown('services-dropdown')"
                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-lg transition group {{ request()->routeIs('admin.service-categories.*') || request()->routeIs('admin.service-products.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span class="font-medium">Services</span>
                </div>
                <svg id="services-dropdown-arrow" class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('admin.service-categories.*') || request()->routeIs('admin.service-products.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="services-dropdown" class="{{ request()->routeIs('admin.service-categories.*') || request()->routeIs('admin.service-products.*') ? '' : 'hidden' }} pl-12 space-y-1 mt-1">
                <a href="{{ route('admin.service-categories.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.service-categories.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    All Categories
                </a>
                <a href="{{ route('admin.service-products.index') }}" class="block py-2 text-sm transition-colors {{ request()->routeIs('admin.service-products.*') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    All Products
                </a>

                @if(isset($serviceCategories) && $serviceCategories->count() > 0)
                    <div class="border-t border-gray-200 my-2 pt-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Categories</p>
                        @foreach($serviceCategories as $category)
                            <a href="{{ route('admin.service-products.index', ['category' => $category->slug]) }}"
                               class="block py-2 text-sm transition-colors text-gray-600 hover:text-blue-600 pl-2"
                               title="{{ $category->description }}">
                                {{ $category->name }}
                                <span class="text-xs text-gray-400">({{ $category->products_count }})</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </nav>
</aside>

<script>
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    const arrow = document.getElementById(id + '-arrow');

    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        dropdown.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}
</script>
