// Carousel and Slider Functions
export function scrollBestSellers(direction) {
    const container = document.getElementById('bestSellersContainer');
    if (!container) return;
    const scrollAmount = 300;
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

export function scrollProductItems(direction) {
    const container = document.getElementById('productItemsContainer');
    if (!container) return;
    const scrollAmount = 280;
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

export function scrollDisplaySigns(direction) {
    const container = document.getElementById('displaySignsContainer');
    if (!container) return;
    const scrollAmount = 300;
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

export function initializeSliders() {
    const scrollContainers = document.querySelectorAll('[id$="Container"]');
    scrollContainers.forEach(container => {
        let isDown = false;
        let startX;
        let scrollLeft;
        
        container.addEventListener('mousedown', (e) => {
            isDown = true;
            container.classList.add('cursor-grabbing');
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });
        
        container.addEventListener('mouseleave', () => {
            isDown = false;
            container.classList.remove('cursor-grabbing');
        });
        
        container.addEventListener('mouseup', () => {
            isDown = false;
            container.classList.remove('cursor-grabbing');
        });
        
        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2;
            container.scrollLeft = scrollLeft - walk;
        });
    });
}
