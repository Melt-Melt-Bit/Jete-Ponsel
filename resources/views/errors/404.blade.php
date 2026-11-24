@extends('layouts.store')

@section('title', 'Page not found | JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto grid min-h-[70vh] max-w-7xl place-items-center px-5 py-16 md:px-8">
        <section class="w-full max-w-2xl rounded-3xl border border-white/10 bg-white/[.04] p-8 text-center shadow-2xl md:p-12">
            <p class="text-sm font-bold uppercase tracking-[.24em] text-blue-300">JT Ponsel</p>
            <p class="mt-8 text-7xl font-black tracking-tight text-white/10 md:text-9xl" aria-hidden="true">404</p>
            <h1 class="-mt-2 text-3xl font-bold md:text-4xl">Page not found</h1>
            <p class="mx-auto mt-4 max-w-lg leading-7 text-white/65">
                We couldn't find the page you were looking for. It may have moved or the address may be incorrect.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a class="rounded-lg bg-white px-5 py-3 font-bold text-black transition hover:bg-blue-100" href="{{ route('home') }}">
                    Back to home
                </a>
                <a class="rounded-lg border border-white/20 px-5 py-3 font-semibold text-white transition hover:bg-white/10" href="{{ route('products.index') }}">
                    Browse products
                </a>
            </div>
        </section>
    </main>
@endsection
