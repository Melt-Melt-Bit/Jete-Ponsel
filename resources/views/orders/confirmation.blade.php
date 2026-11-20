@extends('layouts.store')

@section('title', 'Order received — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-3xl px-5 py-16 md:px-8">
        <section class="rounded-2xl border border-emerald-400/20 bg-emerald-950/30 p-7 md:p-10">
            <p class="text-sm font-semibold uppercase tracking-widest text-emerald-300">Order placed</p>
            <h1 class="mt-3 text-3xl font-bold">Thanks, {{ $order->customer_name }}.</h1>
            <p class="mt-3 text-white/70">Your pickup order is recorded. Pay at the store when you collect it.</p>
            <dl class="mt-8 grid gap-4 border-t border-white/10 pt-6 sm:grid-cols-2">
                <div><dt class="text-sm text-white/60">Order number</dt><dd class="mt-1 font-semibold">{{ $order->order_number }}</dd></div>
                <div><dt class="text-sm text-white/60">Order status</dt><dd class="mt-1 font-semibold">{{ str_replace('_', ' ', ucfirst($order->status)) }}</dd></div>
                <div><dt class="text-sm text-white/60">Payment</dt><dd class="mt-1 font-semibold">Unpaid · pay at pickup</dd></div>
                <div><dt class="text-sm text-white/60">Total</dt><dd class="mt-1 font-semibold">Rp{{ number_format($order->total, 0, ',', '.') }}</dd></div>
            </dl>
            <ul class="mt-7 flex flex-col gap-3 text-sm text-white/80">
                @foreach ($order->items as $item)
                    <li>{{ $item->product_name }} × {{ $item->quantity }} — Rp{{ number_format($item->line_total, 0, ',', '.') }}</li>
                @endforeach
            </ul>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="rounded-lg bg-white px-5 py-3 font-semibold text-black" href="{{ route('products.index') }}">Continue shopping</a>
                @auth
                    <a class="rounded-lg border border-white/25 px-5 py-3 font-semibold" href="{{ route('account.orders.index') }}">View my orders</a>
                @endauth
            </div>
        </section>
    </main>
@endsection
