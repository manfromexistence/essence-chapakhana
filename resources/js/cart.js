// Cart Management Functions
export function incrementQuantity(button) {
    const input = button.parentElement.querySelector('input[type="number"]');
    input.value = parseInt(input.value) + 1;
    input.dispatchEvent(new Event('change'));
}

export function decrementQuantity(button) {
    const input = button.parentElement.querySelector('input[type="number"]');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        input.dispatchEvent(new Event('change'));
    }
}

export function updateCartCount() {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.basket-count');
            if (badge) {
                badge.textContent = data.count;
            }
        })
        .catch(error => console.error('Error updating cart count:', error));
}

export function proceedToCheckout() {
    window.location.href = '/checkout';
}
