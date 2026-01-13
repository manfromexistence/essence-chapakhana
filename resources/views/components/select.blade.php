@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'options' => [],
    'selected' => '',
    'placeholder' => 'Select an option',
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
    
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->except(['class', 'label', 'helpText', 'error', 'options'])->merge([
            'class' => 'block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#2e7c31] focus:ring focus:ring-[#2e7c31] focus:ring-opacity-50 ' . ($error ? 'border-red-300' : '')
        ]) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
    
    @if($helpText)
        <p class="mt-1 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>
