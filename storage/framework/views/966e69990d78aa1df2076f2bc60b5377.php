
<div id="productDetailModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-lg shadow-xl max-w-4xl w-full mx-auto">
            
            <button onclick="closeProductDetail()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    
                    <div>
                        <img id="modalProductImage" src="" alt="Product" class="w-full h-auto rounded-lg">
                    </div>

                    
                    <div>
                        <div class="mb-2">
                            <span id="modalProductCategory" class="text-sm text-gray-500"></span>
                        </div>
                        <h2 id="modalProductTitle" class="text-2xl font-bold text-gray-900 mb-4"></h2>
                        
                        <div class="flex items-center mb-4">
                            <span class="text-yellow-400 mr-2">★</span>
                            <span id="modalProductRating" class="font-semibold"></span>
                        </div>

                        <p id="modalProductDesc" class="text-gray-600 mb-4"></p>

                        <div class="mb-4">
                            <span class="text-sm text-gray-500">Format: </span>
                            <span id="modalProductFormat" class="font-semibold"></span>
                        </div>

                        <div class="text-3xl font-bold text-[#2e7c31] mb-6">
                            ৳<span id="modalProductPrice"></span>
                        </div>

                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <div class="flex items-center gap-3">
                                <button onclick="decrementQty()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">-</button>
                                <input type="number" id="orderQuantity" value="1" min="1" class="w-20 text-center border border-gray-300 rounded py-2">
                                <button onclick="incrementQty()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">+</button>
                            </div>
                        </div>

                        
                        <div class="flex gap-3">
                            <button onclick="window.addProductToCart(window.currentProduct, document.getElementById('orderQuantity').value)" class="flex-1 bg-[#2e7c31] hover:bg-[#f6c324] text-white font-bold py-3 px-6 rounded-lg transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    const modal = document.getElementById('productDetailModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeProductDetail();
            }
        });
    }
});
</script>

<!-- Product Detail Modal -->
<div id="productDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 flex items-center justify-between p-6 border-b border-gray-200 bg-white">
            <h2 id="modalProductTitle" class="text-2xl font-bold text-gray-900"></h2>
            <button onclick="closeProductDetail()" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">
                ✕
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-6">
            <!-- Product Image -->
            <div class="w-full h-96 bg-gray-100 rounded-lg overflow-hidden">
                <img id="modalProductImage" src="" alt="Product" class="w-full h-full object-cover">
            </div>

            <!-- Product Info -->
            <div class="space-y-4">
                <div class="flex items-start justify-between">
                    <div>
                        <p id="modalProductCategory" class="text-sm uppercase tracking-wide text-blue-600 font-semibold mb-2"></p>
                        <p id="modalProductDesc" class="text-gray-700 leading-relaxed"></p>
                    </div>
                    <div class="flex items-center gap-1">
                        <span id="modalProductRating" class="font-bold text-gray-900"></span>
                        <span class="text-yellow-500">★</span>
                    </div>
                </div>

                <!-- Price and Stock -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="text-3xl font-bold text-gray-900">
                        $<span id="modalProductPrice"></span>
                    </div>
                    <div class="space-x-2">
                        <span id="modalProductFormat" class="inline-block rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-700 font-medium"></span>
                        <span class="inline-block rounded-full bg-green-50 text-green-700 px-3 py-1 text-sm font-medium">In stock</span>
                    </div>
                </div>
            </div>

            <!-- Order Form -->
            <div class="bg-gray-50 p-6 rounded-lg space-y-4">
                <h3 class="font-bold text-gray-900 text-lg">Order Details</h3>

                <!-- Quantity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Quantity</label>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="decrementQty()" class="w-10 h-10 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center justify-center font-bold text-lg">−</button>
                        <input id="orderQuantity" type="number" value="1" min="1" class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center font-medium" readonly>
                        <button type="button" onclick="incrementQty()" class="w-10 h-10 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center justify-center font-bold text-lg">+</button>
                    </div>
                </div>


            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeProductDetail()" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="button" onclick="addProductToCart()" class="flex-1 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2-8m-10 8h12m0 0h2m-2 0v2m0-2v-2"></path>
                    </svg>
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH F:\Code\chapakhana\resources\views\partials\product-detail-modal.blade.php ENDPATH**/ ?>