<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left'
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
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
    'icon' => null,
    'iconPosition' => 'left'
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
?>

<?php if($href): ?>
    <a 
        href="<?php echo e($href); ?>" 
        <?php echo e($attributes->merge(['class' => $classes])); ?>

    >
        <?php if($icon && $iconPosition === 'left'): ?>
            <span class="mr-2"><?php echo $icon; ?></span>
        <?php endif; ?>
        <?php echo e($slot); ?>

        <?php if($icon && $iconPosition === 'right'): ?>
            <span class="ml-2"><?php echo $icon; ?></span>
        <?php endif; ?>
    </a>
<?php else: ?>
    <button 
        type="<?php echo e($type); ?>"
        <?php echo e($disabled ? 'disabled' : ''); ?>

        <?php echo e($attributes->merge(['class' => $classes])); ?>

    >
        <?php if($icon && $iconPosition === 'left'): ?>
            <span class="mr-2"><?php echo $icon; ?></span>
        <?php endif; ?>
        <?php echo e($slot); ?>

        <?php if($icon && $iconPosition === 'right'): ?>
            <span class="ml-2"><?php echo $icon; ?></span>
        <?php endif; ?>
    </button>
<?php endif; ?>
<?php /**PATH F:\Code\chapakhana\resources\views\components\button.blade.php ENDPATH**/ ?>