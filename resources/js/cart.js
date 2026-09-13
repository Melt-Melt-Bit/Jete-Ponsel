document.querySelectorAll('.Cart-Item').forEach((item) => {
    let quantity = 1;
    const qtyElement = item.querySelector('[id="qty"]');
    const btnTambah = item.querySelector('[id="btnTambah"]');
    const btnKurang = item.querySelector('[id="btnKurang"]');

    btnTambah.addEventListener('click', function () {
        quantity++;
        qtyElement.textContent = quantity;
    });

    btnKurang.addEventListener('click', function () {
        if (quantity > 1) {
            quantity--;
            qtyElement.textContent = quantity;
        }
    });
});