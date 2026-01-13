<?php $__env->startSection('title', 'Service Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Service Products</h1>
            <p class="text-gray-500">Manage service products</p>
        </div>
        <a href="<?php echo e(route('admin.service-products.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add Product
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($product->image): ?>
                            <?php if(str_starts_with($product->image, 'http://') || str_starts_with($product->image, 'https://')): ?>
                                <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>" class="w-12 h-12 object-cover rounded">
                            <?php else: ?>
                                <img src="<?php echo e(asset('uploads/service-products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-12 h-12 object-cover rounded">
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900"><?php echo e($product->name); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-500"><?php echo e($product->category?->name ?? 'N/A'); ?></span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-900">৳ <?php echo e(number_format($product->price, 2)); ?></span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo e($product->is_active ? 'Active' : 'Inactive'); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?php echo e(route('admin.service-products.edit', $product)); ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="<?php echo e(route('admin.service-products.destroy', $product)); ?>" method="POST" class="inline delete-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" onclick="showDeleteModal(this.closest('form'), 'Are you sure you want to delete this service product?')" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No service products found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($products->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\services\products\index.blade.php ENDPATH**/ ?>