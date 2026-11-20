@props(['product'])

<article class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-white text-slate-950 shadow-lg">
    <a class="block bg-slate-100 p-6" href="{{ route('products.show', $product) }}" aria-label="View {{ $product->brand }} {{ $product->name }}">
        <img class="h-56 w-full object-contain" src="{{ $product->image_url }}" alt="{{ $product->brand }} {{ $product->name }}" loading="lazy">
    </a>
    <div class="flex flex-1 flex-col gap-3 p-5">
        <div class="flex items-center justify-between gap-3">
            <p class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ $product->brand }}</p>
            @if ($product->badge)
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">{{ $product->badge }}</span>
            @endif
        </div>
        <h3 class="text-lg font-bold">
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </h3>
        <p class="text-lg font-semibold">{{ $product->formatted_price }}</p>
        <p class="text-sm text-slate-600">{{ $product->stock }} in stock</p>
        <form class="mt-auto" action="{{ route('cart.store', $product) }}" method="post">
            @csrf
            <button class="w-full rounded-lg bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50" type="submit" @disabled($product->stock < 1)>
                Add to cart
            </button>
        </form>
    </div>
</article>
