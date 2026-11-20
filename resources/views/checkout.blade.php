@extends('layouts.store')

@section('title', 'Pickup checkout — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 md:px-8">
        <a class="text-sm font-semibold text-white/70 underline underline-offset-4" href="{{ route('cart.index') }}">← Back to cart</a>
        <h1 class="mt-5 text-3xl font-bold">Pickup checkout</h1>
        <p class="mt-2 max-w-2xl text-sm text-white/65">Place an order and pay when you collect it at the store. Online payment is not available yet.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-lg border border-red-400/30 bg-red-950/60 p-4 text-red-100" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_22rem]">
            <section class="rounded-xl border border-white/10 bg-white/5 p-6 md:p-8">
                <h2 class="text-xl font-bold">Pickup details</h2>
                <p class="mt-2 text-sm text-white/65">JT Ponsel Main Store · Confirm pickup hours with the store.</p>
                <form class="mt-7 flex flex-col gap-5" action="{{ route('checkout.store') }}" method="post">
                    @csrf
                    <label class="flex flex-col gap-2 text-sm font-semibold">
                        Full name
                        <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 font-normal text-white" name="customer_name" type="text" value="{{ old('customer_name', $customer?->name) }}" autocomplete="name" required>
                    </label>
                    <label class="flex flex-col gap-2 text-sm font-semibold">
                        Email address
                        <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 font-normal text-white" name="customer_email" type="email" value="{{ old('customer_email', $customer?->email) }}" autocomplete="email" required>
                    </label>
                    <label class="flex flex-col gap-2 text-sm font-semibold">
                        Phone number
                        <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 font-normal text-white" name="customer_phone" type="tel" value="{{ old('customer_phone') }}" autocomplete="tel" required>
                    </label>
                    <label class="flex flex-col gap-2 text-sm font-semibold">
                        Notes for the store <span class="font-normal text-white/60">(optional)</span>
                        <textarea class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 font-normal text-white" name="notes" rows="3">{{ old('notes') }}</textarea>
                    </label>
                    <fieldset class="flex flex-col gap-3">
                        <legend class="mb-2 text-sm font-semibold">Payment</legend>
                        <label class="flex items-start gap-3 rounded-lg border border-blue-400/60 bg-blue-950/30 p-4">
                            <input class="mt-1 accent-blue-400" type="radio" name="payment_method" value="pay_at_pickup" checked>
                            <span><strong class="block">Pay at pickup</strong><span class="text-sm text-white/65">Available now. Payment is collected at the store.</span></span>
                        </label>
                        <div class="flex items-start gap-3 rounded-lg border border-white/10 p-4 text-white/50" aria-disabled="true">
                            <input class="mt-1" type="radio" disabled>
                            <span><strong class="block">Online payment</strong><span class="text-sm">Coming later — no card details are collected.</span></span>
                        </div>
                    </fieldset>
                    <button class="rounded-lg bg-white px-5 py-3 font-bold text-black hover:bg-blue-100" type="submit">Place pickup order</button>
                </form>
            </section>

            <aside class="h-fit rounded-xl bg-white p-6 text-slate-950">
                <h2 class="text-lg font-bold">Order summary</h2>
                <div class="mt-5 flex flex-col gap-4">
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between gap-4 text-sm">
                            <span>{{ $item['product']->name }} × {{ $item['quantity'] }}</span>
                            <span class="whitespace-nowrap">Rp{{ number_format($item['line_total'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                <hr class="my-5 border-slate-200">
                <div class="flex justify-between font-bold">
                    <span>Total due at pickup</span>
                    <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
            </aside>
        </div>
    </main>
@endsection
