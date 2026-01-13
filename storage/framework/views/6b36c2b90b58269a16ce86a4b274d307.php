<?php $__env->startSection('title', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
        <a href="<?php echo e(route('admin.products.index')); ?>" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title', $product->title)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product title" required>
                    <?php $__errorArgs = ['title'];
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
                    <label for="category_id" class="block text-sm font-semibold text-gray-800 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                        <option value="">Select Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
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
                    <label for="format" class="block text-sm font-semibold text-gray-800 mb-2">Format <span class="text-red-500">*</span></label>
                    <input type="text" name="format" id="format" value="<?php echo e(old('format', $product->format)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="e.g., Paperback, Hardback" required>
                    <?php $__errorArgs = ['format'];
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
                    <label for="price" class="block text-sm font-semibold text-gray-800 mb-2">Price <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">$</span>
                        <input type="number" name="price" id="price" step="0.01" min="0" value="<?php echo e(old('price', $product->price)); ?>" class="mt-1 block w-full pl-8 pr-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="0.00" required>
                    </div>
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
                    <label for="rating" class="block text-sm font-semibold text-gray-800 mb-2">Rating (0-5)</label>
                    <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" value="<?php echo e(old('rating', $product->rating)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="4.5">
                    <?php $__errorArgs = ['rating'];
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
                    <label for="popularity" class="block text-sm font-semibold text-gray-800 mb-2">Popularity (0-100)</label>
                    <input type="number" name="popularity" id="popularity" min="0" max="100" value="<?php echo e(old('popularity', $product->popularity)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="75">
                    <?php $__errorArgs = ['popularity'];
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
                    <label for="badge" class="block text-sm font-semibold text-gray-800 mb-2">Badge</label>
                    <input type="text" name="badge" id="badge" value="<?php echo e(old('badge', $product->badge)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="e.g., New, Bestseller">
                    <?php $__errorArgs = ['badge'];
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

                <div class="col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product description" required><?php echo e(old('description', $product->description)); ?></textarea>
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

                <div class="col-span-2">
                    <label for="image" class="block text-sm font-semibold text-gray-800 mb-2">Product Image</label>
                    <div class="mt-1">
                        <input type="file" name="image" id="image" accept="image/*" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" onchange="previewImage(event, 'imagePreview')">
                        <p class="mt-2 text-xs text-gray-500">Leave empty to keep current image. Accepted formats: JPG, PNG, GIF, WEBP (Max: 5MB)</p>
                    </div>
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

                    <?php if($product->image): ?>
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs font-medium text-gray-700 mb-3">Current Image:</p>
                        <img src="<?php echo e(asset($product->image)); ?>" alt="Current product image" class="w-48 h-48 object-cover rounded-lg shadow-md border-2 border-gray-200">
                    </div>
                    <?php endif; ?>

                    <!-- New Image Preview -->
                    <div id="imagePreviewContainer" class="mt-4 hidden">
                        <p class="text-xs font-medium text-gray-700 mb-2">New Image Preview:</p>
                        <div class="relative inline-block">
                            <img id="imagePreview" src="" alt="Preview" class="w-48 h-48 object-cover rounded-lg shadow-md border-2 border-gray-200">
                            <button type="button" onclick="clearImage('image', 'imagePreview')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 space-y-3">
                <p class="text-sm font-semibold text-gray-800 mb-3">Status Options</p>
                <div class="flex items-center">
                    <input type="checkbox" name="stock" id="stock" value="1" <?php echo e(old('stock', $product->stock) ? 'checked' : ''); ?> class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="stock" class="ml-3 text-sm font-medium text-gray-700">In Stock</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?> class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Update Product</button>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewImage(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    const container = document.getElementById(previewId + 'Container');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function clearImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const container = document.getElementById(previewId + 'Container');

    input.value = '';
    preview.src = '';
    container.classList.add('hidden');
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\products\edit.blade.php ENDPATH**/ ?>