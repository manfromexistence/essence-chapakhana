<?php $__env->startSection('title', 'Create Service Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="<?php echo e(route('admin.service-products.index')); ?>" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Create Service Product</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Sidebar - Service Category Details -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Service Details</h3>
                
                <div id="serviceCategoryDetails" class="space-y-4">
                    <div class="text-center py-8 text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-sm">Select a category to view details</p>
                    </div>
                </div>

                <!-- Quick Options Management -->
                <div id="quickOptionsSection" class="hidden mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Quick Add Options</h4>
                    <div class="space-y-2">
                        <button type="button" onclick="addQuickOption('Binding', 'button')" class="w-full text-left px-3 py-2 text-sm bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition">
                            + Add Binding Option
                        </button>
                        <button type="button" onclick="addQuickOption('Paper Type', 'select')" class="w-full text-left px-3 py-2 text-sm bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition">
                            + Add Paper Type
                        </button>
                        <button type="button" onclick="addQuickOption('Size', 'button')" class="w-full text-left px-3 py-2 text-sm bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg transition">
                            + Add Size Option
                        </button>
                        <button type="button" onclick="addQuickOption('Quantity', 'number')" class="w-full text-left px-3 py-2 text-sm bg-orange-50 hover:bg-orange-100 text-orange-700 rounded-lg transition">
                            + Add Quantity
                        </button>
                    </div>
                </div>

                <!-- Category Statistics -->
                <div id="categoryStats" class="hidden mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Category Info</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Products:</span>
                            <span id="totalProducts" class="font-semibold text-gray-900">0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Active Products:</span>
                            <span id="activeProducts" class="font-semibold text-green-600">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Content -->
        <div class="lg:col-span-9">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <form action="<?php echo e(route('admin.service-products.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6" id="serviceProductForm">
            <?php echo csrf_field(); ?>

            <div>
                <label for="service_category_id" class="block text-sm font-semibold text-gray-800 mb-2">Service Category <span class="text-red-500">*</span></label>
                <select name="service_category_id" id="service_category_id" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                    <option value="">Select a category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('service_category_id') == $category->id ? 'selected' : ''); ?>>
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
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product name" required>
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
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product description (optional)"><?php echo e(old('description')); ?></textarea>
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
                <label for="price" class="block text-sm font-semibold text-gray-800 mb-2">Base Price (৳) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" value="<?php echo e(old('price')); ?>" step="0.01" min="0" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="0.00" required>
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
                <div id="imagePreview" class="mb-3 hidden">
                    <img id="previewImg" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                    <p class="text-sm text-gray-500 mt-1">Image preview</p>
                </div>
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" onchange="previewImage(event)">
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
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', true) ? 'checked' : ''); ?> class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
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
                    <p class="text-gray-500 text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">No configuration options added yet. Click "Add Option" to create customization options for this product.</p>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Create Product</button>
                <a href="<?php echo e(route('admin.service-products.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>

<script>
// Category data for sidebar
const categoryData = <?php echo json_encode($categories->mapWithKeys(function($cat) {
    return [$cat->id => [
        'name' => $cat->name,
        'slug' => $cat->slug,
        'description' => $cat->description ?? 'No description available',
        'products_count' => $cat->products_count ?? 0,
        'icon' => $cat->icon ?? '📦',
    ]];
})); ?>;

// Update sidebar when category is selected
document.getElementById('service_category_id').addEventListener('change', function() {
    const categoryId = this.value;
    const detailsContainer = document.getElementById('serviceCategoryDetails');
    const quickOptions = document.getElementById('quickOptionsSection');
    const categoryStats = document.getElementById('categoryStats');
    
    if (categoryId && categoryData[categoryId]) {
        const category = categoryData[categoryId];
        
        detailsContainer.innerHTML = `
            <div class="text-center mb-4">
                <div class="text-4xl mb-2">${category.icon}</div>
                <h4 class="font-bold text-gray-900">${category.name}</h4>
                <p class="text-xs text-gray-500 mt-1">${category.slug}</p>
            </div>
            <div class="bg-gray-50 p-3 rounded-lg">
                <p class="text-sm text-gray-600">${category.description}</p>
            </div>
        `;
        
        // Show quick options and stats
        quickOptions.classList.remove('hidden');
        categoryStats.classList.remove('hidden');
        
        // Update stats
        document.getElementById('totalProducts').textContent = category.products_count;
        document.getElementById('activeProducts').textContent = category.products_count;
    } else {
        detailsContainer.innerHTML = `
            <div class="text-center py-8 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-sm">Select a category to view details</p>
            </div>
        `;
        quickOptions.classList.add('hidden');
        categoryStats.classList.add('hidden');
    }
});

// Quick option function
function addQuickOption(optionName, optionType) {
    const optionData = {
        option_name: optionName,
        option_type: optionType
    };
    
    // Add to the config options
    addConfigOption(optionData);
}
</script>

<script src="<?php echo e(asset('js/service-product-config.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\services\products\create.blade.php ENDPATH**/ ?>