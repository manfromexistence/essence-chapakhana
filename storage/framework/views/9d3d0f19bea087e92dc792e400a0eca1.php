<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'product' => null,
    'title' => '',
    'image' => '',
    'price' => '',
    'url' => '#',
    'badge' => null,
    'description' => null
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
    'product' => null,
    'title' => '',
    'image' => '',
    'price' => '',
    'url' => '#',
    'badge' => null,
    'description' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$product = $product ?? (object)[
    'title' => $title,
    'images' => $image ? [$image] : [],
    'price' => $price,
    'slug' => $url,
    'badge' => $badge,
    'description' => $description
];
?>

<div <?php echo e($attributes->merge(['class' => 'group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200'])); ?>>
    <a href="<?php echo e(is_object($product) && isset($product->slug) ? $product->slug : $url); ?>" class="block">
        
        <div class="relative aspect-square overflow-hidden bg-gray-100">
            <?php if(isset($product->images) && count($product->images) > 0): ?>
                <img 
                    src="<?php echo e($product->images[0]); ?>" 
                    alt="<?php echo e($product->title); ?>"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                    loading="lazy"
                >
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            <?php endif; ?>
            
            
            <?php if($product->badge ?? $badge): ?>
                <span class="absolute top-2 right-2 bg-[#f6c324] text-[#2e7c31] px-2 py-1 rounded text-xs font-medium">
                    <?php echo e($product->badge ?? $badge); ?>

                </span>
            <?php endif; ?>
        </div>

        
        <div class="p-4">
            <h3 class="font-semibold text-lg text-gray-900 group-hover:text-[#2e7c31] transition-colors">
                <?php echo e($product->title ?? $title); ?>

            </h3>
            
            <?php if(isset($product->description) || $description): ?>
                <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                    <?php echo e($product->description ?? $description); ?>

                </p>
            <?php endif; ?>
            
            <div class="mt-3 flex items-center justify-between">
                <?php if($product->price ?? $price): ?>
                    <span class="text-xl font-bold text-[#2e7c31]">
                        ৳<?php echo e($product->price ?? $price); ?>

                    </span>
                <?php endif; ?>
                
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
<?php /**PATH F:\Code\chapakhana\resources\views\components\product-card.blade.php ENDPATH**/ ?>