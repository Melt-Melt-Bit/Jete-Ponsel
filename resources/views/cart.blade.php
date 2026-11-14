@extends('layouts.store')

@section('title', 'Your cart — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 md:px-8">
        <h1 class="text-3xl font-bold">Your cart</h1>
        <p class="mt-2 text-sm text-white/65">Review item quantities before pickup checkout.</p>

        @if (session('status'))
            <p class="mt-6 rounded-lg bg-emerald-900/50 p-4 text-emerald-100" role="status">{{ session('status') }}</p>
        @endif
        @if (session('cart_notice'))
            <p class="mt-6 rounded-lg bg-amber-900/50 p-4 text-amber-100" role="status">{{ session('cart_notice') }}</p>
        @endif
        @if ($errors->any())
            <div class="mt-6 rounded-lg bg-red-950/70 p-4 text-red-100" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if ($cartItems === [])
            <section class="mt-8 rounded-2xl border border-white/10 bg-white/5 p-8 text-center">
                <p class="text-lg font-semibold">Your cart is empty.</p>
                <a class="mt-5 inline-flex rounded-lg bg-white px-5 py-3 font-semibold text-black" href="{{ route('products.index') }}">Browse products</a>
            </section>
        @else
            <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_21rem]">
                <section class="flex flex-col gap-4" aria-label="Cart items">
                    @foreach ($cartItems as $item)
                        <article class="grid gap-5 rounded-xl border border-white/10 bg-white p-5 text-slate-950 sm:grid-cols-[8rem_1fr]">
                            <img class="h-32 w-full rounded-lg bg-slate-100 object-contain p-3" src="{{ $item['product']->image_url }}" alt="{{ $item['product']->brand }} {{ $item['product']->name }}">
                            <div class="flex flex-col justify-between gap-4">
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ $item['product']->brand }}</p>
                                        <h2 class="mt-1 text-lg font-bold">{{ $item['product']->name }}</h2>
                                        <p class="mt-1 text-sm text-slate-600">{{ $item['product']->formatted_price }} each</p>
                                    </div>
                                    <p class="font-bold">Rp{{ number_format($item['line_total'], 0, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <form class="flex items-center gap-2" action="{{ route('cart.update', $item['product']) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <label class="text-sm font-semibold" for="quantity-{{ $item['product']->id }}">Qty</label>
                                        <input class="w-20 rounded-md border border-slate-300 px-2 py-1" id="quantity-{{ $item['product']->id }}" type="number" name="quantity" min="1" max="{{ $item['product']->stock }}" value="{{ $item['quantity'] }}" required>
                                        <button class="text-sm font-semibold text-blue-700 underline" type="submit">Update</button>
                                    </form>
                                    <form action="{{ route('cart.destroy', $item['product']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-sm font-semibold text-red-700 underline" type="submit">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </section>

                <aside class="h-fit rounded-xl bg-white p-6 text-slate-950">
                    <h2 class="text-lg font-bold">Order summary</h2>
                    <div class="mt-5 flex justify-between gap-4 text-sm">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-3 flex justify-between gap-4 text-sm text-slate-600">
                        <span>Pickup</span>
                        <span>Free</span>
                    </div>
                    <hr class="my-5 border-slate-200">
                    <div class="flex justify-between gap-4 font-bold">
                        <span>Total</span>
                        <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <a class="mt-6 block rounded-lg bg-slate-950 px-4 py-3 text-center font-semibold text-white hover:bg-blue-700" href="{{ route('checkout.create') }}">Continue to checkout</a>
                </aside>
            </div>
        @endif
    </main>
@endsection
