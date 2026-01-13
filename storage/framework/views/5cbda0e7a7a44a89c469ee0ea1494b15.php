<?php $__env->startSection('title', 'Shopping Cart | Chapakhana'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <h1 class="text-3xl sm:text-4xl font-bold">Shopping Cart</h1>
            <p class="text-slate-300 mt-2">Review your items and proceed to checkout</p>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if($errors->any()): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-red-800 font-semibold">Error</p>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-red-700 text-sm"><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if(count($cart) > 0): ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            <?php echo e(count($cart)); ?> <?php echo e(count($cart) == 1 ? 'item' : 'items'); ?> in your cart
                        </h2>

                        <div class="space-y-4">
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productKey => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article class="flex gap-6 border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" class="w-24 h-24 object-cover rounded-lg bg-gray-100">
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900"><?php echo e($item['title']); ?></h3>
                                                <p class="text-sm text-gray-600"><?php echo e($item['desc']); ?></p>
                                            </div>
                                            <p class="text-xl font-bold text-gray-900">৳<?php echo e(number_format($item['price'], 2)); ?></p>
                                        </div>

                                        <div class="flex items-center gap-2 mb-3 text-xs text-gray-600">
                                            <span class="rounded-full bg-gray-100 px-2 py-1"><?php echo e($item['format']); ?></span>
                                            <span class="rounded-full bg-blue-50 text-blue-700 px-2 py-1"><?php echo e(ucfirst($item['category'])); ?></span>
                                            <span class="flex items-center gap-1">
                                                <span class="font-semibold text-yellow-500"><?php echo e(number_format($item['rating'], 1)); ?></span>
                                                <span class="text-yellow-500">★</span>
                                            </span>
                                        </div>

                                        <!-- Quantity and Actions -->
                                        <div class="flex items-center justify-between">
                                            <form action="<?php echo e(route('cart.update')); ?>" method="POST" class="flex items-center gap-2">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="product_key" value="<?php echo e($productKey); ?>">
                                                <button type="button" onclick="decrementQuantity(this)" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-50">−</button>
                                                <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" class="w-12 text-center border border-gray-300 rounded py-1" onchange="this.form.submit()">
                                                <button type="button" onclick="incrementQuantity(this)" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-50">+</button>
                                            </form>

                                            <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="hidden" name="product_key" value="<?php echo e($productKey); ?>">
                                                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="text-right text-sm text-gray-600 mt-2">
                                            Subtotal: <span class="font-semibold text-gray-900">৳<?php echo e(number_format($item['price'] * $item['quantity'], 2)); ?></span>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Continue Shopping Button -->
                        <div class="mt-6">
                            <a href="/shop" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 sticky top-4">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h2>

                            <div class="space-y-3 border-b border-gray-200 pb-4 mb-4">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal (<?php echo e(count($cart)); ?> <?php echo e(count($cart) == 1 ? 'item' : 'items'); ?>)</span>
                                    <span class="font-semibold text-gray-900">$<?php echo e(number_format($subtotal, 2)); ?></span>
                                </div>

                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Shipping</span>
                                    <span class="font-semibold text-green-600">Free</span>
                                </div>

                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Tax (8%)</span>
                                    <span class="font-semibold text-gray-900">৳<?php echo e(number_format($tax, 2)); ?></span>
                                </div>
                            </div>

                            <div class="flex justify-between mb-6">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-red-600">৳<?php echo e(number_format($total, 2)); ?></span>
                            </div>

                            <a href="<?php echo e(route('checkout.index')); ?>" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2-8m-10 8h12m0 0h2m-2 0v2m0-2v-2"/>
                                </svg>
                                Proceed to Checkout
                            </a>

                            <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded-lg border border-gray-300 transition-colors duration-200">
                                    Clear Cart
                                </button>
                            </form>

                            <p class="text-xs text-gray-500 mt-4 text-center">
                                Secure checkout powered by Stripe
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Empty Cart -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2-8m-10 8h12m0 0h2m-2 0v2m0-2v-2"/>
                    </svg>

                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-600 mb-6">Start shopping to add items to your cart</p>

                    <a href="/shop" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\cart\index.blade.php ENDPATH**/ ?>