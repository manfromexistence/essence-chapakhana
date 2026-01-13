<?php $__env->startSection('title', 'Order Details | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Order <?php echo e($order->order_number); ?></h1>
            <p class="text-gray-500">Placed on <?php echo e($order->created_at->format('M d, Y \a\t h:i A')); ?></p>
        </div>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
            Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="font-bold text-gray-800">Order Items</h2>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Product</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Price</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if($item->product_image): ?>
                                    <img src="<?php echo e(asset($item->product_image)); ?>" alt="<?php echo e($item->product_title); ?>" class="w-12 h-12 object-cover rounded-lg">
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo e($item->product_title); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($item->format); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <?php echo e($item->quantity); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                ৳<?php echo e(number_format($item->price, 2)); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-semibold text-right">
                                ৳<?php echo e(number_format($item->price * $item->quantity, 2)); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-col items-end space-y-2">
                        <div class="flex justify-between w-full max-w-xs">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium text-gray-900">৳<?php echo e(number_format($order->subtotal, 2)); ?></span>
                        </div>
                        <div class="flex justify-between w-full max-w-xs">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium text-gray-900">৳<?php echo e(number_format($order->tax, 2)); ?></span>
                        </div>
                        <div class="flex justify-between w-full max-w-xs border-t border-gray-300 pt-2">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-lg font-bold text-blue-600">৳<?php echo e(number_format($order->total, 2)); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="font-bold text-gray-800">Shipping Details</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Customer Name</p>
                        <p class="text-gray-900"><?php echo e($order->shipping_name); ?></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Email Address</p>
                        <p class="text-gray-900"><?php echo e($order->shipping_email); ?></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Phone Number</p>
                        <p class="text-gray-900"><?php echo e($order->shipping_phone); ?></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Payment Method</p>
                        <p class="text-gray-900"><?php echo e(ucfirst(str_replace('_', ' ', $order->payment_method))); ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Shipping Address</p>
                        <p class="text-gray-900">
                            <?php echo e($order->shipping_address); ?><br>
                            <?php echo e($order->shipping_city); ?>, <?php echo e($order->shipping_state); ?> <?php echo e($order->shipping_zip); ?><br>
                            <?php echo e($order->shipping_country); ?>

                        </p>
                    </div>
                    <?php if($order->notes): ?>
                    <div class="md:col-span-2">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Order Notes</p>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200 italic">
                            "<?php echo e($order->notes); ?>"
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="font-bold text-gray-800 mb-4">Order Status</h2>
                <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Current Status</label>
                        <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                            <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                            <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                            <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\shop\order-details.blade.php ENDPATH**/ ?>