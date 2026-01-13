/**
 * Toast Notification System
 */

export function showToast(message, type = 'success', title = '') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');

    const isSuccess = type === 'success';
    const toastClass = isSuccess ? 'toast-success' : 'toast-error';
    const defaultTitle = isSuccess ? 'Success!' : 'Error!';
    const displayTitle = title || defaultTitle;

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

    setTimeout(() => {
        if (toast.parentElement) {
            toast.remove();
        }
    }, 5000);
}

// Initialize toast from session/errors on page load
export function initializeToasts() {
    // This function will be called with data passed from blade template
    // via data attributes or window object
    if (window.toastData) {
        const { success, error, errors } = window.toastData;
        
        if (success) {
            showToast(success, 'success');
        }
        
        if (error) {
            showToast(error, 'error');
        }
        
        if (errors && errors.length) {
            errors.forEach(err => {
                showToast(err, 'error', 'Validation Error');
            });
        }
    }
}
