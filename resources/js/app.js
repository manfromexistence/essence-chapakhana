import './bootstrap';
import { showToast, initializeToasts } from './toast';
import { openProductDetail, closeProductDetail, incrementQty, decrementQty, initializeModals } from './modal';
import { incrementQuantity, decrementQuantity, updateCartCount, proceedToCheckout } from './cart';
import { scrollBestSellers, scrollProductItems, scrollDisplaySigns, initializeSliders } from './slider';

// Make functions globally available for inline onclick handlers
window.showToast = showToast;
window.openProductDetail = openProductDetail;
window.closeProductDetail = closeProductDetail;
window.incrementQty = incrementQty;
window.decrementQty = decrementQty;
window.incrementQuantity = incrementQuantity;
window.decrementQuantity = decrementQuantity;
window.updateCartCount = updateCartCount;
window.proceedToCheckout = proceedToCheckout;
window.scrollBestSellers = scrollBestSellers;
window.scrollProductItems = scrollProductItems;
window.scrollDisplaySigns = scrollDisplaySigns;

// Initialize all modules on page load
document.addEventListener('DOMContentLoaded', () => {
    initializeToasts();
    initializeModals();
    initializeSliders();
    updateCartCount(); // Update cart count on every page load
});
