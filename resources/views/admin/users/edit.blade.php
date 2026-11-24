@extends('layouts.store')

@section('title', 'Edit user — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-4xl px-5 py-10 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[.2em] text-blue-300">User management</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Edit user profile</h1>
                <p class="mt-2 text-sm leading-6 text-white/60">Update the name, email, address, or profile photo for {{ $user->name }}.</p>
            </div>
            <a class="rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-white/80 transition hover:bg-white/10" href="{{ route('admin.users.index') }}">Back to users</a>
        </div>

        @if (session('admin_status'))
            <p class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 px-4 py-3 text-sm text-emerald-100" role="status">{{ session('admin_status') }}</p>
        @endif

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-rose-300/20 bg-rose-300/10 px-4 py-3 text-sm text-rose-100" role="alert">
                <p class="font-semibold">Please review the highlighted fields.</p>
                @foreach ($errors->all() as $error)
                    <p class="mt-1">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-8 rounded-3xl border border-white/10 bg-gradient-to-br from-white/[.06] to-white/[.02] p-5 shadow-xl sm:p-8" action="{{ route('admin.users.update', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="grid gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 text-sm font-medium text-white/80">
                    Name
                    <input class="rounded-xl border border-white/15 bg-black/30 px-3 py-3 text-white" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" maxlength="255" required>
                </label>
                <label class="flex flex-col gap-2 text-sm font-medium text-white/80">
                    Email
                    <input class="rounded-xl border border-white/15 bg-black/30 px-3 py-3 text-white" name="email" type="email" value="{{ old('email', $user->email) }}" autocomplete="email" maxlength="255" required>
                </label>
            </div>

            <label class="mt-5 flex flex-col gap-2 text-sm font-medium text-white/80">
                Address
                <textarea class="min-h-36 resize-y rounded-xl border border-white/15 bg-black/30 px-3 py-3 text-white" name="address" rows="5" maxlength="2000">{{ old('address', $user->address) }}</textarea>
            </label>

            <div class="mt-5">
                <label class="flex flex-col gap-2 text-sm font-medium text-white/80" for="avatar">Profile photo</label>
                @if ($user->avatar_path)
                    <img class="mt-3 h-16 w-16 rounded-full object-cover ring-1 ring-white/20" src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }} profile photo">
                @endif
                <input class="mt-3 block w-full rounded-xl border border-white/15 bg-black/30 px-3 py-3 text-sm text-white file:mr-3 file:rounded-lg file:border-0 file:bg-white/10 file:px-3 file:py-2 file:text-white" id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <p class="mt-2 text-xs leading-5 text-white/50">Optional. JPG, PNG, or WebP up to 2 MB.</p>
            </div>

            <div class="mt-7 flex flex-wrap items-center justify-between gap-4 border-t border-white/10 pt-6">
                <p class="text-xs leading-5 text-white/45">Admin access cannot be changed here.</p>
                <button class="rounded-xl bg-blue-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300" type="submit">Save user profile</button>
            </div>
        </form>
    </main>
@endsection
