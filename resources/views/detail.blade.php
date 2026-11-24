@extends('layouts.store')

@section('title', $product->brand.' '.$product->name.' — JT Ponsel')

@section('header')
    <x-site-header active="products" />
@endsection

@push('styles')
    @vite(['resources/css/detail.css'])
@endpush

@section('content')
    <main class="mx-auto max-w-7xl px-5 py-10 md:px-10">
        <a class="inline-flex items-center gap-3 text-sm font-semibold text-white/75 hover:text-white" href="{{ route('products.index') }}">
            <span aria-hidden="true">←</span>
            Back to products
        </a>

        <article class="mt-6 grid overflow-hidden rounded-2xl border border-white/10 bg-white/[.04] md:grid-cols-2">
            <div class="grid min-h-80 place-items-center bg-white p-8 md:min-h-[34rem]">
                <img class="h-full max-h-[34rem] w-full object-contain" src="{{ $product->image_url }}" alt="{{ $product->brand }} {{ $product->name }}" referrerpolicy="no-referrer">
            </div>

            <div class="flex flex-col justify-center p-6 md:p-10">
                <div class="flex flex-wrap items-center gap-3">
                    <p class="text-sm font-semibold uppercase tracking-[.16em] text-white/65">{{ $product->brand }}</p>
                    @if ($product->badge)
                        <span class="rounded-full bg-blue-500/15 px-3 py-1 text-xs font-semibold text-blue-200">{{ $product->badge }}</span>
                    @endif
                </div>
                <h1 class="mt-3 text-3xl font-bold tracking-tight md:text-5xl">{{ $product->name }}</h1>
                <p class="mt-3 text-sm text-white/55">SKU: {{ $product->sku }}</p>
                <p class="mt-7 text-3xl font-bold text-blue-300">{{ $product->formatted_price }}</p>
                <p class="mt-3 text-sm {{ $product->stock > 0 ? 'text-emerald-300' : 'text-red-300' }}">
                    {{ $product->stock > 0 ? $product->stock.' in stock' : 'Currently out of stock' }}
                </p>

                @if ($errors->has('quantity'))
                    <p class="mt-4 rounded-lg border border-red-400/30 bg-red-950/50 p-3 text-sm text-red-100" role="alert">{{ $errors->first('quantity') }}</p>
                @endif

                <form class="mt-7 flex flex-wrap items-end gap-4" action="{{ route('cart.store', $product) }}" method="post">
                    @csrf
                    <label class="flex flex-col gap-2 text-sm font-semibold text-white/80">
                        Quantity
                        <input class="w-28 rounded-lg border border-white/20 bg-black/30 px-3 py-3 text-white" name="quantity" type="number" min="1" max="{{ min($product->stock, 99) }}" value="{{ old('quantity', 1) }}" @disabled($product->stock < 1) required>
                    </label>
                    <button class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-500 disabled:cursor-not-allowed disabled:opacity-50" type="submit" @disabled($product->stock < 1)>
                        Add to cart
                    </button>
                    <a class="rounded-lg border border-white/20 px-6 py-3 font-semibold text-white/85 transition hover:bg-white/10" href="{{ route('cart.index') }}">View cart</a>
                </form>

                <section class="mt-10 border-t border-white/10 pt-7">
                    <h2 class="text-xl font-bold">Description</h2>
                    <p class="mt-3 leading-relaxed text-white/75">{{ $product->description ?: 'Product details will be added soon.' }}</p>
                </section>

                <section class="mt-8">
                    <h2 class="text-xl font-bold">Specifications</h2>
                    <dl class="mt-4 grid grid-cols-[auto_1fr] gap-x-8 gap-y-3 rounded-xl border border-white/10 bg-black/20 p-5 text-sm">
                        <dt class="text-white/55">Category</dt>
                        <dd class="capitalize">{{ $product->category }}</dd>
                        <dt class="text-white/55">Brand</dt>
                        <dd>{{ $product->brand }}</dd>
                        <dt class="text-white/55">SKU</dt>
                        <dd>{{ $product->sku }}</dd>
                        <dt class="text-white/55">Availability</dt>
                        <dd>{{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}</dd>
                    </dl>
                </section>
            </div>
        </article>
    </main>
@endsection
