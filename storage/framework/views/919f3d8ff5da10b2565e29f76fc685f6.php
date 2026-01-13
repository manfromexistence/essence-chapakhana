<?php $__env->startSection('title', 'Orders | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Order #</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Customer</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Total</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Date</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <span class="font-medium text-blue-600"><?php echo e($order->order_number); ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">
                            <p class="font-medium text-gray-900"><?php echo e($order->shipping_name); ?></p>
                            <p class="text-gray-500"><?php echo e($order->shipping_email); ?></p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700 font-semibold">
                        $<?php echo e(number_format($order->total, 2)); ?>

                    </td>
                    <td class="px-6 py-4">
                        <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <select name="status" onchange="this.form.submit()" class="text-xs px-2 py-1 rounded-full font-semibold <?php if($order->status == 'pending'): ?> bg-yellow-100 text-yellow-700 <?php elseif($order->status == 'processing'): ?> bg-blue-100 text-blue-700 <?php elseif($order->status == 'shipped'): ?> bg-purple-100 text-purple-700 <?php elseif($order->status == 'delivered'): ?> bg-green-100 text-green-700 <?php else: ?> bg-red-100 text-red-700 <?php endif; ?> border-none focus:ring-0">
                                <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                                <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                                <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                                <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <?php echo e($order->created_at->format('M d, Y')); ?>

                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <form action="<?php echo e(route('admin.orders.destroy', $order)); ?>" method="POST" class="delete-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="showDeleteModal(this.closest('form'), 'Are you sure you want to delete this order? This action cannot be undone.')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No orders found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($orders->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\shop\order.blade.php ENDPATH**/ ?>