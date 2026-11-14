@extends('layouts.store')

@section('title', 'Admin dashboard — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@push('scripts')
    @vite(['resources/js/admin.js'])
@endpush

@section('content')
    <main class="mx-auto max-w-7xl px-5 py-10 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[.2em] text-blue-300">Store administration</p>
                <h1 class="mt-2 text-3xl font-bold">Dashboard</h1>
            </div>
            <p class="text-sm text-white/65">Signed in as {{ auth()->user()->name }}</p>
        </div>

        @if (session('admin_status'))
            <p class="mt-6 rounded-lg bg-emerald-900/50 p-4 text-emerald-100" role="status">{{ session('admin_status') }}</p>
        @endif
        @if ($errors->any())
            <div class="mt-6 rounded-lg bg-red-950/70 p-4 text-red-100" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Store metrics">
            @foreach ($metrics as $metric)
                <article class="rounded-xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm text-white/60">{{ $metric['label'] }}</p>
                    <p class="mt-2 text-3xl font-bold">{{ $metric['value'] }}</p>
                </article>
            @endforeach
        </section>

        <section class="mt-10 rounded-xl border border-white/10 bg-white/5 p-6" id="orders">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-widest text-white/55">Order management</p>
                    <h2 class="mt-2 text-2xl font-bold">Recent orders</h2>
                </div>
                <p class="text-sm text-white/60">Pay-at-pickup orders remain unpaid until collected.</p>
            </div>
            <div class="mt-6 overflow-x-auto">
                <table class="w-full min-w-[48rem] text-left text-sm">
                    <thead class="text-white/55"><tr><th class="pb-3">Order</th><th class="pb-3">Customer</th><th class="pb-3">Items</th><th class="pb-3">Total</th><th class="pb-3">Status</th><th class="pb-3">Update</th></tr></thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse ($orders as $order)
                            <tr>
                                <td class="py-4 font-semibold">{{ $order->order_number }}</td>
                                <td class="py-4">{{ $order->customer_name }}<br><span class="text-xs text-white/55">{{ $order->customer_email }}</span></td>
                                <td class="py-4">{{ $order->items->sum('quantity') }}</td>
                                <td class="py-4">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                <td class="py-4 capitalize">{{ str_replace('_', ' ', $order->status) }}</td>
                                <td class="py-4">
                                    @if ($order->status === 'pending')
                                        <form class="flex gap-2" action="{{ route('admin.orders.status', $order) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <select class="rounded-md bg-slate-900 px-2 py-2" name="status" aria-label="New status for {{ $order->order_number }}">
                                                <option value="ready_for_pickup">Ready for pickup</option>
                                                <option value="cancelled">Cancel</option>
                                            </select>
                                            <button class="rounded-md bg-white px-3 py-2 font-semibold text-black" type="submit">Save</button>
                                        </form>
                                    @elseif ($order->status === 'ready_for_pickup')
                                        <form class="flex gap-2" action="{{ route('admin.orders.status', $order) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <select class="rounded-md bg-slate-900 px-2 py-2" name="status" aria-label="New status for {{ $order->order_number }}">
                                                <option value="completed">Complete pickup</option>
                                                <option value="cancelled">Cancel</option>
                                            </select>
                                            <button class="rounded-md bg-white px-3 py-2 font-semibold text-black" type="submit">Save</button>
                                        </form>
                                    @else
                                        <span class="text-white/50">Closed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td class="py-5 text-white/60" colspan="6">No orders have been placed yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mt-10 rounded-xl border border-white/10 bg-white/5 p-6" id="products">
            <div>
                <p class="text-xs uppercase tracking-widest text-white/55">Catalogue</p>
                <h2 class="mt-2 text-2xl font-bold">Add a product</h2>
            </div>
            <form class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3" action="{{ route('admin.products.store') }}" method="post">
                @csrf
                <label class="flex flex-col gap-2 text-sm">SKU<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="sku" value="{{ old('sku') }}" required></label>
                <label class="flex flex-col gap-2 text-sm">Brand<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="brand" value="{{ old('brand') }}" required></label>
                <label class="flex flex-col gap-2 text-sm">Name<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="name" value="{{ old('name') }}" required></label>
                <label class="flex flex-col gap-2 text-sm">Category
                    <select class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="category" required>
                        <option value="phone">Phone</option><option value="earphone">Earphone</option><option value="accessory">Accessory</option>
                    </select>
                </label>
                <label class="flex flex-col gap-2 text-sm">Price (IDR)<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="price" type="number" min="1" value="{{ old('price') }}" required></label>
                <label class="flex flex-col gap-2 text-sm">Stock<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="stock" type="number" min="0" value="{{ old('stock', 0) }}" required></label>
                <label class="flex flex-col gap-2 text-sm">Badge<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="badge" value="{{ old('badge') }}"></label>
                <label class="flex flex-col gap-2 text-sm">Image path<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="image_path" value="{{ old('image_path') }}" placeholder="resources/images/phones/..." data-image-path="create-product" required></label>
                <img class="h-20 w-20 rounded bg-white object-contain p-2" data-image-preview="create-product" alt="Selected product image preview" hidden>
                <label class="flex flex-col gap-2 text-sm sm:col-span-2 lg:col-span-3">Description<textarea class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="description" rows="2">{{ old('description') }}</textarea></label>
                <button class="w-fit rounded-lg bg-white px-5 py-3 font-semibold text-black" type="submit">Create product</button>
            </form>
        </section>

        <section class="mt-10">
            <h2 class="text-2xl font-bold">Manage products</h2>
            <div class="mt-5 flex flex-col gap-4">
                @forelse ($products as $product)
                    <details class="rounded-xl border border-white/10 bg-white/5 p-5">
                        <summary class="flex cursor-pointer flex-wrap items-center justify-between gap-4 font-semibold">
                            <span>{{ $product->brand }} {{ $product->name }} <span class="font-normal text-white/60">· {{ $product->sku }} · Rp{{ number_format($product->price, 0, ',', '.') }}</span></span>
                            <span class="{{ $product->is_active ? 'text-emerald-300' : 'text-white/50' }}">{{ $product->is_active ? 'Visible' : 'Hidden' }} · Stock {{ $product->stock }}</span>
                        </summary>
                        <form class="mt-5 grid gap-4 border-t border-white/10 pt-5 sm:grid-cols-2 lg:grid-cols-3" action="{{ route('admin.products.update', $product) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label class="flex flex-col gap-2 text-sm">SKU<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="sku" value="{{ $product->sku }}" required></label>
                            <label class="flex flex-col gap-2 text-sm">Brand<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="brand" value="{{ $product->brand }}" required></label>
                            <label class="flex flex-col gap-2 text-sm">Name<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="name" value="{{ $product->name }}" required></label>
                            <label class="flex flex-col gap-2 text-sm">Category
                                <select class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="category" required>
                                    @foreach (['phone' => 'Phone', 'earphone' => 'Earphone', 'accessory' => 'Accessory'] as $value => $label)
                                        <option value="{{ $value }}" @selected($product->category === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="flex flex-col gap-2 text-sm">Price (IDR)<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="price" type="number" min="1" value="{{ $product->price }}" required></label>
                            <label class="flex flex-col gap-2 text-sm">Stock<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="stock" type="number" min="0" value="{{ $product->stock }}" required></label>
                            <label class="flex flex-col gap-2 text-sm">Badge<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="badge" value="{{ $product->badge }}"></label>
                            <label class="flex flex-col gap-2 text-sm">Image path<input class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="image_path" value="{{ $product->image_path }}" data-image-path="product-{{ $product->id }}" required></label>
                            <img class="h-20 w-20 rounded bg-white object-contain p-2" data-image-preview="product-{{ $product->id }}" alt="Selected product image preview" hidden>
                            <label class="flex flex-col gap-2 text-sm sm:col-span-2 lg:col-span-3">Description<textarea class="rounded-md border border-white/15 bg-black/30 px-3 py-2" name="description" rows="2">{{ $product->description }}</textarea></label>
                            <button class="w-fit rounded-lg bg-white px-5 py-3 font-semibold text-black" type="submit">Save changes</button>
                        </form>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <form action="{{ route('admin.products.visibility', $product) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button class="rounded-lg border border-white/20 px-4 py-2 text-sm" type="submit">{{ $product->is_active ? 'Hide from storefront' : 'Show in storefront' }}</button>
                            </form>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg border border-red-300/40 px-4 py-2 text-sm text-red-200" type="submit">Delete product</button>
                            </form>
                        </div>
                    </details>
                @empty
                    <p class="rounded-xl border border-white/10 p-6 text-white/60">No products in the catalogue yet.</p>
                @endforelse
            </div>
        </section>
    </main>
@endsection
