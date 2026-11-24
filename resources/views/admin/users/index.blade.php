@extends('layouts.store')

@section('title', 'Manage users — JT Ponsel')

@section('header')
    <x-site-header />
@endsection

@section('content')
    <main class="mx-auto max-w-7xl px-5 py-10 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[.2em] text-blue-300">Store administration</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Manage users</h1>
                <p class="mt-2 text-sm leading-6 text-white/60">View and edit customer profile details. Addresses are only visible to admins and their account owners.</p>
            </div>
            <a class="rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-white/80 transition hover:bg-white/10" href="{{ route('admin.dashboard') }}">Back to dashboard</a>
        </div>

        @if (session('admin_status'))
            <p class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 px-4 py-3 text-sm text-emerald-100" role="status">{{ session('admin_status') }}</p>
        @endif

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-rose-300/20 bg-rose-300/10 px-4 py-3 text-sm text-rose-100" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <section class="mt-8 overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-white/[.06] to-white/[.02] shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[68rem] text-left text-sm">
                    <thead class="bg-white/[.04] text-xs uppercase tracking-wide text-white/55">
                        <tr>
                            <th class="px-5 py-4">User</th>
                            <th class="px-5 py-4">Email</th>
                            <th class="px-5 py-4">Address</th>
                            <th class="px-5 py-4">Role</th>
                            <th class="px-5 py-4">Account</th>
                            <th class="px-5 py-4"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-10 w-10 shrink-0 place-items-center overflow-hidden rounded-full bg-blue-400/15 font-semibold text-blue-100 ring-1 ring-blue-300/20" aria-hidden="true">
                                            @if ($user->avatar_path)
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $user->avatar_path) }}" alt="">
                                            @else
                                                {{ str($user->name)->substr(0, 1)->upper() }}
                                            @endif
                                        </span>
                                        <span class="font-semibold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-white/70">{{ $user->email }}</td>
                                <td class="max-w-sm px-5 py-4 text-white/60">{{ $user->address ?: 'No address saved' }}</td>
                                <td class="px-5 py-4 text-white/70">{{ $user->is_admin ? 'Admin' : 'Customer' }}</td>
                                <td class="px-5 py-4 text-white/70">
                                    @if ($user->is_admin)
                                        <span class="text-white/45">Protected</span>
                                    @else
                                        <span class="{{ $user->is_banned ? 'text-rose-200' : 'text-emerald-200' }}">
                                            {{ $user->is_banned ? 'Restricted' : 'Active' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <a class="inline-flex rounded-lg bg-blue-500 px-3 py-2 font-semibold text-white transition hover:bg-blue-400" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                                        @unless ($user->is_admin)
                                            <form action="{{ route('admin.users.restriction', $user) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button class="rounded-lg border border-amber-300/30 px-3 py-2 font-semibold text-amber-100 transition hover:bg-amber-300/10" type="submit">
                                                    {{ $user->is_banned ? 'Restore' : 'Restrict' }}
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('admin.users.destroy', $user) }}"
                                                method="post"
                                                data-confirm-submit
                                                data-confirm-title="Remove customer?"
                                                data-confirm-message="This permanently removes the customer account and profile. Existing order history will be preserved."
                                                data-confirm-cancel-label="Keep account"
                                                data-confirm-accept-label="Remove customer"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button class="rounded-lg border border-rose-300/30 px-3 py-2 font-semibold text-rose-100 transition hover:bg-rose-300/10" type="submit">Remove</button>
                                            </form>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-5 py-8 text-center text-white/60" colspan="6">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        @if ($users->hasPages())
            <div class="mt-6">{{ $users->links() }}</div>
        @endif
    </main>
@endsection
