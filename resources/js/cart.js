let quantity = 1;

const qtyElement = document.getElementById('qty');
const btnTambah = document.getElementById('btnTambah');
const btnKurang = document.getElementById('btnKurang');

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