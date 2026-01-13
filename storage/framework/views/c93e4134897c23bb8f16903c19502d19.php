<?php $__env->startSection('title', 'Checkout Fields | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Checkout Form Fields</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Sort</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Section</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Label</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Key</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Required</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Visible</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <?php echo e($field->sort_order); ?>

                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-xs uppercase font-bold">
                            <?php echo e($field->section); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        <?php echo e($field->label); ?>

                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <?php echo e($field->field_key); ?>

                    </td>
                    <td class="px-6 py-4 text-sm">
                        <?php if($field->is_required): ?>
                            <span class="text-green-600">Yes</span>
                        <?php else: ?>
                            <span class="text-gray-400">No</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <?php if($field->is_visible): ?>
                            <span class="text-blue-600 font-medium">Visible</span>
                        <?php else: ?>
                            <span class="text-red-400">Hidden</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo e(route('admin.checkout-fields.edit', $field)); ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition inline-block">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\shop\checkout-fields\index.blade.php ENDPATH**/ ?>