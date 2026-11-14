const productImages = import.meta.glob('../images/**/*.{png,jpg,jpeg,webp}', {
    eager: true,
    import: 'default',
    query: '?url',
});

document.querySelectorAll('[data-image-path]').forEach((input) => {
    const preview = document.querySelector(`[data-image-preview="${input.dataset.imagePath}"]`);

    if (!preview) {
        return;
    }

    const updatePreview = () => {
        const imagePath = input.value.replace(/^resources\/images\//, '../images/');
        const imageUrl = productImages[imagePath];

        preview.src = typeof imageUrl === 'string' ? imageUrl : '';
        preview.hidden = typeof imageUrl !== 'string';
    };

    input.addEventListener('input', updatePreview);
    updatePreview();
});
