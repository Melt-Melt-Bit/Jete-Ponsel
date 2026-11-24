@extends('layouts.store')

@section('title', 'Pickup checkout — JT Ponsel')

@section('header')
    <x-site-header active="cart" />
@endsection

@push('styles')
    @vite(['resources/css/pembayaran.css'])
@endpush

@section('content')
    @if ($errors->any())
        <div class="mx-auto mt-6 max-w-7xl rounded-lg border border-red-400/30 bg-red-950/60 p-4 text-red-100" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="post">
        @csrf
        <main class="min-h-screen overflow-hidden bg-gradient-to-b from-[#0f0f0f] to-[#222] md:flex">
            <section class="flex flex-col px-6 py-10 text-white sm:px-10 md:w-[47%] md:px-16 lg:px-24">
                <div class="flex-1 py-8 md:flex md:flex-col md:justify-center">
                    <p class="text-sm font-semibold uppercase tracking-[.18em] text-white/55">JT Ponsel / Checkout</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-tight md:text-5xl">Pickup order summary</h1>

                    <div class="mt-12 flex flex-col gap-4 text-sm text-white/75">
                        <div class="flex justify-between gap-4">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Tax</span>
                            <span>Rp0</span>
                        </div>
                        <div class="flex justify-between gap-4 text-white/55">
                            <span>Pickup</span>
                            <span>Free</span>
                        </div>
                    </div>

                    <hr class="my-7 border-white/15">

                    <div class="flex items-center justify-between gap-4 font-semibold">
                        <span class="text-xl">Total due at pickup</span>
                        <span class="text-2xl">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <button class="mt-10 w-full rounded-xl bg-white px-5 py-4 text-lg font-semibold text-black transition hover:bg-blue-100" type="submit">
                        Place pickup order
                    </button>
                    <p class="mt-4 text-center text-xs text-white/50">Payment is collected at the store. No card details are needed.</p>
                </div>

                <a class="border-t border-white/10 pt-5 text-xs text-white/55 hover:text-white" href="{{ route('cart.index') }}">← Back to cart</a>
            </section>

            <section id="panel" class="bg-white px-6 py-10 text-slate-950 sm:px-10 md:w-[53%] md:rounded-l-[2.5rem] md:px-12 lg:px-16">
                <h2 class="text-3xl font-semibold">Order items</h2>
                <div class="mt-6 flex flex-col gap-4">
                    @foreach ($cartItems as $item)
                        <article class="flex items-center gap-4 rounded-xl bg-slate-100 p-4 shadow-sm">
                            <img class="h-20 w-20 shrink-0 rounded-lg bg-white object-contain p-2" src="{{ $item['product']->image_url }}" alt="{{ $item['product']->brand }} {{ $item['product']->name }}" referrerpolicy="no-referrer">
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold">{{ $item['product']->brand }} {{ $item['product']->name }}</p>
                                <p class="mt-1 text-xs text-slate-600">SKU: {{ $item['product']->sku }} · Qty {{ $item['quantity'] }}</p>
                                <p class="mt-2 text-sm font-semibold">Rp{{ number_format($item['line_total'], 0, ',', '.') }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <fieldset class="mt-8">
                    <legend class="text-2xl font-semibold">Order type</legend>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-lg bg-slate-950 px-4 py-4 text-center font-medium text-white">
                            <span class="block">Pickup</span>
                            <span class="mt-1 block text-xs text-white/65">Available now</span>
                        </div>
                        <div class="cursor-not-allowed rounded-lg bg-slate-200 px-4 py-4 text-center font-medium text-slate-500" aria-disabled="true">
                            <span class="block">Delivery</span>
                            <span class="mt-1 block text-xs">Unavailable</span>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-slate-600">Collect your order at the JT Ponsel store after it is ready.</p>
                </fieldset>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <label class="flex flex-col gap-2 text-sm font-semibold">
                        Full name
                        <input class="rounded-lg border border-slate-300 bg-white px-3 py-3 font-normal" name="customer_name" type="text" value="{{ old('customer_name', $customer?->name) }}" autocomplete="name" required>
                    </label>
                    <label class="flex flex-col gap-2 text-sm font-semibold">
                        Phone number
                        <input class="rounded-lg border border-slate-300 bg-white px-3 py-3 font-normal" name="customer_phone" type="tel" value="{{ old('customer_phone') }}" autocomplete="tel" required>
                    </label>
                    <label class="flex flex-col gap-2 text-sm font-semibold sm:col-span-2">
                        Email address
                        <input class="rounded-lg border border-slate-300 bg-white px-3 py-3 font-normal" name="customer_email" type="email" value="{{ old('customer_email', $customer?->email) }}" autocomplete="email" required>
                    </label>
                </div>

                <fieldset class="mt-8">
                    <legend class="text-2xl font-semibold">Payment method</legend>
                    <label class="mt-4 flex cursor-pointer items-start gap-3 rounded-xl border-2 border-slate-950 bg-slate-50 p-4">
                        <input class="mt-1 accent-slate-950" type="radio" name="payment_method" value="pay_at_pickup" @checked(old('payment_method', 'pay_at_pickup') === 'pay_at_pickup') required>
                        <span>
                            <strong class="block">Pay at pickup</strong>
                            <span class="mt-1 block text-sm text-slate-600">Pay at the store when you collect your order.</span>
                        </span>
                    </label>
                    <div class="mt-3 rounded-xl border border-slate-200 p-4 text-slate-500" aria-disabled="true">
                        <strong class="block">Card, bank transfer, and e-wallet</strong>
                        <span class="mt-1 block text-sm">Online payment is not available yet. We do not collect card details.</span>
                    </div>
                </fieldset>

                <label class="mt-6 flex flex-col gap-2 text-sm font-semibold">
                    Notes for the store <span class="font-normal text-slate-500">(optional)</span>
                    <textarea class="rounded-lg border border-slate-300 bg-white px-3 py-3 font-normal" name="notes" rows="3">{{ old('notes') }}</textarea>
                </label>
            </section>
        </main>
    </form>
@endsection
