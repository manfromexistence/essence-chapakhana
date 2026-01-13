import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set up CSRF token for all axios requests
// This runs after DOM is ready since it's imported in app.jsx which runs after DOM load
const setupCsrfToken = () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
    }
};

// Try to set up immediately
setupCsrfToken();

// Also set up when DOM is ready (in case this runs before DOM is fully loaded)
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupCsrfToken);
}
