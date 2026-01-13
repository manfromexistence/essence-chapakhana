<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all scale-95 opacity-0" id="deleteModalContent">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Confirm Deletion</h3>
                    <p class="text-sm text-gray-500 mt-0.5">This action cannot be undone</p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <p class="text-gray-600 leading-relaxed" id="deleteModalMessage">
                Are you sure you want to delete this item? All data associated with it will be permanently removed from the system.
            </p>
        </div>

        <!-- Footer -->
        <div class="p-6 bg-gray-50 rounded-b-2xl flex gap-3 justify-end">
            <button type="button" onclick="closeDeleteModal()" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all">
                Cancel
            </button>
            <button type="button" id="confirmDeleteBtn" class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 transition-all">
                Delete
            </button>
        </div>
    </div>
</div>

<style>
    #deleteModal.show {
        display: flex !important;
    }

    #deleteModal.show #deleteModalContent {
        animation: modalFadeIn 0.3s ease-out forwards;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        to {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
    }
</style>

<script>
    let deleteFormToSubmit = null;

    function showDeleteModal(form, message = null) {
        deleteFormToSubmit = form;
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        const messageElement = document.getElementById('deleteModalMessage');

        if (message) {
            messageElement.textContent = message;
        } else {
            messageElement.textContent = 'Are you sure you want to delete this item? All data associated with it will be permanently removed from the system.';
        }

        modal.classList.remove('hidden');
        modal.classList.add('show');

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');

        modalContent.style.animation = 'modalFadeOut 0.3s ease-out forwards';

        setTimeout(() => {
            modal.classList.remove('show');
            modal.classList.add('hidden');
            modalContent.style.animation = '';
            deleteFormToSubmit = null;
            document.body.style.overflow = '';
        }, 300);
    }

    // Confirm delete button
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (deleteFormToSubmit) {
                    deleteFormToSubmit.submit();
                }
                closeDeleteModal();
            });
        }

        // Close modal on outside click
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeDeleteModal();
                }
            });
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                closeDeleteModal();
            }
        });
    });
</script>
