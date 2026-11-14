# JT Ponsel

JT Ponsel adalah aplikasi katalog dan toko online untuk smartphone, earphone, dan aksesori. Pengunjung dapat melihat produk, mengelola keranjang, lalu membuat pesanan untuk diambil di toko. Admin dapat mengelola katalog, stok, dan status pesanan.

## Fitur

- Beranda, katalog, dan halaman detail produk dari database.
- Keranjang belanja dengan pemeriksaan stok dan harga terbaru saat checkout.
- Checkout sebagai tamu atau pelanggan terdaftar, khusus pengambilan di toko.
- Pembayaran di toko saat pengambilan berfungsi. Pembayaran online hanya placeholder dan tidak mengumpulkan data kartu.
- Riwayat dan detail pesanan untuk pelanggan yang masuk.
- Dashboard admin untuk membuat, mengubah, menyembunyikan, dan menghapus produk serta memproses pesanan.
- Stok berkurang saat pesanan dibuat dan dipulihkan jika pesanan dibatalkan.
- Tampilan Blade responsif dengan Tailwind CSS.

## Teknologi

- PHP 8.3 atau lebih baru dan Laravel 13.
- SQLite sebagai konfigurasi database lokal bawaan; MySQL dapat digunakan dengan mengubah konfigurasi `.env`.
- Blade, Tailwind CSS 4, Vite 8, dan JavaScript.
- Pest 5 untuk pengujian.

## Instalasi

Pastikan PHP beserta ekstensi PDO SQLite, Composer, Node.js, dan npm tersedia. Dari direktori proyek jalankan:

```bash
composer run setup
```

Skrip setup memasang dependensi, menyiapkan `.env`, membuat application key dan database SQLite, menjalankan migrasi serta seeder, lalu membangun aset frontend.

Untuk konfigurasi database selain SQLite, ubah nilai `DB_CONNECTION` dan variabel `DB_*` di `.env` sebelum menjalankan migrasi. Jangan pernah mengunggah `.env` atau kredensial ke Git.

### Menyiapkan akun admin

Atur `ADMIN_NAME`, `ADMIN_EMAIL`, dan `ADMIN_PASSWORD` di `.env` menggunakan kredensial yang aman. Kemudian jalankan:

```bash
php artisan db:seed --class=AdminSeeder --force
```

Seeder tidak membuat akun admin jika email atau kata sandi belum diisi. Kredensial admin tidak disediakan di repositori.

### Menjalankan aplikasi

```bash
composer run dev
```

Perintah tersebut menjalankan server Laravel, worker antrean, dan Vite. Buka alamat lokal yang ditampilkan oleh server.

## Cara menggunakan

1. Jelajahi katalog dan buka detail produk untuk melihat harga dan ketersediaan.
2. Tambahkan produk ke keranjang dan perbarui jumlah sesuai stok.
3. Isi informasi kontak di checkout, pilih **Pay at pickup**, lalu buat pesanan.
4. Simpan nomor pesanan untuk melihat konfirmasi. Pelanggan yang masuk juga dapat melihat riwayat pesanan di akun.
5. Untuk admin, masuk menggunakan akun yang disiapkan di atas dan buka `/admin` untuk mengelola produk serta memproses pesanan.

Pesanan dimulai dengan status menunggu, lalu admin dapat menandainya siap diambil, selesai, atau dibatalkan. Pesanan yang selesai menandai pembayaran di toko sebagai lunas; pembatalan mengembalikan stok. Pemrosesan kartu dan pembayaran online belum tersedia.

## Struktur aplikasi

- `routes/web.php` mendefinisikan rute bernama untuk katalog, autentikasi, keranjang, checkout, akun, dan admin.
- `app/Http/Controllers` menangani permintaan web; validasi input berada di `app/Http/Requests`.
- `app/Actions` berisi proses pembuatan pesanan transaksional dan perubahan status pesanan.
- `app/Models` memetakan produk, pesanan, item pesanan, dan pengguna beserta relasinya.
- `database/migrations`, `database/factories`, dan `database/seeders` mengelola skema serta data awal.
- `resources/views` berisi halaman dan komponen Blade; `resources/css` dan `resources/js` berisi aset frontend.
- `tests/Feature` mencakup alur belanja, akun, katalog admin, stok, dan pesanan.

## Pengujian dan aset

Jalankan pengujian:

```bash
php artisan test --compact
```

Bangun aset untuk produksi:

```bash
npm run build
```

## Kontribusi

1. Buat branch dari `main` dengan nama yang menjelaskan perubahan, misalnya `feature/order-history`.
2. Ikuti konvensi Laravel dan pola yang sudah digunakan proyek; tambahkan atau perbarui pengujian untuk perubahan perilaku.
3. Jalankan pengujian dan build aset yang relevan sebelum membuka pull request.
4. Buat pull request dengan ringkasan perubahan, langkah pengujian, dan tangkapan layar untuk perubahan UI. Minta tinjauan sebelum menggabungkan perubahan.
5. Jangan sertakan file `.env`, kata sandi, token, atau data pelanggan dalam commit maupun pull request.

## Lisensi

Proyek ini menggunakan lisensi MIT. Lihat [LICENSE](LICENSE).
