<?php $__env->startSection('title', 'Shop Hero Section | Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Shop Hero Section</h1>
        <p class="text-gray-500">Manage the hero section of the shop page.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 max-w-4xl">
        <form action="<?php echo e(route('admin.shop-hero.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle (Uppercase)</label>
                    <input type="text" id="subtitle" name="subtitle" value="<?php echo e(old('subtitle', $hero->subtitle)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Main Title</label>
                    <input type="text" id="title" name="title" value="<?php echo e(old('title', $hero->title)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?php echo e(old('description', $hero->description)); ?></textarea>
                </div>
            </div>

            <!-- Cover Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                <div class="space-y-3">
                    <?php if($hero->cover_image): ?>
                        <div class="relative w-full h-56 rounded-xl overflow-hidden border-2 border-gray-200">
                            <img src="<?php echo e($hero->cover_image); ?>" alt="Current Cover" class="w-full h-full object-cover">
                            <div class="absolute top-2 right-2">
                                <span class="inline-block px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">Current Image</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*" onchange="previewCoverImage(event)" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                        <p class="text-xs text-gray-500 mt-2">Upload a cover image for the shop hero section. Recommended size: 1920x600px. Max 10MB.</p>
                    </div>
                    <div id="preview-container" class="hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                        <div class="relative w-full h-56 rounded-xl overflow-hidden border-2 border-blue-300">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Badges -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Badges</label>
                <div id="badges-container" class="space-y-3">
                    <?php $__currentLoopData = $hero->badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex gap-2">
                        <input type="text" name="badges[]" value="<?php echo e($badge); ?>" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button type="button" onclick="addBadge()" class="mt-3 text-sm text-blue-600 font-semibold hover:text-blue-700 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Add Badge
                </button>
            </div>

            <hr class="border-gray-100">

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat 1 -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="font-bold text-gray-800 text-sm">Stat Card 1</p>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label</label>
                        <input type="text" name="stat1_label" value="<?php echo e($hero->stat1_label); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                        <input type="text" name="stat1_value" value="<?php echo e($hero->stat1_value); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Sub-label</label>
                        <input type="text" name="stat1_sublabel" value="<?php echo e($hero->stat1_sublabel); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="font-bold text-gray-800 text-sm">Stat Card 2</p>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label</label>
                        <input type="text" name="stat2_label" value="<?php echo e($hero->stat2_label); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                        <input type="text" name="stat2_value" value="<?php echo e($hero->stat2_value); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Sub-label</label>
                        <input type="text" name="stat2_sublabel" value="<?php echo e($hero->stat2_sublabel); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="font-bold text-gray-800 text-sm">Stat Card 3</p>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label</label>
                        <input type="text" name="stat3_label" value="<?php echo e($hero->stat3_label); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                        <input type="text" name="stat3_value" value="<?php echo e($hero->stat3_value); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Sub-label</label>
                        <input type="text" name="stat3_sublabel" value="<?php echo e($hero->stat3_sublabel); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="font-bold text-gray-800 text-sm">Stat Card 4</p>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label</label>
                        <input type="text" name="stat4_label" value="<?php echo e($hero->stat4_label); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                        <input type="text" name="stat4_value" value="<?php echo e($hero->stat4_value); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Sub-label</label>
                        <input type="text" name="stat4_sublabel" value="<?php echo e($hero->stat4_sublabel); ?>" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    Update Hero Section
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addBadge() {
    const container = document.getElementById('badges-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <input type="text" name="badges[]" value="" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    `;
    container.appendChild(div);
}

function previewCoverImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewContainer = document.getElementById('preview-container');
            const previewImg = document.getElementById('preview-img');
            
            previewImg.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Code\chapakhana\resources\views\admin\shop\hero\edit.blade.php ENDPATH**/ ?>