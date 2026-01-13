// Service Product Configuration Options Manager
let configOptionIndex = 0;

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        if (!document.getElementById('previewImg').src || document.getElementById('previewImg').src.includes('data:')) {
            document.getElementById('imagePreview').classList.add('hidden');
        }
    }
}

function addConfigOption() {
    const container = document.getElementById('configOptionsContainer');
    
    // Remove the "no options" message if it exists
    const emptyMessage = container.querySelector('p.text-gray-500');
    if (emptyMessage) {
        emptyMessage.remove();
    }

    const optionHtml = `
        <div class="config-option-item bg-white border-2 border-gray-200 rounded-lg p-6 relative" data-index="${configOptionIndex}">
            <button type="button" onclick="removeConfigOption(this)" class="absolute top-4 right-4 text-red-500 hover:text-red-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Option Name <span class="text-red-500">*</span></label>
                    <input type="text" name="config_options[${configOptionIndex}][option_name]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., Binding" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Option Type <span class="text-red-500">*</span></label>
                    <select name="config_options[${configOptionIndex}][option_type]" class="option-type-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="button">Button Group</option>
                        <option value="tabs">Tabs</option>
                        <option value="radio">Radio Buttons</option>
                        <option value="select">Dropdown Select</option>
                        <option value="number">Number Input</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Value</label>
                    <input type="text" name="config_options[${configOptionIndex}][default_value]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Default">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="config_options[${configOptionIndex}][display_order]" value="${configOptionIndex}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="0">
                </div>
                <div class="flex items-center pt-7">
                    <input type="checkbox" name="config_options[${configOptionIndex}][is_required]" value="1" checked class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label class="ml-2 text-sm font-medium text-gray-700">Required</label>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Option Values & Prices <span class="text-red-500">*</span></label>
                    <button type="button" onclick="addOptionValue(this)" class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Value
                    </button>
                </div>
                <div class="option-values-container space-y-2">
                    <div class="flex gap-2 items-center option-value-row">
                        <input type="text" name="config_options[${configOptionIndex}][option_values][]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Value name" required>
                        <input type="number" name="config_options[${configOptionIndex}][option_prices][]" value="0" step="0.01" class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Price (৳)">
                        <button type="button" onclick="removeOptionValue(this)" class="text-red-500 hover:text-red-700 p-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', optionHtml);
    configOptionIndex++;
}

function removeConfigOption(button) {
    const item = button.closest('.config-option-item');
    item.remove();
    
    // Show empty message if no options left
    const container = document.getElementById('configOptionsContainer');
    if (container.querySelectorAll('.config-option-item').length === 0) {
        container.innerHTML = '<p class="text-gray-500 text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">No configuration options added yet. Click "Add Option" to create customization options for this product.</p>';
    }
}

function addOptionValue(button) {
    const container = button.closest('.bg-gray-50').querySelector('.option-values-container');
    const optionItem = button.closest('.config-option-item');
    const index = optionItem.dataset.index;

    const valueHtml = `
        <div class="flex gap-2 items-center option-value-row">
            <input type="text" name="config_options[${index}][option_values][]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Value name" required>
            <input type="number" name="config_options[${index}][option_prices][]" value="0" step="0.01" class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Price (৳)">
            <button type="button" onclick="removeOptionValue(this)" class="text-red-500 hover:text-red-700 p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', valueHtml);
}

function removeOptionValue(button) {
    const row = button.closest('.option-value-row');
    const container = row.closest('.option-values-container');
    
    // Only remove if there's more than one value
    if (container.querySelectorAll('.option-value-row').length > 1) {
        row.remove();
    } else {
        alert('At least one value is required for each option.');
    }
}
