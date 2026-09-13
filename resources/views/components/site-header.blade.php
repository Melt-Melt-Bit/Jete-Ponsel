@props([
    'active' => 'home',
    'cartHref' => route('cart'),
])

<header class="site-header">
    <x-brand-mark />

    <nav class="main-nav" aria-label="Main navigation">
        <a class="{{ $active === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        <a class="{{ $active === 'products' ? 'active' : '' }}" href="{{ $active === 'home' ? '#categories' : '#products' }}">Phone</a>
        <a href="{{ $active === 'home' ? '#categories' : '#earphones' }}">Earphone</a>
        <a href="{{ $active === 'home' ? '#categories' : '#products' }}">Tablet</a>
        <a href="{{ $active === 'home' ? '#categories' : '#products' }}">Casing</a>
        <a href="#footer">More</a>
    </nav>

    <a class="cart-button" href="{{ $cartHref }}" aria-label="View cart">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 4h2l2.2 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 1.9-1.4L21 8H6M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
</header>
