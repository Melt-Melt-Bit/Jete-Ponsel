@extends('layouts.store')

@section('title', 'Sign in — JT Ponsel')

@push('scripts')
    @vite(['resources/js/login.js'])
@endpush

@section('content')
    <main class="mx-auto flex min-h-screen max-w-6xl items-center px-5 py-12">
        <section class="mx-auto w-full max-w-xl rounded-2xl border border-white/10 bg-white/5 p-6 shadow-2xl sm:p-10" aria-label="Account access">
            <x-brand-mark class="brand-mark mb-8 inline-flex items-center gap-3 text-xl font-bold" />

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-400/40 bg-red-950/50 p-4 text-sm text-red-100" role="alert">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-hidden">
                <div class="auth-track flex w-[200%] items-start transition-transform duration-300" data-auth-track>
                    <section class="w-1/2 shrink-0 pr-5" data-auth-slide="signin" aria-hidden="false">
                        <h1 class="text-3xl font-bold sm:text-4xl">Welcome back</h1>
                        <p class="mt-3 text-sm text-white/70">Sign in to your JT Ponsel account.</p>
                        <form class="mt-8 flex flex-col gap-5" action="{{ route('login.submit') }}" method="post">
                            @csrf
                            <label class="flex flex-col gap-2 text-sm font-medium">
                                Email address
                                <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-400" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                            </label>
                            <label class="flex flex-col gap-2 text-sm font-medium">
                                Password
                                <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-400" name="password" type="password" autocomplete="current-password" required>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-white/80">
                                <input class="h-4 w-4 accent-blue-500" name="remember" type="checkbox" value="1">
                                Remember me
                            </label>
                            <button class="rounded-lg bg-white px-4 py-3 font-semibold text-black transition hover:bg-blue-100" type="submit">Sign in</button>
                        </form>
                        <p class="mt-7 text-sm text-white/75">
                            New to JT Ponsel?
                            <button class="font-semibold text-blue-300 underline underline-offset-4" type="button" data-switch-auth="signup">Create an account</button>
                        </p>
                    </section>

                    <section class="w-1/2 shrink-0 pl-5" data-auth-slide="signup" aria-hidden="true">
                        <h1 class="text-3xl font-bold sm:text-4xl">Create your account</h1>
                        <p class="mt-3 text-sm text-white/70">Use an account to keep track of your orders.</p>
                        <form class="mt-8 flex flex-col gap-5" action="{{ route('register.submit') }}" method="post">
                            @csrf
                            <label class="flex flex-col gap-2 text-sm font-medium">
                                Name
                                <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-400" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required>
                            </label>
                            <label class="flex flex-col gap-2 text-sm font-medium">
                                Email address
                                <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-400" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                            </label>
                            <label class="flex flex-col gap-2 text-sm font-medium">
                                Password
                                <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-400" name="password" type="password" autocomplete="new-password" minlength="8" required>
                            </label>
                            <label class="flex flex-col gap-2 text-sm font-medium">
                                Confirm password
                                <input class="rounded-lg border border-white/20 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-400" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required>
                            </label>
                            <button class="rounded-lg bg-white px-4 py-3 font-semibold text-black transition hover:bg-blue-100" type="submit">Create account</button>
                        </form>
                        <p class="mt-7 text-sm text-white/75">
                            Already registered?
                            <button class="font-semibold text-blue-300 underline underline-offset-4" type="button" data-switch-auth="signin">Sign in</button>
                        </p>
                    </section>
                </div>
            </div>
        </section>
    </main>
@endsection
