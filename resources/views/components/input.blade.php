@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'helpText' => null
])

<div {{ $attributes->only('class') }}>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->except(['class', 'label', 'helpText', 'error'])->merge([
            'class' => 'block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#2e7c31] focus:ring focus:ring-[#2e7c31] focus:ring-opacity-50 ' . ($error ? 'border-red-300' : '')
        ]) }}
    >
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
    
    @if($helpText)
        <p class="mt-1 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>
