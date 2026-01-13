<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> Chapakhana</title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <style>
        .sidebar-link {
            transition: all 0.2s;
        }
        .sidebar-link:hover {
            transform: translateX(4px);
        }
        .sidebar-link.active {
            background: linear-gradient(to right, #3B82F6, #2563EB);
        }

        <?php echo $__env->yieldContent('styles'); ?>
    </style>
</head>
<body class="bg-gray-50">
    <!-- Toast Container -->
    <div id="toast-container"></div>

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center">
                    <?php
                        $headerSection = \App\Models\PageSection::where('page', 'header')
                            ->where('section_key', 'main')
                            ->first();
                        $logo = $headerSection?->content['logo'] ?? null;
                    ?>
                    <?php if($logo): ?>
                        <img src="<?php echo e($logo); ?>" alt="<?php echo e(config('site.name')); ?>" class="h-10 w-auto">
                    <?php else: ?>
                        <img src="<?php echo e(asset('logo.png')); ?>" alt="<?php echo e(config('site.name')); ?>" class="h-10 w-auto">
                    <?php endif; ?>
                </a>
            </div>

            <div class="flex items-center gap-4">
                <a href="/" target="_blank" class="hidden md:flex items-center gap-2 text-gray-700 hover:text-gray-900 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>View Site</span>
                </a>

                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline text-sm text-gray-700 font-medium"><?php echo e(Auth::user()->name); ?></span>
                    <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <?php echo $__env->make('admin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <?php echo $__env->make('components.delete-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script>
        // Pass Laravel session data to JavaScript
        window.toastData = {
            success: <?php echo json_encode(session('success'), 15, 512) ?>,
            error: <?php echo json_encode(session('error'), 15, 512) ?>,
            errors: <?php echo json_encode($errors->all(), 15, 512) ?>
        };
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH F:\Code\chapakhana\resources\views\admin\layouts\app.blade.php ENDPATH**/ ?>