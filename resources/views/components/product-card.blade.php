@props([
    'product' => null,
    'title' => '',
    'image' => '',
    'price' => '',
    'url' => '#',
    'badge' => null,
    'description' => null
])

@php
$product = $product ?? (object)[
    'title' => $title,
    'images' => $image ? [$image] : [],
    'price' => $price,
    'slug' => $url,
    'badge' => $badge,
    'description' => $description
];
@endphp

<div {{ $attributes->merge(['class' => 'group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200']) }}>
    <a href="{{ is_object($product) && isset($product->slug) ? $product->slug : $url }}" class="block">
        {{-- Image --}}
        <div class="relative aspect-square overflow-hidden bg-gray-100">
            @if(isset($product->images) && count($product->images) > 0)
                <img 
                    src="{{ $product->images[0] }}" 
                    alt="{{ $product->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                    loading="lazy"
                >
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
            
            {{-- Badge --}}
            @if($product->badge ?? $badge)
                <span class="absolute top-2 right-2 bg-[#f6c324] text-[#2e7c31] px-2 py-1 rounded text-xs font-medium">
                    {{ $product->badge ?? $badge }}
                </span>
            @endif
        </div>

        {{-- Content --}}
        <div class="p-4">
            <h3 class="font-semibold text-lg text-gray-900 group-hover:text-[#2e7c31] transition-colors">
                {{ $product->title ?? $title }}
            </h3>
            
            @if(isset($product->description) || $description)
                <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                    {{ $product->description ?? $description }}
                </p>
            @endif
            
            <div class="mt-3 flex items-center justify-between">
                @if($product->price ?? $price)
                    <span class="text-xl font-bold text-[#2e7c31]">
                        ৳{{ $product->price ?? $price }}
                    </span>
                @endif
                
                <span class="text-sm text-[#2e7c31] font-medium group-hover:translate-x-1 transition-transform inline-flex items-center">
                    অর্ডার করুন
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </div>
        </div>
    </a>
</div>
