@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Create Product</h1>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product title" required>
                    @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-800 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="format" class="block text-sm font-semibold text-gray-800 mb-2">Format <span class="text-red-500">*</span></label>
                    <input type="text" name="format" id="format" value="{{ old('format') }}" placeholder="e.g., Paperback, Hardback" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                    @error('format')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-800 mb-2">Price <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">$</span>
                        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" class="mt-1 block w-full pl-8 pr-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="0.00" required>
                    </div>
                    @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="block text-sm font-semibold text-gray-800 mb-2">Rating (0-5)</label>
                    <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" value="{{ old('rating', 4.5) }}" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="4.5">
                    @error('rating')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="popularity" class="block text-sm font-semibold text-gray-800 mb-2">Popularity (0-100)</label>
                    <input type="number" name="popularity" id="popularity" min="0" max="100" value="{{ old('popularity', 75) }}" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="75">
                    @error('popularity')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="badge" class="block text-sm font-semibold text-gray-800 mb-2">Badge</label>
                    <input type="text" name="badge" id="badge" value="{{ old('badge') }}" placeholder="e.g., New, Bestseller" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                    @error('badge')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" placeholder="Enter product description" required>{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label for="image" class="block text-sm font-semibold text-gray-800 mb-2">Product Image <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <input type="file" name="image" id="image" accept="image/*" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" onchange="previewImage(event, 'imagePreview')" required>
                        <p class="mt-2 text-xs text-gray-500">Accepted formats: JPG, PNG, GIF, WEBP (Max: 5MB)</p>
                    </div>
                    @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview -->
                    <div id="imagePreviewContainer" class="mt-4 hidden">
                        <p class="text-xs font-medium text-gray-700 mb-2">Image Preview:</p>
                        <div class="relative inline-block">
                            <img id="imagePreview" src="" alt="Preview" class="w-48 h-48 object-cover rounded-lg shadow-md border-2 border-gray-200">
                            <button type="button" onclick="clearImage('image', 'imagePreview')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 space-y-3">
                <p class="text-sm font-semibold text-gray-800 mb-3">Status Options</p>
                <div class="flex items-center">
                    <input type="checkbox" name="stock" id="stock" value="1" {{ old('stock', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="stock" class="ml-3 text-sm font-medium text-gray-700">In Stock</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-2 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Create Product</button>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    const container = document.getElementById(previewId + 'Container');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function clearImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const container = document.getElementById(previewId + 'Container');

    input.value = '';
    preview.src = '';
    container.classList.add('hidden');
}
</script>
@endpush
