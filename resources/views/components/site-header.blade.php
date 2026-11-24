@props([
    'active' => 'home',
    'cartHref' => route('cart.index'),
])

<header class="site-header flex flex-wrap items-center justify-between gap-4 bg-white px-5 py-4 text-black md:px-10">
    <x-brand-mark class="brand-mark flex items-center gap-2 font-bold" />

    <nav class="main-nav flex items-center gap-5 text-sm font-semibold" aria-label="Main navigation">
        <a class="{{ $active === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        <a class="{{ $active === 'products' ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
    </nav>

    <div class="flex items-center gap-4">
        @auth
            @if (auth()->user()->is_admin)
                <a class="text-sm font-semibold" href="{{ route('admin.dashboard') }}">Admin</a>
            @else
                <a class="text-sm font-semibold" href="{{ route('profile', ['section' => 'orders']) }}">My orders</a>
            @endif
            <a class="inline-flex items-center gap-2 text-sm font-semibold" href="{{ route('profile') }}">
                <span class="grid h-9 w-9 shrink-0 place-items-center overflow-hidden rounded-full bg-blue-500/10 text-sm font-bold text-blue-700 ring-1 ring-blue-500/20" aria-hidden="true">
                    @if (auth()->user()->avatar_path)
                        <img class="h-full w-full object-cover" src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="">
                    @else
                        {{ str(auth()->user()->name)->substr(0, 1)->upper() }}
                    @endif
                </span>
                <span>Profile</span>
            </a>
            <form
                action="{{ route('logout') }}"
                method="post"
                data-confirm-submit
                data-confirm-title="Sign out?"
                data-confirm-message="Are you sure you want to sign out?"
                data-confirm-cancel-label="Stay signed in"
                data-confirm-accept-label="Sign out"
            >
                @csrf
                <button class="text-sm font-semibold" type="submit">Sign out</button>
            </form>
        @else
            <a class="text-sm font-semibold" href="{{ route('login') }}">Sign in</a>
        @endauth

        <a class="cart-button" href="{{ $cartHref }}" aria-label="View cart">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 4h2l2.2 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 1.9-1.4L21 8H6M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        </a>
    </div>

    <dialog
        class="m-auto w-[calc(100%-2rem)] max-w-md rounded-3xl border border-white/10 bg-[#111318] p-0 text-white shadow-2xl backdrop:bg-black/70"
        data-confirm-dialog
        aria-labelledby="confirmation-dialog-title"
        aria-describedby="confirmation-dialog-message"
    >
        <div class="p-6 sm:p-7">
            <div class="flex items-start gap-4">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-rose-400/10 text-xl font-bold text-rose-200 ring-1 ring-rose-300/20" aria-hidden="true">!</span>
                <div>
                    <h2 class="text-xl font-bold" id="confirmation-dialog-title" data-confirm-dialog-title>Confirm action</h2>
                    <p class="mt-2 text-sm leading-6 text-white/60" id="confirmation-dialog-message" data-confirm-dialog-message>Are you sure you want to continue?</p>
                </div>
            </div>
            <div class="mt-7 flex justify-end gap-3">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-white/75 transition hover:bg-white/10 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300" type="button" data-confirm-cancel autofocus>
                    Cancel
                </button>
                <button class="rounded-xl bg-rose-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-200" type="button" data-confirm-accept>
                    Confirm
                </button>
            </div>
        </div>
    </dialog>
</header>
