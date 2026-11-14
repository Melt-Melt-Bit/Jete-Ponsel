@extends('layouts.store')

@section('title', 'Order '.$order->order_number.' — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-4xl px-5 py-10 md:px-8">
        <a class="text-sm font-semibold text-white/70 underline underline-offset-4" href="{{ route('account.orders.index') }}">← My orders</a>
        <h1 class="mt-5 text-3xl font-bold">{{ $order->order_number }}</h1>
        <p class="mt-2 text-white/65">Pickup · {{ str_replace('_', ' ', ucfirst($order->status)) }} · {{ ucfirst($order->payment_status) }}</p>
        <section class="mt-8 rounded-xl bg-white p-6 text-slate-950">
            <h2 class="text-lg font-bold">Items</h2>
            <ul class="mt-5 flex flex-col gap-4">
                @foreach ($order->items as $item)
                    <li class="flex justify-between gap-4 border-b border-slate-200 pb-4">
                        <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                        <span class="font-semibold">Rp{{ number_format($item->line_total, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-5 flex justify-between font-bold"><span>Total</span><span>Rp{{ number_format($order->total, 0, ',', '.') }}</span></p>
            <p class="mt-4 text-sm text-slate-600">Pickup contact: {{ $order->customer_name }} · {{ $order->customer_email }} · {{ $order->customer_phone }}</p>
        </section>
    </main>
@endsection
