@extends('layouts.store')

@section('title', 'Products — JT Ponsel')

@section('header')
    <x-site-header active="products" />
@endsection

@push('styles')
    @vite(['resources/css/featured-product.css'])
@endpush

@push('scripts')
    @vite(['resources/js/featured-product.js'])
@endpush

@section('content')
    <main class="mx-auto max-w-7xl px-5 py-10 md:px-10">
        <section class="featured-hero mb-12 flex min-h-64 items-center justify-between gap-8 overflow-hidden rounded-2xl bg-white px-7 py-10 text-slate-950 md:px-12">
            <div>
                <p class="featured-kicker">JT PONSEL / CURATED COLLECTION</p>
                <h1 class="text-5xl font-bold md:text-7xl">Featured<br><span>Products</span></h1>
                <p class="mt-5 max-w-xl text-slate-600">Temukan perangkat pilihan dan aksesori terbaik untuk melengkapi gaya hidup digitalmu.</p>
            </div>
            <div class="hero-orbit hidden md:block" aria-hidden="true">
                <span class="orbit-label">NEW ARRIVALS</span>
                <div class="orbit-circle"></div>
                <span class="orbit-cross">✳</span>
            </div>
        </section>

        <section id="products">
            <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                <div>
                    <p class="featured-kicker">HANDPICKED FOR YOU / 01</p>
                    <h2 class="text-3xl font-bold">{{ $category ? ucfirst($category) : 'Recommended products' }}</h2>
                </div>
                <label class="product-search flex w-full max-w-md items-center gap-3 rounded-lg border border-white/20 px-4 py-3">
                    <span aria-hidden="true">⌕</span>
                    <input class="w-full bg-transparent outline-none" type="search" placeholder="Search products or brands..." aria-label="Search products">
                </label>
            </div>

            <nav class="mb-8 flex flex-wrap gap-3 text-sm" aria-label="Filter products">
                <a class="rounded-full border border-white/25 px-4 py-2 hover:bg-white/10" href="{{ route('products.index') }}">All</a>
                <a class="rounded-full border border-white/25 px-4 py-2 hover:bg-white/10" href="{{ route('products.index', ['category' => 'phone']) }}">Phones</a>
                <a class="rounded-full border border-white/25 px-4 py-2 hover:bg-white/10" href="{{ route('products.index', ['category' => 'earphone']) }}">Earphones</a>
                <a class="rounded-full border border-white/25 px-4 py-2 hover:bg-white/10" href="{{ route('products.index', ['category' => 'accessory']) }}">Accessories</a>
            </nav>

            <div class="product-grid grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3" id="product-grid">
                @forelse ($products as $product)
                    <div data-product-card>
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <p class="rounded-xl border border-white/10 p-6 text-white/70">There are no products in this collection yet.</p>
                @endforelse
            </div>
            <p class="empty-products mt-6 text-center text-white/70" hidden>No products match your search.</p>
        </section>
    </main>

    <footer class="border-t border-white/10 px-5 py-8 text-center text-sm text-white/60">
        <p>© {{ now()->year }} JT Ponsel. Product prices are shown in Indonesian rupiah.</p>
    </footer>
@endsection
