@extends('layouts.store')

@section('title', 'Page unavailable — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto grid min-h-[70vh] max-w-3xl place-items-center px-5 py-16 text-center">
        <section>
            <p class="text-sm font-bold uppercase tracking-[.24em] text-blue-400">JT Ponsel</p>
            <h1 class="mt-4 text-4xl font-bold md:text-6xl">Sorry, this page is incomplete.</h1>
            <p class="mt-5 text-white/65">This section is not available yet. Please continue browsing the shop.</p>
            <a class="mt-8 inline-flex rounded-lg bg-white px-5 py-3 font-bold text-black transition hover:bg-blue-100" href="{{ route('home') }}">
                Back to home
            </a>
        </section>
    </main>
@endsection
