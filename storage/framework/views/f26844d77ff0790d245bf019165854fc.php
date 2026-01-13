<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Chapakhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Toast Notification Styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.4s ease-out, fadeOut 0.3s ease-in 4.7s forwards;
            backdrop-filter: blur(10px);
        }

        .toast-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .toast-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .toast-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 14px;
            opacity: 0.95;
        }

        .toast-close {
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .toast-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(400px);
            }
        }

        @media (max-width: 640px) {
            .toast {
                right: 10px;
                left: 10px;
                min-width: auto;
                max-width: none;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Toast Container -->
    <div id="toast-container"></div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Header -->
            <div class="text-center">
                <a href="/" class="inline-block mb-6">
                    <?php
                        $headerSection = \App\Models\PageSection::where('page', 'header')
                            ->where('section_key', 'main')
                            ->first();
                        $logo = $headerSection?->content['logo'] ?? '/logo.png';
                    ?>
                    <img src="<?php echo e($logo); ?>" alt="Chapakhana" class="h-16 w-auto mx-auto">
                </a>
                <h2 class="text-3xl font-bold text-gray-900">Admin Dashboard</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Sign in with your admin credentials
                </p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form class="space-y-6" action="<?php echo e(route('admin.login.post')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                value="<?php echo e(old('email')); ?>"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="admin@chapakhana.com"
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="••••••••"
                            >
                        </div>
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Keep me logged in
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-[1.02]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Sign in to Dashboard
                        </button>
                    </div>
                </form>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="/" class="text-sm text-blue-600 hover:text-blue-500 transition">
                        ← Back to Homepage
                    </a>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center text-xs text-gray-500">
                <p>🔒 This is a secure admin area</p>
            </div>
        </div>
    </div>

    <script>
        // Toast Notification Function
        function showToast(message, type = 'success', title = '') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const isSuccess = type === 'success';
            const toastClass = isSuccess ? 'toast-success' : 'toast-error';
            const defaultTitle = isSuccess ? 'Success!' : 'Error!';
            const displayTitle = title || defaultTitle;

            // Success icon
            const successIcon = `
                <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;

            // Error icon
            const errorIcon = `
                <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;

            toast.className = `toast ${toastClass}`;
            toast.innerHTML = `
                ${isSuccess ? successIcon : errorIcon}
                <div class="toast-content">
                    <div class="toast-title">${displayTitle}</div>
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
        }

        // Show toast on page load if there's a session message
        <?php if(session('success')): ?>
            showToast('<?php echo e(session('success')); ?>', 'success');
        <?php endif; ?>

        <?php if(session('error')): ?>
            showToast('<?php echo e(session('error')); ?>', 'error', 'Login Failed');
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                showToast('<?php echo e($error); ?>', 'error', 'Validation Error');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
</body>
</html>
<?php /**PATH F:\Code\chapakhana\resources\views\admin\login.blade.php ENDPATH**/ ?>