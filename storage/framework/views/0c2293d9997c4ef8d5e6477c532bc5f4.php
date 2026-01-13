<?php $__env->startSection('title', 'Edit Checkout Field | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Field: <?php echo e($checkoutField->label); ?></h1>
            <p class="text-gray-500">Section: <?php echo e(ucfirst($checkoutField->section)); ?> | Key: <?php echo e($checkoutField->field_key); ?></p>
        </div>
        <a href="<?php echo e(route('admin.checkout-fields.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
            Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
        <form action="<?php echo e(route('admin.checkout-fields.update', $checkoutField)); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="label" class="block text-sm font-medium text-gray-700 mb-2">Label</label>
                    <input type="text" id="label" name="label" value="<?php echo e(old('label', $checkoutField->label)); ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="placeholder" class="block text-sm font-medium text-gray-700 mb-2">Placeholder</label>
                    <input type="text" id="placeholder" name="placeholder" value="<?php echo e(old('placeholder', $checkoutField->placeholder)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <?php $__errorArgs = ['placeholder'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="<?php echo e(old('sort_order', $checkoutField->sort_order)); ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex items-center gap-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_required" value="1" <?php echo e(old('is_required', $checkoutField->is_required) ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 font-medium">Is Required?</span>
                    </label>

                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_visible" value="1" <?php echo e(old('is_visible', $checkoutField->is_visible) ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 font-medium">Is Visible?</span>
                    </label>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Update Field
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\shop\checkout-fields\edit.blade.php ENDPATH**/ ?>