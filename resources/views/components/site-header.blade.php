@props([
    'active' => 'home',
    'cartHref' => route('cart.index'),
])

<header class="site-header flex flex-wrap items-center justify-between gap-4 bg-white px-5 py-4 text-black md:px-10">
    <x-brand-mark class="brand-mark flex items-center gap-2 font-bold" />

    <nav class="main-nav flex items-center gap-5 text-sm font-semibold" aria-label="Main navigation">
        <a class="{{ $active === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        <a class="{{ $active === 'products' ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('products.index', ['category' => 'earphone']) }}">Earphones</a>
    </nav>

    <div class="flex items-center gap-4">
        @auth
            @if (auth()->user()->is_admin)
                <a class="text-sm font-semibold" href="{{ route('admin.dashboard') }}">Admin</a>
            @else
                <a class="text-sm font-semibold" href="{{ route('account.orders.index') }}">My orders</a>
            @endif
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="text-sm font-semibold" type="submit">Sign out</button>
            </form>
        @else
            <a class="text-sm font-semibold" href="{{ route('login') }}">Sign in</a>
        @endauth

        <a class="cart-button grid h-10 w-10 place-items-center rounded-full border border-slate-300" href="{{ $cartHref }}" aria-label="View cart">
            <span aria-hidden="true">Cart</span>
        </a>
    </div>
    <a class="cart-button" href="{{ $cartHref }}" aria-label="View cart">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 4h2l2.2 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 1.9-1.4L21 8H6M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>


    <a class="cart-button" href="{{ route('login') }}" aria-label="Profile">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="8" r="4" fill="none" stroke="currentColor" stroke-width="1.8"/>
            <path d="M4 21a8 8 0 0 1 16 0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
    </a>
</header>
