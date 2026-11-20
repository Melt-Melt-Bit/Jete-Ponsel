@extends('layouts.store')

@section('title', 'Profile - JT Ponsel')

@push('styles')
    @vite(['resources/css/profile.css'])
@endpush

@section('header')
    <x-site-header active="profile" />
@endsection

@section('content')

    <main class="mt-14 ml-25 flex flex-row gap-10">

    <!-- Sidebar -->
        <section>
            <div class="flex flex-row gap-4 items-center">
                <img src="{{ Vite::asset('resources/images/profile.png') }}" alt="Lewis Winchester">
                <div>
                    <h1 class="text-sm">{{ auth()->user()->name }}</h1>
                    <p class="text-gray-200 text-xs">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-4 border border-white w-60 px-5 py-5 rounded-md pb-49">
                <div class="gap-4 flex flex-row items-center">
                    <img src="{{ Vite::asset('resources/images/people.png') }}" alt="">
                    <a href="{{ route('profile') }}">Data Diri</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="{{ Vite::asset('resources/images/address.png') }}" alt="">
                    <a href="{{ route('incomplete') }}">Alamat</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="{{ Vite::asset('resources/images/shop.png') }}" alt="">
                    <a class="{{ $section === 'orders' ? 'text-blue-400' : '' }}" href="{{ route('profile', ['section' => 'orders']) }}">Riwayat Pesanan</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="{{ Vite::asset('resources/images/voucher.png') }}" alt="">
                    <a href="{{ route('incomplete') }}">Voucher Saya</a>
                </div>
                <div class="gap-4 flex flex-row">
                    <img src="{{ Vite::asset('resources/images/Safe.png') }}" alt="">
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('incomplete') }}">Keamanan</a>
                        <div class="text-sm flex flex-col gap-0.5 ml-2 text-gray-200">
                            <a href="{{ route('incomplete') }}">Password</a>
                            <a href="{{ route('incomplete') }}">Passkey</a>
                            <a href="{{ route('incomplete') }}">Email Pemulihan</a>
                        </div>
                    </div>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="{{ Vite::asset('resources/images/Notif.png') }}" alt="">
                    <a href="{{ route('incomplete') }}" class="text-sm">Notifikasi</a>
                </div>
                <div class="gap-4 flex flex-row items-center">
                    <img src="{{ Vite::asset('resources/images/Exit.png') }}" alt="">
                    @auth
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="text-sm text-red-500">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-red-500">Masuk</a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Data Diri -->
        <section>
            <div class="border border-white w-200 px-12 py-5 rounded-md pb-12 ml-38 ">
                @if ($section === 'orders')
                    <h1>Riwayat Pesanan</h1>
                    <p class="text-gray-200">Lihat pesanan dan status pengambilan Anda.</p>
                    <hr class="mt-4">
                    <div class="mt-6 flex flex-col gap-4">
                        @forelse ($orders as $order)
                            <a class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-white/20 bg-white/5 p-5 hover:bg-white/10" href="{{ route('account.orders.show', $order) }}">
                                <div>
                                    <p class="font-semibold">{{ $order->order_number }}</p>
                                    <p class="mt-1 text-sm text-gray-200">{{ $order->created_at->format('d M Y, H:i') }} · {{ $order->items->count() }} item(s)</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold">{{ $order->formatted_total }}</p>
                                    <p class="mt-1 text-sm capitalize text-gray-200">{{ str_replace('_', ' ', $order->status) }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="rounded-xl border border-white/20 p-6 text-gray-200">Anda belum memiliki pesanan.</p>
                        @endforelse
                    </div>
                    <div class="mt-6">{{ $orders->links() }}</div>
                @else
                <h1>Profil saya</h1>
                <p class="text-gray-200">kelola profil Anda untuk Mengontrol informasi pribadi Anda</p>
                <hr>

                <form action="#" method="POST" class="flex flex-col gap-8 mt-6">
                    @csrf
                    <div>
                        <img src="{{ Vite::asset('resources/images/profile.png') }}" alt="Profile preview">
                        <a href="{{ route('incomplete') }}" class="ml-38"> <u class="text-blue-500 underline">Pilih Gambar</u></a>
                    </div>
                    <div class="flex flex-row">
                        <label for="username">Username</label>
                        <div class="ml-19">
                            <input type="text" id="username" name="username" required
                                value="{{ auth()->user()->name }}"
                                class="border border-white-300 rounded-md px-3 py-1 w-120 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-200 mt-1">Username hanya dapat diubah 1 kali setiap 6 bulan</p>
                        </div>
                    </div>
                    <div>
                        <label for="full-name">Name</label>
                        <input type="text" id="full-name" name="name" required
                            value="{{ auth()->user()->name }}"
                            class="border border-white-300 rounded-md px-3 py-1 ml-26.5 w-120 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required
                            value="{{ auth()->user()->email }}"
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
                @endif
            </div>
        </section>
    </main>
@endsection