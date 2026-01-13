<?php $__env->startSection('title', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Category</h1>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <form action="<?php echo e(route('admin.categories.update', $category)); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $category->name)); ?>" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter category name" required>
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
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter category description (optional)"><?php echo e(old('description', $category->description)); ?></textarea>
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

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', $category->is_active) ? 'checked' : ''); ?> class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Active Status</label>
                </div>
                <p class="mt-2 ml-8 text-xs text-gray-500">Check to make this category visible on the shop page</p>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Update Category</button>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\categories\edit.blade.php ENDPATH**/ ?>