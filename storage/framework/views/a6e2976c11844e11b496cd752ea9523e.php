<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'helpText' => null
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
    'label' => '',
    'name' => '',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'helpText' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->only('class')); ?>>
    <?php if($label): ?>
        <label for="<?php echo e($name); ?>" class="block text-sm font-medium text-gray-700 mb-1">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-500">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>
    
    <input
        type="<?php echo e($type); ?>"
        name="<?php echo e($name); ?>"
        id="<?php echo e($name); ?>"
        value="<?php echo e(old($name, $value)); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($attributes->except(['class', 'label', 'helpText', 'error'])->merge([
            'class' => 'block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#2e7c31] focus:ring focus:ring-[#2e7c31] focus:ring-opacity-50 ' . ($error ? 'border-red-300' : '')
        ])); ?>

    >
    
    <?php if($error): ?>
        <p class="mt-1 text-sm text-red-600"><?php echo e($error); ?></p>
    <?php endif; ?>
    
    <?php if($helpText): ?>
        <p class="mt-1 text-sm text-gray-500"><?php echo e($helpText); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH F:\Code\chapakhana\resources\views\components\input.blade.php ENDPATH**/ ?>