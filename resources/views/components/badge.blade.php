@props([
    'variant' => 'default',
    'size' => 'md'
])

@php
$variants = [
    'default' => 'bg-gray-100 text-gray-800',
    'primary' => 'bg-[#2e7c31] text-white',
    'secondary' => 'bg-gray-600 text-white',
    'success' => 'bg-green-100 text-green-800',
    'danger' => 'bg-red-100 text-red-800',
    'warning' => 'bg-yellow-100 text-yellow-800',
    'info' => 'bg-blue-100 text-blue-800',
    'yellow' => 'bg-[#f6c324] text-[#2e7c31]'
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-1 text-sm',
    'lg' => 'px-3 py-1.5 text-base'
];

$baseClasses = 'inline-flex items-center font-medium rounded-full';
$variantClass = $variants[$variant] ?? $variants['default'];
$sizeClass = $sizes[$size] ?? $sizes['md'];

$classes = $baseClasses . ' ' . $variantClass . ' ' . $sizeClass;
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
