@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left'
])

@php
$variants = [
    'primary' => 'bg-[#2e7c31] hover:bg-[#f6c324] text-white',
    'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white',
    'outline' => 'border-2 border-[#2e7c31] text-[#2e7c31] hover:bg-[#2e7c31] hover:text-white',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    'ghost' => 'text-[#2e7c31] hover:bg-gray-100'
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg'
];

$baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2e7c31] disabled:opacity-50 disabled:cursor-not-allowed';
$variantClass = $variants[$variant] ?? $variants['primary'];
$sizeClass = $sizes[$size] ?? $sizes['md'];

$classes = $baseClasses . ' ' . $variantClass . ' ' . $sizeClass;
@endphp

@if($href)
    <a 
        href="{{ $href }}" 
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon && $iconPosition === 'left')
            <span class="mr-2">{!! $icon !!}</span>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right')
            <span class="ml-2">{!! $icon !!}</span>
        @endif
    </a>
@else
    <button 
        type="{{ $type }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon && $iconPosition === 'left')
            <span class="mr-2">{!! $icon !!}</span>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right')
            <span class="ml-2">{!! $icon !!}</span>
        @endif
    </button>
@endif
