<?php $__env->startSection('title', 'Products Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Products Management</h1>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Product
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Format</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->title); ?>" class="w-12 h-12 rounded object-cover">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($product->title); ?></div>
                                <?php if($product->badge): ?>
                                <span class="text-xs text-gray-500"><?php echo e($product->badge); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($product->category->name); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($product->format); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">$<?php echo e(number_format($product->price, 2)); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600"><?php echo e(number_format($product->rating, 1)); ?> ★</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($product->stock ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo e($product->stock ? 'In Stock' : 'Out of Stock'); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="inline delete-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" onclick="showDeleteModal(this.closest('form'), 'Are you sure you want to delete this product?')" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No products found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\products\index.blade.php ENDPATH**/ ?>