@extends('layouts.store')

@section('title', 'Riwayat Pesanan — JT Ponsel')

@push('styles')
    @vite(['resources/css/Riwayat-Pesanan.css'])
@endpush

@section('header')
    <x-site-header active="orders" />
@endsection

@section('content')

        @php
            $orders = [
                [
                    'id'     => 'JT-20261102-001',
                    'date'   => '02 Nov 2026',
                    'status' => 'Selesai',
                    'name'   => 'Iphone 17 Pro Max',
                    'qty'    => 1,
                    'price'  => 17000000,
                    'image'  => null, // isi alamat gambar jika ada
                ],
            ];

            $warnaStatus = [
                'Selesai'  => 'bg-green-400',
                'Dikirim'  => 'bg-blue-400',
                'Diproses' => 'bg-yellow-400',
            ];
        @endphp

        <main class="mx-auto max-w-6xl px-4 py-10">

            <section class="rounded-2xl border-2 border-neutral-600 bg-neutral-900 p-8 shadow-2xl">

                <h1 class="judul-halaman text-4xl text-white">Riwayat Pesanan</h1>
                <p class="mt-1 text-sm font-semibold text-neutral-400">Daftar transaksi gadget yang telah Anda beli di JT Ponsel.</p>
                <hr class="my-6 border-white">

                @forelse ($orders as $order)
                    <article class="mb-4 rounded-2xl bg-neutral-50 p-8 text-black">

                        {{-- Baris atas: nomor, tanggal, status --}}
                        <div class="flex items-start justify-between gap-4 text-xs">
                            <p>No. Transaksi: {{ $order['id'] }}</p>
                            <p>Tanggal: {{ $order['date'] }}</p>
                            <span class="rounded-full px-3 py-1 font-bold {{ $warnaStatus[$order['status']] ?? 'bg-gray-300' }}">
                                {{ $order['status'] }}
                            </span>
                        </div>

                        {{-- Baris tengah: foto, nama barang, harga --}}
                        <div class="mt-8 flex items-center gap-6">
                            @if ($order['image'])
                                <img src="{{ $order['image'] }}" alt="{{ $order['name'] }}" class="h-20 w-20 rounded-xl bg-gray-200 object-contain">
                            @else
                                {{-- Kotak abu-abu pengganti foto --}}
                                <div class="h-20 w-20 rounded-xl bg-gray-300"></div>
                            @endif

                            <div class="flex-1">
                                <h2 class="text-base font-bold">{{ $order['name'] }}</h2>
                                <p class="text-xs font-semibold text-gray-400">
                                    {{ $order['qty'] }} Barang x Rp{{ number_format($order['price'], 0, ',', '.') }}
                                </p>
                            </div>

                            <p class="font-bold">Rp{{ number_format($order['price'] * $order['qty'], 0, ',', '.') }}</p>
                        </div>

                        <div class="mt-4 flex justify-end gap-2">
                            <button type="button" class="rounded bg-gray-300 px-3 py-1 text-xs font-bold hover:bg-gray-400">Lacak Resi</button>
                            <a href="{{ route('products.index') }}" class="rounded bg-gray-300 px-3 py-1 text-xs font-bold hover:bg-gray-400">Beli Lagi</a>
                        </div>
                    </article>
                @empty
                    <p class="py-10 text-center text-neutral-400">Belum ada pesanan.</p>
                @endforelse

            </section>
        </main>
@endsection