<?php $__env->startSection('title', 'Edit Service Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
        <a href="<?php echo e(route('admin.service-products.index')); ?>" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Service Product</h1>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <form action="<?php echo e(route('admin.service-products.update', $serviceProduct)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6" id="serviceProductForm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label for="service_category_id" class="block text-sm font-semibold text-gray-800 mb-2">Service Category <span class="text-red-500">*</span></label>
                <select name="service_category_id" id="service_category_id" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                    <option value="">Select a category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('service_category_id', $serviceProduct->service_category_id) == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['service_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">Product Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $serviceProduct->name)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product name" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Description</label>
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product description (optional)"><?php echo e(old('description', $serviceProduct->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="price" class="block text-sm font-semibold text-gray-800 mb-2">Price (৳) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" value="<?php echo e(old('price', $serviceProduct->price)); ?>" step="0.01" min="0" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="0.00" required>
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-800 mb-2">Product Image</label>
                <div id="imagePreview" class="<?php echo e($serviceProduct->image ? '' : 'hidden'); ?> mb-3">
                    <?php
                        $imageUrl = $serviceProduct->image;
                        if ($imageUrl && !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                            $imageUrl = asset('uploads/service-products/' . $imageUrl);
                        }
                    ?>
                    <img id="previewImg" src="<?php echo e($imageUrl); ?>" alt="<?php echo e($serviceProduct->name); ?>" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                    <p class="text-sm text-gray-500 mt-1"><?php echo e($serviceProduct->image ? 'Current image' : 'Image preview'); ?></p>
                </div>
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" onchange="previewImage(event)">
                <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image</p>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', $serviceProduct->is_active) ? 'checked' : ''); ?> class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Active Status</label>
                </div>
                <p class="mt-2 ml-8 text-xs text-gray-500">Check to make this product visible on the shop page</p>
            </div>

            <!-- Configuration Options Section -->
            <div class="border-t-4 border-blue-100 pt-6 mt-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Configuration Options</h2>
                        <p class="text-sm text-gray-600 mt-1">Add options like Binding, Size, Paper Type, etc.</p>
                    </div>
                    <button type="button" onclick="addConfigOption()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Option
                    </button>
                </div>

                <div id="configOptionsContainer" class="space-y-4">
                    <?php if($serviceProduct->configOptions->count() > 0): ?>
                        <!-- Existing options will be loaded here by JavaScript -->
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">No configuration options added yet. Click "Add Option" to create customization options for this product.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Update Product</button>
                <a href="<?php echo e(route('admin.service-products.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo e(asset('js/service-product-config.js')); ?>"></script>
<script>
// Load existing configuration options
const existingOptions = <?php echo json_encode($serviceProduct->configOptions, 15, 512) ?>;
configOptionIndex = existingOptions.length;

existingOptions.forEach((option, index) => {
    const container = document.getElementById('configOptionsContainer');
    if (container.querySelector('p.text-gray-500')) {
        container.querySelector('p.text-gray-500').remove();
    }

    let valuesHtml = '';
    option.option_values.forEach((value, valueIndex) => {
        valuesHtml += `
            <div class="flex gap-2 items-center option-value-row">
                <input type="text" name="config_options[${index}][option_values][]" value="${value}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Value name" required>
                <input type="number" name="config_options[${index}][option_prices][]" value="${option.option_prices[valueIndex] || 0}" step="0.01" class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Price (৳)">
                <button type="button" onclick="removeOptionValue(this)" class="text-red-500 hover:text-red-700 p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        `;
    });

    const optionHtml = `
        <div class="config-option-item bg-white border-2 border-gray-200 rounded-lg p-6 relative" data-index="${index}">
            <button type="button" onclick="removeConfigOption(this)" class="absolute top-4 right-4 text-red-500 hover:text-red-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Option Name <span class="text-red-500">*</span></label>
                    <input type="text" name="config_options[${index}][option_name]" value="${option.option_name}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., Binding" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Option Type <span class="text-red-500">*</span></label>
                    <select name="config_options[${index}][option_type]" class="option-type-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="button" ${option.option_type === 'button' ? 'selected' : ''}>Button Group</option>
                        <option value="tabs" ${option.option_type === 'tabs' ? 'selected' : ''}>Tabs</option>
                        <option value="radio" ${option.option_type === 'radio' ? 'selected' : ''}>Radio Buttons</option>
                        <option value="select" ${option.option_type === 'select' ? 'selected' : ''}>Dropdown Select</option>
                        <option value="number" ${option.option_type === 'number' ? 'selected' : ''}>Number Input</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Value</label>
                    <input type="text" name="config_options[${index}][default_value]" value="${option.default_value || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Default">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="config_options[${index}][display_order]" value="${option.display_order || 0}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="0">
                </div>
                <div class="flex items-center pt-7">
                    <input type="checkbox" name="config_options[${index}][is_required]" value="1" ${option.is_required ? 'checked' : ''} class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label class="ml-2 text-sm font-medium text-gray-700">Required</label>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Option Values & Prices <span class="text-red-500">*</span></label>
                    <button type="button" onclick="addOptionValue(this)" class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Value
                    </button>
                </div>
                <div class="option-values-container space-y-2">
                    ${valuesHtml}
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', optionHtml);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\services\products\edit.blade.php ENDPATH**/ ?>