const searchInput = document.querySelector('.product-search input');
const productCards = [...document.querySelectorAll('[data-product-card]')];
const emptyMessage = document.querySelector('.empty-products');

searchInput?.addEventListener('input', (event) => {
    const query = event.target.value.trim().toLowerCase();
    let visibleProducts = 0;

    productCards.forEach((card) => {
        const isMatch = card.textContent.toLowerCase().includes(query);
        card.hidden = !isMatch;
        visibleProducts += isMatch ? 1 : 0;
    });

    if (emptyMessage) {
        emptyMessage.hidden = visibleProducts > 0;
    }
});

document.querySelectorAll('[data-wishlist]').forEach((button) => {
    button.addEventListener('click', () => {
        const isSelected = button.getAttribute('aria-pressed') === 'true';
        button.setAttribute('aria-pressed', String(!isSelected));
        button.textContent = isSelected ? '♡' : '♥';
    });
});
