<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#050505">
<title>Pembayaran</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/pembayaran.css', 'resources/js/pembayaran.js'])
</head>
<body class="bg-black text-white min-h-screen overflow-x-hidden">

  
  <main class="min-h-screen flex flex-col md:flex-row overflow-hidden bg-gradient-to-b from-[#0f0f0f] to-[#222]">

    
    <section class="md:w-[47%] text-white px-10 py-10 md:px-24 flex flex-col">

      <a href="{{ route('home') }}" class="flex items-center gap-3 font-bold tracking-tight">
        <span class="grid h-8 w-8 place-items-center"><svg class="h-8 w-8" viewBox="0 0 40 40" aria-hidden="true"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span>
        <span>JT<span class="text-[#2685e8]">.</span></span>
      </a>

      <div class="flex-1 flex flex-col justify-center py-16">
        <h1 class="text-5xl md:text-6xl leading-tight font-medium mb-16">
          Billing Split of Payment
        </h1>

        <div class="space-y-3 text-xl text-gray-300">
          <div class="flex justify-between">
            <span>SUBTOTAL</span>
            <span>Rp17.000.000,00</span>
          </div>
          <div class="flex justify-between">
            <span>Tax (10%)</span>
            <span>Rp1.700.000,00</span>
          </div>
          <div class="flex justify-between text-gray-500">
            <span>Delivery</span>
            <span>Rp0,00</span>
          </div>
        </div>

        <hr class="my-8 border-gray-600">

        <div class="flex justify-between items-center font-semibold text-white">
          <span class="text-2xl">GRAND TOTAL</span>
          <span class="text-3xl">RP18.700.000,00</span>
        </div>

        <button type="button" class="mt-12 w-full bg-white text-black text-3xl font-medium py-4 rounded-xl hover:bg-gray-200 transition">
          Place Order &gt;&gt;
        </button>

        <p class="text-center text-xs text-white/40 mt-4">Secure Ngawi Connection</p>
      </div>

      <div class="flex justify-between items-center pt-6 border-t border-white/10 text-xs text-white/50">
        <span>&larr; HOME / CART / PAYMENT</span>
        <span class="font-semibold text-white">J+ JT PONSEL</span>
      </div>
    </section>


    <section
      id="panel"
      class="md:w-[53%] bg-white text-black px-8 py-14 md:px-16
             rounded-t-[40px] md:rounded-r-none md:rounded-l-[40px]"
    >
      <!-- Method / Order Summary -->
      <h2 class="text-4xl font-semibold mb-8">Method</h2>

      <div class="flex items-center bg-gray-100 rounded-lg shadow-md overflow-hidden mb-14">
        <img src="" alt="" class="w-32 h-32 object-cover shrink-0 bg-gradient-to-br from-amber-200 to-orange-300">

        <div class="flex-1 px-4 sm:px-8">
          <p class="text-2xl font-medium">IPhone 17 Pro Max</p>
          <p class="text-xs mt-2">SKU: IP17-PM-WHITE</p>
          <p class="text-sm font-semibold mt-2">RP17.000.000,00</p>
        </div>

        <div class="flex items-center gap-3 pr-4 sm:pr-6">
          <button type="button" class="w-9 h-9 border-2 border-black rounded-md font-bold">-</button>
          <span class="text-xl w-4 text-center">1</span>
          <button type="button" class="w-9 h-9 border-2 border-black rounded-md font-bold">+</button>
        </div>
      </div>

      <!-- Order Type -->
      <h2 class="text-3xl font-medium mb-6">Order Type</h2>
      <div class="grid grid-cols-2 gap-2 mb-6">
        <button type="button" class="bg-[#111] text-white font-medium py-4 rounded-md shadow-md">
          Takeout / Pick Up (Active)
        </button>
        <button type="button" aria-disabled="true" class="bg-gray-300 text-gray-400 font-medium py-4 rounded-md shadow-md cursor-not-allowed">
          Delivery (Unavailable)
        </button>
      </div>

      <div class="border-2 border-dashed border-gray-700 bg-gray-200 rounded-xl px-10 py-6 shadow-md mb-14">
        <p class="text-sm font-medium mb-1">PICK UP LOCATION:</p>
        <p class="text-xs font-semibold">JT PONSEL MAIN FLAGSHIP STORE</p>
        <p class="text-[10px] text-gray-500 mt-1">
          JL. NGAWI RAYA NO. 42, KEC. NGAWI, KABUPATEN NGAWI, JAWA TIMUR
        </p>
      </div>

      <!-- Payment Method -->
      <h2 class="text-3xl font-medium mb-6">Payment Method</h2>
      <div class="grid grid-cols-3 gap-4 mb-6">
        <button type="button" class="bg-[#111] text-white font-medium py-4 rounded-md shadow-md">Credit Card</button>
        <button type="button" class="bg-gray-300 text-gray-500 font-medium py-4 rounded-md shadow-md hover:bg-gray-400/60 transition-colors">Bank Transfer</button>
        <button type="button" class="bg-gray-300 text-gray-500 font-medium py-4 rounded-md shadow-md hover:bg-gray-400/60 transition-colors">E-Wallet</button>
      </div>

      <!-- Form kartu -->
      <div class="bg-gray-100 border border-gray-300 rounded-xl p-8 shadow-md">
        <label class="block text-sm font-medium mb-2">CARD NUMBER</label>
        <input type="text" placeholder="XXXX - XXXX - XXXX - XXXX"
          class="w-full bg-gray-200 rounded-md h-10 px-3 mb-6 text-sm placeholder-gray-400 outline-none focus:ring-2 focus:ring-black">

        <div class="grid grid-cols-2 gap-8">
          <div>
            <label class="block text-sm font-medium mb-2">EXPIRY DATE</label>
            <input type="text" placeholder="MM / YY"
              class="w-full bg-gray-200 rounded-md h-10 px-3 text-sm placeholder-gray-400 outline-none focus:ring-2 focus:ring-black">
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">CVV / CVC</label>
            <input type="text" placeholder="***"
              class="w-full bg-gray-200 rounded-md h-10 px-3 text-sm placeholder-gray-400 outline-none focus:ring-2 focus:ring-black">
          </div>
        </div>
      </div>
    </section>

  </main>

</body>
</html>
