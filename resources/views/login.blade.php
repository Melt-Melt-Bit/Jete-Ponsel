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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#050505">

        <title>{{ config('app.name', 'JT Ponsel') }}</title>

        @vite(['resources/css/login.css', 'resources/js/login.js'])
    </head>
    
    <body class="min-h-screen bg-black font-sans text-white antialiased">
        <main class="auth-shell min-h-screen">
            <section class="auth-panel relative flex min-h-screen w-full flex-col overflow-hidden bg-black lg:w-1/2" aria-label="Authentication">
                <div class="auth-pattern pointer-events-none absolute inset-0" aria-hidden="true"></div>

                <a class="auth-brand relative z-10 flex w-fit items-center gap-3 px-7 py-7 sm:px-10 sm:py-9" href="{{ route('home') }}" aria-label="JT Ponsel home">
                    <span class="brand-icon" aria-hidden="true">
                        <svg viewBox="0 0 40 40"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                    </span>
                    <span class="auth-brand-text text-xl font-bold tracking-tight sm:text-2xl">JT<span class="brand-dot">.</span></span>
                </a>

                <div class="auth-viewport relative z-10 flex flex-1 items-start overflow-hidden px-7 pb-10 pt-14 sm:px-10 sm:pt-20">
                    <div class="auth-track flex w-[200%] items-start transition-transform duration-[350ms] ease-in-out" data-auth-track>
                        <div class="auth-slide w-1/2 shrink-0" data-auth-slide="signin" aria-hidden="false">
                            <div class="auth-form-wrap">
                                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">User Sign in</h1>
                                <p class="mt-4 text-sm text-white/80 sm:text-base">
                                    Don't have an account?
                                    <button class="auth-switch ml-1 font-semibold text-white underline underline-offset-4 transition-opacity hover:opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" type="button" data-switch-auth="signup">Create Account</button>
                                </p>

                                <form class="mt-10 flex flex-col gap-4" action="{{ route('login.submit') }}" method="post" data-auth-form>
                                    @csrf
                                    <label class="sr-only" for="signin-email">Email</label>
                                    <div class="auth-input">
                                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 6.5h16v11H4zM4 7l8 6 8-6" /></svg>
                                        <input id="signin-email" name="email" type="text" placeholder="Email or admin username." autocomplete="username" required>
                                    </div>

                                    <label class="sr-only" for="signin-password">Password</label>
                                    <div class="auth-input">
                                        <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                        <input id="signin-password" name="password" type="password" placeholder="Password." autocomplete="current-password" required>
                                    </div>

                                    <div class="flex items-center justify-between gap-4 px-1 text-xs text-white/80 sm:text-sm">
                                        <label class="flex cursor-pointer items-center gap-2">
                                            <input class="auth-checkbox" type="checkbox" name="remember">
                                            <span>save my password</span>
                                        </label>
                                        <a class="font-medium text-white underline underline-offset-4 transition-opacity hover:opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="#forgot-password">Forgot Password?</a>
                                    </div>

                                    <button class="auth-button mt-3" type="submit">Sign In</button>
                                </form>

                                <div class="my-7 flex items-center gap-4 text-xs text-white/50">
                                    <span class="h-px flex-1 bg-white/20"></span>
                                    <span>or</span>
                                    <span class="h-px flex-1 bg-white/20"></span>
                                </div>
                                <div class="flex flex-col gap-3" aria-label="Additional sign in options">
                                    <button class="auth-button auth-button-placeholder" type="button" aria-label="Additional sign in option">Google</button>
                                    <button class="auth-button auth-button-placeholder" type="button" aria-label="Additional sign in option">Facebook</button>
                                </div>
                            </div>
                        </div>

                        <div class="auth-slide w-1/2 shrink-0" data-auth-slide="signup" aria-hidden="true">
                            <div class="auth-form-wrap">
                                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Create Account</h1>
                                <p class="mt-4 text-sm text-white/80 sm:text-base">Join JT Ponsel today.</p>

                                <form class="mt-10 flex flex-col gap-4" action="{{ route('login.submit') }}" method="post" data-auth-form>
                                    @csrf
                                    <label class="sr-only" for="signup-name">Name</label>
                                    <div class="auth-input">
                                        <svg aria-hidden="true" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"/><path d="M5 19c.8-3.1 3.2-4.8 7-4.8s6.2 1.7 7 4.8"/></svg>
                                        <input id="signup-name" name="name" type="text" placeholder="Name." autocomplete="name" required>
                                    </div>

                                    <label class="sr-only" for="signup-email">Email</label>
                                    <div class="auth-input">
                                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 6.5h16v11H4zM4 7l8 6 8-6" /></svg>
                                        <input id="signup-email" name="email" type="email" placeholder="Email." autocomplete="email" required>
                                    </div>

                                    <label class="sr-only" for="signup-password">Password</label>
                                    <div class="auth-input">
                                        <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                        <input id="signup-password" name="password" type="password" placeholder="Password." autocomplete="new-password" required>
                                    </div>

                                    <label class="sr-only" for="signup-password-confirmation">Confirm Password</label>
                                    <div class="auth-input">
                                        <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                        <input id="signup-password-confirmation" name="password_confirmation" type="password" placeholder="Confirm Password." autocomplete="new-password" required>
                                    </div>

                                    <button class="auth-button mt-3" type="submit">Sign Up</button>
                                </form>

                                <p class="mt-7 text-center text-sm text-white/80 sm:text-base">
                                    Already have an account?
                                    <button class="auth-switch ml-1 font-semibold text-white underline underline-offset-4 transition-opacity hover:opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" type="button" data-switch-auth="signin">Sign In</button>
                                </p>
                            </div>
                        </div>
                    </div>
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
