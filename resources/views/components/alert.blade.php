@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => true,
    'icon' => true
])

@php
$types = [
    'success' => 'bg-green-50 border-green-200 text-green-800',
    'error' => 'bg-red-50 border-red-200 text-red-800',
    'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
    'info' => 'bg-blue-50 border-blue-200 text-blue-800'
];

$icons = [
    'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
    'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
    'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
    'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
];

$colorClass = $types[$type] ?? $types['info'];
$iconPath = $icons[$type] ?? $icons['info'];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border p-4 ' . $colorClass]) }} role="alert">
    <div class="flex items-start">
        @if($icon)
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $iconPath !!}
                </svg>
            </div>
        @endif
        
        <div class="ml-3 flex-1">
            @if($title)
                <h3 class="font-semibold text-sm mb-1">{{ $title }}</h3>
            @endif
            <div class="text-sm">
                {{ $slot }}
            </div>
        </div>
        
        @if($dismissible)
            <button 
                type="button" 
                class="ml-3 flex-shrink-0 inline-flex text-gray-400 hover:text-gray-500 focus:outline-none"
                onclick="this.closest('[role=alert]').remove()"
            >
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
    </div>
</div>
