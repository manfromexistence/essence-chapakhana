<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default',
    'size' => 'md'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'variant' => 'default',
    'size' => 'md'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<span <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH F:\Code\chapakhana\resources\views\components\badge.blade.php ENDPATH**/ ?>