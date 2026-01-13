<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php
        $siteName = \App\Models\SiteSetting::get('site_name', config('site.name', 'Chapakhana'));
        $favicon = \App\Models\SiteSetting::get('favicon', '/favicon.ico');
    ?>
    <title><?php echo $__env->yieldContent('title', $siteName . ' - Professional Printing Services in Bangladesh'); ?></title>

    
    <link rel="icon" href="<?php echo e($favicon); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e($favicon); ?>" type="image/x-icon">

    
    <meta name="description"
        content="<?php echo $__env->yieldContent('description', 'Professional printing services for books, magazines, catalogs, business cards, banners, and more. Fast delivery across Bangladesh.'); ?>">
    <meta name="keywords" content="printing, books, magazines, catalogs, business cards, banners, Bangladesh, চাপাখানা">
    <meta name="author" content="<?php echo e($siteName); ?>">

    
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', $siteName); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description', 'Professional printing services in Bangladesh'); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('images/og-default.jpg')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e($siteName); ?>">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', $siteName); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('description', 'Professional printing services'); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('images/og-default.jpg')); ?>">

    
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body class="bg-white antialiased">
    <!-- Toast Container -->
    <div id="toast-container"></div>

    <div class="sticky top-0 z-50 bg-white shadow-sm">
        <?php echo $__env->yieldContent('header'); ?>
    </div>
    <main class="w-full min-h-screen">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php echo $__env->yieldContent('footer'); ?>

    <script>
        // Pass Laravel session data to JavaScript
        window.toastData = {
            success: <?php echo json_encode(session('success'), 15, 512) ?>,
            error: <?php echo json_encode(session('error'), 15, 512) ?>,
            errors: <?php echo json_encode($errors->all(), 15, 512) ?>
        };

        // Dynamic cart count update function
        window.updateCartCount = function () {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const countElements = document.querySelectorAll('.basket-count');
                    countElements.forEach(el => {
                        el.textContent = data.count || '0';
                    });
                })
                .catch(error => console.error('Failed to update cart count:', error));
        };

        // Toast notification function
        window.showToast = function (message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            const isSuccess = type === 'success';
            
            // Use the CSS classes from toast.css for consistent styling
            toast.className = `toast ${isSuccess ? 'toast-success' : 'toast-error'}`;
            
            const successIcon = `
                <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;
            
            const errorIcon = `
                <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;
            
            toast.innerHTML = `
                ${isSuccess ? successIcon : errorIcon}
                <div class="toast-content">
                    <div class="toast-title">${isSuccess ? 'Success!' : 'Error!'}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 5000);
        };

        // Show toast on page load if there are session messages
        document.addEventListener('DOMContentLoaded', function () {
            if (window.toastData.success) {
                showToast(window.toastData.success, 'success');
            }
            if (window.toastData.error) {
                showToast(window.toastData.error, 'error');
            }
            if (window.toastData.errors && window.toastData.errors.length > 0) {
                window.toastData.errors.forEach(error => showToast(error, 'error'));
            }
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH F:\Code\chapakhana\resources\views/layouts/app.blade.php ENDPATH**/ ?>