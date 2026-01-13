// Product Detail Modal Management
export function openProductDetail(product) {
    window.currentProduct = product;
    document.getElementById('modalProductTitle').textContent = product.title;
    document.getElementById('modalProductImage').src = product.image;
    document.getElementById('modalProductCategory').textContent = product.category;
    document.getElementById('modalProductDesc').textContent = product.desc;
    document.getElementById('modalProductRating').textContent = product.rating;
    document.getElementById('modalProductPrice').textContent = product.price.toFixed(2);
    document.getElementById('modalProductFormat').textContent = product.format;
    document.getElementById('orderQuantity').value = 1;
    document.getElementById('productDetailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

export function closeProductDetail() {
    document.getElementById('productDetailModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    window.currentProduct = null;
}

export function incrementQty() {
    const input = document.getElementById('orderQuantity');
    input.value = parseInt(input.value) + 1;
}

export function decrementQty() {
    const input = document.getElementById('orderQuantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

export function initializeModals() {
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeProductDetail();
        }
    });
    const modal = document.getElementById('productDetailModal');
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeProductDetail();
            }
        });
    }
}
