@extends('layouts.store')

@section('title', 'Akun saya | JT Ponsel')

@push('styles')
    @vite(['resources/css/profile.css'])
@endpush

@section('header')
    <x-site-header active="profile" />
@endsection

@section('content')
    @php
        $profileUser = auth()->user();
        $statusLabels = [
            'pending' => 'Menunggu konfirmasi',
            'ready_for_pickup' => 'Siap diambil',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
        $statusClasses = [
            'pending' => 'bg-amber-400/10 text-amber-200 ring-amber-300/20',
            'ready_for_pickup' => 'bg-blue-400/10 text-blue-200 ring-blue-300/20',
            'completed' => 'bg-emerald-400/10 text-emerald-200 ring-emerald-300/20',
            'cancelled' => 'bg-rose-400/10 text-rose-200 ring-rose-300/20',
        ];
    @endphp

    <main class="profile-page min-h-[calc(100vh-82px)] px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <div class="mx-auto max-w-7xl">
            <header class="mb-8">
                <p class="text-xs font-semibold uppercase tracking-[.2em] text-blue-300">Akun pelanggan</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Akun saya</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/60">Kelola informasi akun dan pantau pesanan Anda di satu tempat.</p>
            </header>

            <div class="grid min-w-0 gap-6 lg:grid-cols-[17rem_minmax(0,1fr)]">
                <aside class="min-w-0">
                    <section class="profile-panel overflow-hidden rounded-3xl border border-white/10">
                        <div class="flex min-w-0 items-center gap-4 p-5">
                            <div class="grid h-14 w-14 shrink-0 place-items-center overflow-hidden rounded-full bg-blue-400/15 text-xl font-bold text-blue-200 ring-1 ring-blue-300/20">
                                @if ($profileUser->avatar_path)
                                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $profileUser->avatar_path) }}" alt="{{ $profileUser->name }} profile photo">
                                @else
                                    <span aria-hidden="true">{{ str($profileUser->name)->substr(0, 1)->upper() }}</span>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="truncate font-semibold">{{ $profileUser->name }}</p>
                                <p class="break-all text-xs leading-5 text-white/55">{{ $profileUser->email }}</p>
                            </div>
                        </div>

                        <nav class="grid grid-cols-2 gap-2 border-t border-white/10 p-3 sm:grid-cols-3 lg:grid-cols-1" aria-label="Navigasi akun">
                            <a class="profile-nav-link {{ $section === 'profile' ? 'is-active' : '' }}" href="{{ route('profile') }}" @if ($section === 'profile') aria-current="page" @endif>
                                <span>Data diri</span>
                                <span aria-hidden="true">›</span>
                            </a>
                            <a class="profile-nav-link {{ $section === 'orders' ? 'is-active' : '' }}" href="{{ route('profile', ['section' => 'orders']) }}" @if ($section === 'orders') aria-current="page" @endif>
                                <span>Riwayat pesanan</span>
                                <span aria-hidden="true">›</span>
                            </a>
                            <a class="profile-nav-link {{ $section === 'address' ? 'is-active' : '' }}" href="{{ route('profile', ['section' => 'address']) }}" @if ($section === 'address') aria-current="page" @endif>
                                <span>Alamat</span>
                                <span aria-hidden="true">›</span>
                            </a>
                            <a class="profile-nav-link {{ $section === 'vouchers' ? 'is-active' : '' }}" href="{{ route('profile', ['section' => 'vouchers']) }}" @if ($section === 'vouchers') aria-current="page" @endif>
                                <span>Voucher saya</span>
                                <span aria-hidden="true">›</span>
                            </a>
                            <a class="profile-nav-link {{ $section === 'security' ? 'is-active' : '' }}" href="{{ route('profile', ['section' => 'security']) }}" @if ($section === 'security') aria-current="page" @endif>
                                <span>Keamanan</span>
                                <span aria-hidden="true">›</span>
                            </a>
                            <a class="profile-nav-link {{ $section === 'notifications' ? 'is-active' : '' }}" href="{{ route('profile', ['section' => 'notifications']) }}" @if ($section === 'notifications') aria-current="page" @endif>
                                <span>Notifikasi</span>
                                <span aria-hidden="true">›</span>
                            </a>
                        </nav>

                        <div class="border-t border-white/10 p-3">
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
                                <button class="profile-nav-link w-full justify-start text-rose-200 hover:bg-rose-400/10" type="submit">Keluar dari akun</button>
                            </form>
                        </div>
                    </section>
                </aside>

                <section class="profile-panel min-w-0 rounded-3xl border border-white/10 p-5 sm:p-8 lg:p-10">
                    @if ($section === 'orders')
                        <div class="flex flex-wrap items-end justify-between gap-4 border-b border-white/10 pb-6">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[.18em] text-blue-300">Aktivitas akun</p>
                                <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Riwayat pesanan</h2>
                                <p class="mt-2 text-sm text-white/55">Lihat detail dan status pengambilan pesanan Anda.</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs text-white/65">{{ $orders->total() }} pesanan</span>
                        </div>

                        <div class="mt-6 flex flex-col gap-3">
                            @forelse ($orders as $order)
                                <a class="group grid min-w-0 gap-4 rounded-2xl border border-white/10 bg-black/20 p-4 transition hover:border-blue-300/30 hover:bg-white/[.04] sm:grid-cols-[minmax(0,1fr)_auto] sm:items-center sm:p-5" href="{{ route('account.orders.show', $order) }}">
                                    <div class="min-w-0">
                                        <p class="break-all font-semibold">{{ $order->order_number }}</p>
                                        <p class="mt-1 text-xs text-white/50">{{ $order->created_at->format('d M Y, H:i') }} · {{ $order->items->sum('quantity') }} barang</p>
                                    </div>
                                    <div class="flex items-center justify-between gap-4 sm:justify-end">
                                        <div class="text-left sm:text-right">
                                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium ring-1 {{ $statusClasses[$order->status] ?? 'bg-white/5 text-white/70 ring-white/10' }}">
                                                {{ $statusLabels[$order->status] ?? ucfirst(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                            <p class="mt-2 font-semibold">{{ $order->formatted_total }}</p>
                                        </div>
                                        <span class="text-lg text-white/40 transition group-hover:translate-x-1 group-hover:text-blue-200" aria-hidden="true">→</span>
                                    </div>
                                </a>
                            @empty
                                <div class="rounded-2xl border border-dashed border-white/15 bg-black/10 px-5 py-12 text-center">
                                    <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-white/5 text-xl text-blue-200" aria-hidden="true">↗</div>
                                    <h3 class="mt-4 font-semibold">Belum ada pesanan</h3>
                                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-white/55">Pesanan yang Anda buat akan muncul di sini beserta status pengambilannya.</p>
                                    <a class="mt-6 inline-flex rounded-xl bg-blue-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-400" href="{{ route('products.index') }}">Jelajahi produk</a>
                                </div>
                            @endforelse
                        </div>

                        @if ($orders->hasPages())
                            <div class="mt-6">{{ $orders->links() }}</div>
                        @endif
                    @elseif ($section === 'address')
                        <div class="border-b border-white/10 pb-6">
                            <p class="text-xs font-semibold uppercase tracking-[.18em] text-blue-300">Informasi akun</p>
                            <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Alamat</h2>
                            <p class="mt-2 text-sm leading-6 text-white/55">Simpan alamat yang ingin digunakan untuk kebutuhan akun Anda.</p>
                        </div>

                        @if (session('status'))
                            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 px-4 py-3 text-sm text-emerald-100" role="status">
                                {{ session('status') }}
                            </div>
                        @endif

                        @error('address')
                            <div class="mt-6 rounded-xl border border-rose-300/20 bg-rose-300/10 px-4 py-3 text-sm text-rose-100" role="alert">{{ $message }}</div>
                        @enderror

                        <form class="mt-6 space-y-6" action="{{ route('profile.update') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="section" value="address">

                            <div>
                                <label class="text-sm font-medium text-white/80" for="address">Alamat lengkap</label>
                                <textarea class="profile-input mt-2 min-h-36 resize-y" id="address" name="address" rows="5" maxlength="2000" aria-invalid="{{ $errors->has('address') ? 'true' : 'false' }}">{{ old('address', $profileUser->address) }}</textarea>
                                <p class="mt-2 text-xs leading-5 text-white/45">Alamat ini hanya tersimpan di profil Anda.</p>
                            </div>

                            <div class="flex justify-end border-t border-white/10 pt-6">
                                <button class="inline-flex items-center justify-center rounded-xl bg-blue-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300" type="submit">
                                    Simpan alamat
                                </button>
                            </div>
                        </form>
                    @elseif ($section === 'vouchers')
                        <div class="border-b border-white/10 pb-6">
                            <p class="text-xs font-semibold uppercase tracking-[.18em] text-blue-300">Benefit akun</p>
                            <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Voucher saya</h2>
                        </div>
                        <div class="profile-empty-state mt-6 rounded-2xl border border-dashed border-white/15 bg-black/10 px-5 py-12 text-center">
                            <div class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-white/5 text-xl text-blue-200" aria-hidden="true">%</div>
                            <p class="mt-4 font-medium">Anda belum memiliki voucher saat ini.</p>
                        </div>
                    @elseif ($section === 'security' || $section === 'notifications')
                        <div class="border-b border-white/10 pb-6">
                            <p class="text-xs font-semibold uppercase tracking-[.18em] text-blue-300">Informasi akun</p>
                            <h2 class="mt-2 text-2xl font-bold sm:text-3xl">{{ $section === 'security' ? 'Keamanan' : 'Notifikasi' }}</h2>
                        </div>
                        <div class="profile-empty-state mt-6 rounded-2xl border border-dashed border-white/15 bg-black/10 px-5 py-12 text-center">
                            <div class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-white/5 text-xl text-blue-200" aria-hidden="true">✦</div>
                            <p class="mt-4 font-medium">Placeholder coming soon.</p>
                        </div>
                    @else
                        <div class="border-b border-white/10 pb-6">
                            <p class="text-xs font-semibold uppercase tracking-[.18em] text-blue-300">Informasi akun</p>
                            <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Data diri</h2>
                            <p class="mt-2 text-sm leading-6 text-white/55">Perbarui nama dan email yang digunakan pada akun Anda.</p>
                        </div>

                        @if (session('status'))
                            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 px-4 py-3 text-sm text-emerald-100" role="status">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mt-6 rounded-xl border border-rose-300/20 bg-rose-300/10 px-4 py-3 text-sm text-rose-100" role="alert">
                                Periksa kembali informasi yang Anda masukkan.
                            </div>
                        @endif

                        <form class="mt-6 space-y-6" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="section" value="profile">

                            <div class="grid gap-5 md:grid-cols-2">
                                <div class="min-w-0">
                                    <label class="text-sm font-medium text-white/80" for="name">Nama lengkap</label>
                                    <input class="profile-input mt-2" id="name" name="name" type="text" value="{{ old('name', $profileUser->name) }}" autocomplete="name" maxlength="255" required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" @if ($errors->has('name')) aria-describedby="name-error" @endif>
                                    @error('name')
                                        <p class="mt-2 text-xs text-rose-200" id="name-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="min-w-0">
                                    <label class="text-sm font-medium text-white/80" for="email">Alamat email</label>
                                    <input class="profile-input mt-2" id="email" name="email" type="email" value="{{ old('email', $profileUser->email) }}" autocomplete="email" maxlength="255" required aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @if ($errors->has('email')) aria-describedby="email-error" @endif>
                                    @error('email')
                                        <p class="mt-2 text-xs text-rose-200" id="email-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="max-w-xl">
                                <label class="text-sm font-medium text-white/80" for="avatar">Foto profil</label>
                                <input class="profile-input mt-2" id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" aria-invalid="{{ $errors->has('avatar') ? 'true' : 'false' }}" @if ($errors->has('avatar')) aria-describedby="avatar-error" @endif>
                                <p class="mt-2 text-xs leading-5 text-white/45">Gunakan JPG, PNG, atau WebP hingga 2 MB. Foto akan tampil dalam lingkaran.</p>
                                @error('avatar')
                                    <p class="mt-2 text-xs text-rose-200" id="avatar-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap items-center justify-between gap-4 border-t border-white/10 pt-6">
                                <p class="text-xs leading-5 text-white/45">Email harus unik dan akan digunakan untuk masuk.</p>
                                <button class="inline-flex items-center justify-center rounded-xl bg-blue-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300" type="submit">
                                    Simpan perubahan
                                </button>
                            </div>
                        </form>
                    @endif
                </section>
            </div>
        </div>
    </main>
@endsection