<?php $__env->startSection('title', ($productTitle ?? 'Business Card') . ' | Chapakhana'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                        <a href="/" class="hover:text-blue-600">হোম</a>
                        <span>/</span>
                        <a href="/business-cards" class="hover:text-blue-600">বিজনেস কার্ড</a>
                        <span>/</span>
                        <span class="text-gray-900 font-medium"><?php echo e($productTitle ?? 'বিজনেস কার্ড কনফিগারেশন'); ?></span>
                    </nav>
                    
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6"><?php echo e($productTitle ?? 'Custom Business Card Printing'); ?></h1>
                    <p class="text-lg text-gray-700 mb-8">Create professional business cards that make a lasting impression. Choose from various paper types, finishes, and printing options.</p>
                    
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Premium Quality</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Fast Turnaround</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Multiple Finishes</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                        <img src="<?php echo e($productImage ?? 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800'); ?>" alt="<?php echo e($productTitle ?? 'Business Card'); ?> Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Configuration Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Configure your product and get a quote</h2>
                <p class="text-lg text-gray-600">Select your options below</p>
            </div>
            
            <form id="addToCartForm" action="<?php echo e(route('cart.add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="service_product" value="1">
                <input type="hidden" name="title" value="<?php echo e($productTitle ?? 'Business Card'); ?>">
                <input type="hidden" name="category" value="<?php echo e($category ?? 'business-cards'); ?>">
                <input type="hidden" name="product_type" value="<?php echo e($productType ?? 'business-card'); ?>">
                <input type="hidden" name="image" value="<?php echo e($productImage ?? ''); ?>">
                <input type="hidden" name="price" id="cartPrice" value="25.00">
                <input type="hidden" name="configurations" id="cartConfigurations" value="{}">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Configuration Options -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Shape -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-6">Shape</h3>
                        <button type="button" data-category="shape" data-price="0.00" class="shape-option border-2 border-blue-600 bg-blue-50 rounded-lg p-6 text-center hover:shadow-md transition inline-block">
                            <div class="w-48 h-32 mx-auto mb-4 bg-white rounded border-2 border-blue-600 flex items-center justify-center">
                                <div class="w-28 h-16 border-2 border-gray-400 rounded flex items-center justify-center">
                                    <span class="text-xs text-gray-500">3.5" x 2"</span>
                                </div>
                            </div>
                            <div class="text-base font-bold text-blue-600">Standard 3.5" x 2"</div>
                        </button>
                    </div>

                    <!-- Orientation -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-6">Orientation</h3>
                        <button type="button" data-category="orientation" data-price="0.00" class="orientation-option border-2 border-blue-600 bg-blue-50 rounded-lg p-6 text-center hover:shadow-md transition inline-block">
                            <div class="w-48 h-32 mx-auto mb-4 bg-white rounded border-2 border-blue-600 flex items-center justify-center">
                                <svg class="w-32 h-20 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <rect x="3" y="6" width="18" height="12" rx="1"/>
                                    <line x1="6" y1="9" x2="6" y2="15"/>
                                    <line x1="10" y1="9" x2="10" y2="15"/>
                                    <line x1="14" y1="9" x2="14" y2="12"/>
                                    <circle cx="18" cy="13" r="1.5" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="text-base font-bold text-blue-600">Horizontal</div>
                        </button>
                    </div>

                    <!-- Printed Side -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Printed Side</h3>
                        <div class="relative">
                            <select id="printedSideSelect" data-category="printed-side" data-price="0.00" class="w-full px-6 py-4 pr-12 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base font-medium text-blue-600 bg-white appearance-none">
                                <option value="front-only" data-price="0.00" selected>Front Only</option>
                                <option value="both-sides" data-price="5.00">Both Sides</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Paper Type -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Paper Type</h3>
                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                            <div class="grid grid-cols-3 bg-gray-100">
                                <button class="paper-tab px-4 py-3 text-sm font-semibold text-gray-900 bg-white" data-tab="standard">Standard</button>
                                <button class="paper-tab px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-200 transition" data-tab="premium">Premium</button>
                                <button class="paper-tab px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-200 transition" data-tab="premium-plus">Premium Plus</button>
                            </div>
                            <div class="p-6">
                                <!-- Standard Tab Content -->
                                <div class="tab-content" data-tab-content="standard">
                                    <div class="space-y-4">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="radio" name="paper_type" value="14pt-matte" checked data-category="paper" data-price="0.00" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <div class="flex-1 flex items-center justify-between">
                                                <span class="text-base font-semibold text-blue-600">14pt Matte</span>
                                                <button type="button" class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="radio" name="paper_type" value="14pt-uncoated" data-category="paper" data-price="0.00" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <div class="flex-1 flex items-center justify-between">
                                                <span class="text-base font-semibold text-blue-600">14pt Uncoated</span>
                                                <button type="button" class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Premium Tab Content -->
                                <div class="tab-content hidden" data-tab-content="premium">
                                    <div class="space-y-4">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="radio" name="paper_type" value="14pt-glossy" data-category="paper" data-price="3.00" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <div class="flex-1 flex items-center justify-between">
                                                <span class="text-base font-semibold text-blue-600">14pt Glossy</span>
                                                <button type="button" class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Premium Plus Tab Content -->
                                <div class="tab-content hidden" data-tab-content="premium-plus">
                                    <div class="space-y-4">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="radio" name="paper_type" value="16pt-silk" data-category="paper" data-price="5.00" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <div class="flex-1 flex items-center justify-between">
                                                <span class="text-base font-semibold text-blue-600">16pt Silk</span>
                                                <button type="button" class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item Name -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Item name</h3>
                        <input type="text" placeholder="Name this print job" class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base placeholder-gray-400">
                    </div>

                    <!-- Select price and delivery date -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Select price and delivery date</h3>
                    </div>

                    <!-- Custom quantity -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Custom quantity</h3>
                        <input type="number" name="quantity" id="quantityInput" value="100" min="50" step="50" class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base font-medium text-blue-600">
                    </div>
                </div>

                <!-- Right Column - Price Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800 text-white rounded-lg overflow-hidden sticky top-24">
                        <!-- Header Tabs -->
                        <div class="grid grid-cols-2 border-b border-gray-700">
                            <button class="px-4 py-3 bg-gray-700 font-semibold text-sm hover:bg-gray-600">Job recap</button>
                            <button class="px-4 py-3 font-semibold text-sm hover:bg-gray-700">Job quotation</button>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="space-y-4 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Quantity</span>
                                    <span class="font-semibold">100</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Estimated delivery date</span>
                                    <span class="font-semibold">01/14</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Net price</span>
                                    <span id="netPrice" class="font-semibold">$25.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Shipping costs</span>
                                    <span class="text-gray-400">Calculated at checkout</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Sales Tax</span>
                                    <span class="text-gray-400">Calculated at checkout</span>
                                </div>
                                
                                <div class="border-t border-gray-700 pt-4 flex justify-between">
                                    <span class="font-semibold">Total quote</span>
                                    <span id="totalQuote" class="text-lg font-bold text-green-400">$25.00</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-full flex items-center justify-center gap-2 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                                </svg>
                                ADD TO BASKET
                            </button>

                            <p class="text-xs text-gray-400 mt-4">
                                • Free delivery on orders over $50<br>
                                • Estimated delivery: 3-5 working days<br>
                                • 100% satisfaction guaranteed
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>

    <script>
        // Price aggregation
        document.addEventListener('DOMContentLoaded', () => {
            const netPriceEl = document.getElementById('netPrice');
            const totalQuoteEl = document.getElementById('totalQuote');
            const cartPriceInput = document.getElementById('cartPrice');
            const cartConfigInput = document.getElementById('cartConfigurations');

            const priceState = {
                shape: 0.00,
                orientation: 0.00,
                printedSide: 0.00,
                paper: 0.00,
            };

            const configState = {};

            let quantity = 100;
            const basePrice = 0.25; // Base price per card

            function format(val) {
                return `$${val.toFixed(2)}`;
            }

            function updateDisplay() {
                const optionsTotal = Object.values(priceState).reduce((a, b) => a + b, 0);
                const total = (basePrice + optionsTotal) * quantity;
                if (netPriceEl) netPriceEl.textContent = format(total);
                if (totalQuoteEl) totalQuoteEl.textContent = format(total);
                
                // Update hidden form fields
                if (cartPriceInput) cartPriceInput.value = total.toFixed(2);
                if (cartConfigInput) cartConfigInput.value = JSON.stringify(configState);
            }

            // Deselect all siblings and select the clicked button
            function selectOption(btn, cat) {
                const siblings = document.querySelectorAll(`button[data-category="${cat}"]`);
                siblings.forEach(sib => {
                    sib.classList.remove('border-2', 'border-blue-600', 'bg-blue-50', 'shadow-md');
                    sib.classList.add('border', 'border-gray-300', 'bg-white');
                });
                btn.classList.remove('border', 'border-gray-300', 'bg-white');
                btn.classList.add('border-2', 'border-blue-600', 'bg-blue-50', 'shadow-md');
            }

            // Handle button clicks
            function wireButtons() {
                const buttons = document.querySelectorAll('button[data-category][data-price]');
                buttons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        const cat = btn.dataset.category;
                        const price = parseFloat(btn.dataset.price || '0');

                        if (cat) {
                            selectOption(btn, cat);
                            priceState[cat] = price;
                            // Track selected option text
                            const optionText = btn.querySelector('div:last-child')?.textContent?.trim() || btn.textContent?.trim() || cat;
                            configState[cat] = optionText;
                            updateDisplay();
                        }
                    });
                });
            }

            // Printed Side select
            const printedSideSelect = document.getElementById('printedSideSelect');
            if (printedSideSelect) {
                printedSideSelect.addEventListener('change', (e) => {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    priceState.printedSide = parseFloat(selectedOption.dataset.price) || 0;
                    configState.printedSide = selectedOption.textContent.trim();
                    updateDisplay();
                });
            }

            // Paper Type tabs
            const paperTabs = document.querySelectorAll('.paper-tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            paperTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const tabName = tab.dataset.tab;
                    
                    paperTabs.forEach(t => {
                        t.classList.remove('bg-white', 'text-gray-900', 'font-semibold');
                        t.classList.add('text-gray-600', 'font-medium');
                    });
                    tab.classList.add('bg-white', 'text-gray-900', 'font-semibold');
                    tab.classList.remove('text-gray-600', 'font-medium');
                    
                    tabContents.forEach(content => {
                        if (content.dataset.tabContent === tabName) {
                            content.classList.remove('hidden');
                        } else {
                            content.classList.add('hidden');
                        }
                    });
                });
            });

            // Radio buttons
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    const cat = e.target.dataset.category;
                    const price = parseFloat(e.target.dataset.price);
                    if (cat && !isNaN(price)) {
                        priceState[cat] = price;
                        // Track selected option text
                        const label = e.target.closest('label');
                        configState[cat] = label?.querySelector('span')?.textContent?.trim() || e.target.value;
                        updateDisplay();
                        
                        // Highlight the selected radio's label
                        const radioGroup = document.querySelectorAll(`input[name="${e.target.name}"]`);
                        radioGroup.forEach(r => {
                            const label = r.closest('label');
                            if (label) {
                                if (r.checked) {
                                    label.classList.add('bg-blue-50', 'rounded-lg');
                                } else {
                                    label.classList.remove('bg-blue-50', 'rounded-lg');
                                }
                            }
                        });
                    }
                });
            });

            // Quantity input
            const quantityInput = document.getElementById('quantityInput');
            if (quantityInput) {
                quantityInput.addEventListener('input', (e) => {
                    quantity = parseInt(e.target.value) || 100;
                    configState.quantity = quantity;
                    updateDisplay();
                });
            }

            // Initialize
            wireButtons();
            
            // Initialize preselected buttons
            document.querySelectorAll('button.border-blue-600[data-category][data-price], button.border-2[data-category][data-price]').forEach(btn => {
                const cat = btn.dataset.category;
                const price = parseFloat(btn.dataset.price || '0');
                if (cat) {
                    priceState[cat] = price;
                    const optionText = btn.querySelector('div:last-child')?.textContent?.trim() || btn.textContent?.trim() || cat;
                    configState[cat] = optionText;
                }
            });

            // Initialize preselected radios
            document.querySelectorAll('input[type="radio"]:checked').forEach(r => {
                const cat = r.dataset.category;
                const price = parseFloat(r.dataset.price || '0');
                if (cat) {
                    priceState[cat] = price;
                    const label = r.closest('label');
                    configState[cat] = label?.querySelector('span')?.textContent?.trim() || r.value;
                }
            });

            // Initialize select
            if (printedSideSelect) {
                const selectedOption = printedSideSelect.options[printedSideSelect.selectedIndex];
                configState.printedSide = selectedOption.textContent.trim();
            }

            // Initialize quantity
            configState.quantity = quantity;

            updateDisplay();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\products\configure\business-card.blade.php ENDPATH**/ ?>