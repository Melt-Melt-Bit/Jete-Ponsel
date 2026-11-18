<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - JT Ponsel</title>
    @vite(['resources/css/profile.css', 'resources/js/profile.js'])
</head>

<body>
    <x-site-header active="profile" :cart-href="route('cart')" />

    <main class="mt-14 ml-25 flex flex-row gap-10">

    <!-- Sidebar -->
        <section>
            <div class="flex flex-row gap-4 items-center">
                <img src="/images/profile.png">
                <div>
                    <h1 class="text-sm">Lewis Winchester</h1>
                    <p class="text-gray-300 text-xs">lewiscwinchester@example.com</p>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-4 border border-white w-60 px-5 py-5 rounded-md pb-49">
                <div class="gap-4 flex flex-row items-center">
                    <img src="/images/people.png">
                    <a href="#">Data Diri</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="/images/address.png">
                    <a href="#">Alamat</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="/images/shop.png">
                    <a href="#">Riwayat Pesanan</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="/images/voucher.png">
                    <a href="#">Voucher Saya</a>
                </div>
                <div class="gap-4 flex flex-row">
                    <img src="/images/Safe.png">
                    <div class="flex flex-col gap-1">
                        <a href="#">Keamanan</a>
                        <div class="text-sm flex flex-col gap-0.5 ml-2 text-gray-300">
                            <a href="#">Password</a>
                            <a href="#">Passkey</a>
                            <a href="#">Email Pemulihan</a>
                        </div>
                    </div>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="/images/Notif.png">
                    <a href="#" class="text-sm">Notifikasi</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="/images/Exit.png">
                    <a href="#" class="text-sm">
                        <p class="text-red-500">Keluar</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Data Diri -->
        <section>
            <div class="border border-white w-200 px-12 py-5 rounded-md pb-12 ml-38 ">
                <h1>Profil saya</h1>
                <p>kelola profil Anda untuk Mengontrol informasi pribadi Anda</p>
                <hr>

                <form action="#" method="POST" class="flex flex-col gap-8 mt-6">
                    @csrf
                    <div>
                        <img src="profile.png" alt="">
                        <a href="#" class="ml-38"> <u class="text-blue-500 underline">Pilih Gambar</u></a>
                    </div>
                    <div class="flex flex-row">
                        <label for="name">Username</label>
                        <div class="ml-19">
                            <input type="text" id="name" name="name" required
                                class="border border-white-300 rounded-md px-3 py-1 w-120 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-300 mt-1">Username hanya dapat diubah 1 kali setiap 6 bulan</p>
                        </div>
                    </div>
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required
                            class="border border-white-300 rounded-md px-3 py-1 ml-26.5 w-120 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required
                            class="border border-white-300 rounded-md px-3 py-1 ml-27 w-120 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone"
                            class="border border-white-300 rounded-md px-3 py-1 ml-8.5 w-120 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="pr-6">Jenis Kelamin</span>
                        <label for="" class="flex items-center gap-2">
                            <input type="radio" name="gender" value="male" class="ml-3">
                            <span>Laki-laki</span>
                        </label>

                        <label for="" class="flex items-center gap-2">
                            <input type="radio" name="gender" value="female" class="">
                            <span>Perempuan</span>
                        </label>

                        <label for="" class="flex items-center gap-2">
                            <input type="radio" name="gender" value="Another" class="">
                            <span>Lainnya</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="mt-10 bg-white text-black py-2 px-4 rounded-md hover:bg-gray-200 max-w-60 ml-98">Simpan
                        Perubahan</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>