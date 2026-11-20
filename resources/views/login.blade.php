@extends('layouts.store')

@section('title', 'Sign in — JT Ponsel')

@push('styles')
    @vite(['resources/css/login.css'])
@endpush

@push('scripts')
    @vite(['resources/js/login.js'])
@endpush

@section('content')
    <main class="auth-shell" data-auth-shell data-initial-mode="{{ $errors->has('name') ? 'signup' : 'signin' }}">
        <section class="auth-panel" aria-label="Account access">
            <div class="auth-pattern pointer-events-none absolute inset-0" aria-hidden="true"></div>

            <div class="auth-topbar relative z-10">
                <a class="auth-brand" href="{{ route('home') }}" aria-label="JT Ponsel home">
                    <span class="brand-icon" aria-hidden="true">
                        <svg viewBox="0 0 40 40"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                    </span>
                    <span class="auth-brand-text">JT<span class="brand-dot">.</span></span>
                </a>
                <a class="auth-cancel" href="{{ route('home') }}"><span aria-hidden="true">←</span> Back to store</a>
            </div>

            @if ($errors->any())
                <div class="auth-errors relative z-10" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="auth-viewport relative z-10">
                <div class="auth-track" data-auth-track>
                    <div class="auth-slide" data-auth-slide="signin" aria-hidden="false">
                        <div class="auth-form-wrap">
                            <h1>User Sign in</h1>
                            <p>
                                Don't have an account?
                                <button class="auth-switch" type="button" data-switch-auth="signup">Create Account</button>
                            </p>

                            <form class="mt-10 flex flex-col gap-4" action="{{ route('login.submit') }}" method="post">
                                @csrf
                                <label class="sr-only" for="signin-email">Email</label>
                                <div class="auth-input">
                                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 6.5h16v11H4zM4 7l8 6 8-6"/></svg>
                                    <input id="signin-email" name="email" type="email" value="{{ old('email') }}" placeholder="Email address." autocomplete="email" required>
                                </div>

                                <label class="sr-only" for="signin-password">Password</label>
                                <div class="auth-input">
                                    <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                    <input id="signin-password" name="password" type="password" placeholder="Password." autocomplete="current-password" required>
                                </div>

                                <div class="flex items-center justify-between gap-4 px-1 text-xs text-white/80 sm:text-sm">
                                    <label class="flex cursor-pointer items-center gap-2">
                                        <input class="auth-checkbox" type="checkbox" name="remember" value="1">
                                        <span>Remember me</span>
                                    </label>
                                    <a class="auth-link" href="{{ route('incomplete') }}">Forgot Password?</a>
                                </div>

                                <button class="auth-button mt-3" type="submit">Sign In</button>
                            </form>

                            <div class="my-7 flex items-center gap-4 text-xs text-white/75">
                                <span class="h-px flex-1 bg-white/20"></span>
                                <span>or</span>
                                <span class="h-px flex-1 bg-white/20"></span>
                            </div>
                            <div class="flex flex-col gap-3" aria-label="Additional sign in options">
                                <a class="auth-button" href="{{ route('incomplete') }}">Google</a>
                                <a class="auth-button" href="{{ route('incomplete') }}">Facebook</a>
                            </div>
                        </div>
                    </div>

                    <div class="auth-slide" data-auth-slide="signup" aria-hidden="true">
                        <div class="auth-form-wrap">
                            <h1>Create Account</h1>
                            <p>
                                Already have an account?
                                <button class="auth-switch" type="button" data-switch-auth="signin">Sign In</button>
                            </p>

                            <form class="mt-10 flex flex-col gap-4" action="{{ route('register.submit') }}" method="post">
                                @csrf
                                <label class="sr-only" for="signup-name">Name</label>
                                <div class="auth-input">
                                    <svg aria-hidden="true" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"/><path d="M5 19c.8-3.1 3.2-4.8 7-4.8s6.2 1.7 7 4.8"/></svg>
                                    <input id="signup-name" name="name" type="text" value="{{ old('name') }}" placeholder="Name." autocomplete="name" required>
                                </div>

                                <label class="sr-only" for="signup-email">Email</label>
                                <div class="auth-input">
                                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 6.5h16v11H4zM4 7l8 6 8-6"/></svg>
                                    <input id="signup-email" name="email" type="email" value="{{ old('email') }}" placeholder="Email." autocomplete="email" required>
                                </div>

                                <label class="sr-only" for="signup-password">Password</label>
                                <div class="auth-input">
                                    <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                    <input id="signup-password" name="password" type="password" placeholder="Password." autocomplete="new-password" minlength="8" required>
                                </div>

                                <label class="sr-only" for="signup-password-confirmation">Confirm Password</label>
                                <div class="auth-input">
                                    <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                    <input id="signup-password-confirmation" name="password_confirmation" type="password" placeholder="Confirm Password." autocomplete="new-password" minlength="8" required>
                                </div>

                                <button class="auth-button mt-3" type="submit">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="auth-image" aria-hidden="true">
            <div class="auth-image-copy">
                <span>BUILT FOR WHAT'S NEXT</span>
                <p>Find your next<br>favorite device.</p>
            </div>
            <img src="{{ Vite::asset('resources/images/phones/Pova 7 5G.png') }}" alt="">
            <span class="auth-image-index">JT PONSEL <b>·</b> 01 / 04</span>
        </div>
    </main>
@endsection
