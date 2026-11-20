@extends('layouts.store')

@section('title', $product->brand.' '.$product->name.' — JT Ponsel')

@section('header')
    <x-site-header active="products" />
@endsection

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 md:px-8">
        <a class="mb-8 inline-flex items-center gap-3 text-sm font-semibold text-white/70 hover:text-white" href="{{ route('products.index') }}">
            <span aria-hidden="true">←</span> All products
        </a>
        <article class="grid overflow-hidden rounded-2xl border border-white/10 bg-white text-slate-950 md:grid-cols-2">
            <div class="grid min-h-80 place-items-center bg-slate-100 p-8 md:min-h-[34rem]">
                <img class="max-h-[30rem] w-full object-contain" src="{{ $product->image_url }}" alt="{{ $product->brand }} {{ $product->name }}">
            </div>
            <div class="flex flex-col justify-center p-7 md:p-12">
                <p class="text-sm font-bold uppercase tracking-[.2em] text-blue-700">{{ $product->brand }} · {{ ucfirst($product->category) }}</p>
                <h1 class="mt-3 text-3xl font-bold md:text-4xl">{{ $product->name }}</h1>
                <p class="mt-5 text-2xl font-semibold">{{ $product->formatted_price }}</p>
                <p class="mt-3 text-sm {{ $product->stock > 0 ? 'text-emerald-700' : 'text-red-700' }}">
                    {{ $product->stock > 0 ? $product->stock.' available' : 'Out of stock' }}
                </p>
                <p class="mt-8 leading-7 text-slate-700">{{ $product->description ?: 'Contact our store for more product information.' }}</p>

                <form class="mt-8 flex flex-col gap-4 sm:flex-row" action="{{ route('cart.store', $product) }}" method="post">
                    @csrf
                    <label class="flex items-center gap-3 rounded-lg border border-slate-300 px-4 py-3 text-sm font-semibold">
                        Quantity
                        <input class="w-16 border-0 text-center outline-none" type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" required @disabled($product->stock < 1)>
                    </label>
                    <button class="flex-1 rounded-lg bg-slate-950 px-5 py-3 font-semibold text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50" type="submit" @disabled($product->stock < 1)>Add to cart</button>
                </form>
                <a class="mt-4 text-center text-sm font-semibold text-slate-600 underline underline-offset-4" href="{{ route('cart.index') }}">View cart</a>
            </div>
        </article>
    </main>
@endsection
