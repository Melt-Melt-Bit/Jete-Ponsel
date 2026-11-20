@extends('layouts.store')

@section('title', 'My orders — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-5xl px-5 py-10 md:px-8">
        <h1 class="text-3xl font-bold">My orders</h1>
        <div class="mt-8 flex flex-col gap-4">
            @forelse ($orders as $order)
                <a class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-white/10 bg-white/5 p-5 hover:bg-white/10" href="{{ route('account.orders.show', $order) }}">
                    <div>
                        <p class="font-semibold">{{ $order->order_number }}</p>
                        <p class="mt-1 text-sm text-white/60">{{ $order->created_at->format('d M Y, H:i') }} · {{ $order->items->count() }} item(s)</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">{{ $order->formatted_total }}</p>
                        <p class="mt-1 text-sm capitalize text-white/60">{{ str_replace('_', ' ', $order->status) }}</p>
                    </div>
                </a>
            @empty
                <p class="rounded-xl border border-white/10 p-6 text-white/70">You have not placed any orders yet.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $orders->links() }}</div>
    </main>
@endsection
