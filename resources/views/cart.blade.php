<!DOCTYPE html>
<html lang=" {{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#050505">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shopping Cart - {{ config('app.name', 'JT Ponsel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rubik:wght@500;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/cart.css', 'resources/js/cart.js'])
</head>

<body class="min-h-screen bg-black font-sans text-white antialiased">

    {{-- Header --}}
    <header class="Cart-Header">
        <a href="{{ url()->previous() }}"
            class="flex items-center gap-3 font-display text-xs tracking-widest uppercase">
            <span class="text-xl">&larr;</span> Home / Cart
        </a>
        <a href="{{ route('home') }}" class="brand-mark" aria-label="JT Ponsel home">
            <span class="brand-icon" aria-hidden="true"><svg viewBox="0 0 40 40"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span>
            <span>JT<span class="brand-dot">.</span></span>
        </a>
    </header>

    {{-- Main --}}
    <main class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-6 p-8 items-start">
        {{-- Left --}}
        <section class="Cart-Panel">
            <h1>Shopping Cart</h1>
            <hr class="border-2 border-[#A7A7A7] mb-3">

            {{-- Item 1 --}}
            <div class="Cart-Item">

                <div class="flex items-center gap-4">
                    <input type="checkbox" class="w-5 h-5 border-[#A7A7A7] rounded-sm focus:ring-0 focus:outline-none">

                    <img src="https://www.obastyle.com/24363-large_default/colour-xiaomi-redmi-11a-12c-orange.jpg"
                        alt="" class="border-2 border-black-300 w-30 h-30">

                    <div class="flex-1 self-start flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span>Casing HP Redmi 12C Terbaik <p class=" font-light text-sm">Casing ini merupakan casing
                                    yang dipakai oleh <br> handphone Redmi 12C....</p></span>
                            <a href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>

                        <div class="flex items-center gap-10 w-full mt-2">
                            <select name="" id="" class="border-2 border-black-300 rounded text-black mt-2 py-1 px-3">
                                <option value="Orange">Orange</option>
                                <option value="Hitam">Hitam</option>
                                <option value="Blue">Blue</option>
                            </select>

                            <div class="flex items-center mt-2 border-2 border-black-300 rounded">
                                <button type="button" id="btnKurang" class=" text-black py-1 px-3 rounded-l">
                                    -
                                </button>

                                <span class=" text-black py-1 px-3" id="qty">
                                    1
                                </span>

                                <button type="button" id="btnTambah" class=" text-black py-1 px-3 rounded-r">
                                    +
                                </button>
                            </div>

                            <span class="text-lg font-bold ml-auto">Rp 199.000</span>
                        </div>
                    </div>
                </div>
            </div>



            {{-- Item 2 --}}
            <div class="Cart-Item">

                <div class="flex items-center gap-4">
                    <input type="checkbox" class="w-5 h-5 border-[#A7A7A7] rounded-sm focus:ring-0 focus:outline-none">

                    <img src="https://www.obastyle.com/24363-large_default/colour-xiaomi-redmi-11a-12c-orange.jpg"
                        alt="" class="border-2 border-black-300 w-30 h-30">

                    <div class="flex-1 self-start flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span>Casing HP Redmi 12C Terbaik <p class=" font-light text-sm">Casing ini merupakan
                                    casing
                                    yang dipakai oleh <br> handphone Redmi 12C....</p></span>
                            <a href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>

                        <div class="flex items-center gap-10 w-full mt-2">
                            <select name="" id="" class="border-2 border-black-300 rounded text-black mt-2 py-1 px-3">
                                <option value="Orange">Orange</option>
                                <option value="Hitam">Hitam</option>
                                <option value="Blue">Blue</option>
                            </select>

                            <div class="flex items-center mt-2 border-2 border-black-300 rounded">
                                <button type="button" id="btnKurang" class=" text-black py-1 px-3 rounded-l">
                                    -
                                </button>

                                <span class=" text-black py-1 px-3" id="qty">
                                    1
                                </span>

                                <button type="button" id="btnTambah" class=" text-black py-1 px-3 rounded-r">
                                    +
                                </button>
                            </div>

                            <span class="text-lg font-bold ml-auto">Rp 199.000</span>
                        </div>
                    </div>
                </div>
            </div>



            {{-- Item 3 --}}
            <div class="Cart-Item">

                <div class="flex items-center gap-4">
                    <input type="checkbox" class="w-5 h-5 border-[#A7A7A7] rounded-sm focus:ring-0 focus:outline-none">

                    <img src="https://www.obastyle.com/24363-large_default/colour-xiaomi-redmi-11a-12c-orange.jpg"
                        alt="" class="border-2 border-black-300 w-30 h-30">

                    <div class="flex-1 self-start flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span>Casing HP Redmi 12C Terbaik <p class=" font-light text-sm">Casing ini
                                    merupakan casing
                                    yang dipakai oleh <br> handphone Redmi 12C....</p></span>
                            <a href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>

                        <div class="flex items-center gap-10 w-full mt-2">
                            <select name="" id="" class="border-2 border-black-300 rounded text-black mt-2 py-1 px-3">
                                <option value="Orange">Orange</option>
                                <option value="Hitam">Hitam</option>
                                <option value="Blue">Blue</option>
                            </select>

                            <div class="flex items-center mt-2 border-2 border-black-300 rounded">
                                <button type="button" id="btnKurang" class=" text-black py-1 px-3 rounded-l">
                                    -
                                </button>

                                <span class=" text-black py-1 px-3" id="qty">
                                    1
                                </span>

                                <button type="button" id="btnTambah" class=" text-black py-1 px-3 rounded-r">
                                    +
                                </button>
                            </div>

                            <span class="text-lg font-bold ml-auto">Rp 199.000</span>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        {{-- Right --}}
        <section class="Cart-Summary">
            <div class="gap-2 flex items-center">
                <input type="checkbox" class="w-5 h-5 border-[#A7A7A7] rounded-sm focus:ring-0 focus:outline-none">
                <span>Select All</span>
            </div>

            <div class="flex items-center justify-between mt-3">
                <span>Total Items</span>
                <span>3</span>
            </div>

            <div class="flex items-center justify-between mt-3">
                <span>Voucher</span>
                <a href="#">Select or Enter Code</a>
            </div>

            <hr class="border-2 border-dashed border-[#A7A7A7] mb-3 mt-2">

            <div class="flex items-center justify-between mt-3">
                <span>Grand Total</span>
                <span>Rp 0</span>
            </div>

            <a href="{{ route('pembayaran') }}"
                class="w-full bg-[#ffffff] text-black font-bold py-2 px-4 rounded mt-6 hover:bg-[#e69f1f] transition duration-300">
                Checkout
            </a>
        </section>
    </main>
</body>