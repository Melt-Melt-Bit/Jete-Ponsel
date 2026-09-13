<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#050505">
<title>Pembayaran</title>
<script src="https://cdn.tailwindcss.com"></script>
@vite(['resources/css/pembayaran.css'])
</head>
<body class="bg-black text-white min-h-screen">

  <div class="page-wrap">

    <div class="layout-grid">
      <div>
        <p class="uppercase mb-3">[ Order Summary ]</p>
        <div class="border border-white rounded-md p-4 flex items-center gap-4 mb-8">
          <img src="" class="w-16 h-16 rounded-md bg-white-10">
          <div class="flex-1">
            <p class="font-semibold">IPHONE 17 PRO MAX</p>
            <p class="text-xs text-white/50">SKU: IP17-PM-WHITE</p>
          </div>
          <div class="flex items-center gap-3 border border-white/30 rounded-md px-3 py-1">
            <button class="text-white/70">-</button>
            <span>1</span>
            <button class="text-white/70">+</button>
          </div>
          <p class="font-semibold w-32 text-right">RP17.000.000,00</p>
        </div>

        <p class="uppercase mb-3">[ Order Type ]</p>
        <div class="grid grid-cols-2 gap-4 mb-4">
          <button class="border border-white rounded-md py-3 text-sm font-medium">
            Takeout / Pick Up (Active)
          </button>
          <button class="border border-white/20 rounded-md py-3 text-sm text-white/40 hover:bg-gray-800/20 transition-colors">
            Delivery (Unavailable)
          </button>
        </div>

        <div class="border border-dashed border-white/30 rounded-md p-4 mb-8">
          <p class="text-xs text-white/50 mb-2">PICK UP LOCATION:</p>
          <p class="text-sm font-semibold">JT PONSEL MAIN FLAGSHIP STORE</p>
          <p class="text-xs text-white/50">JL. NGAWI RAYA NO. 42, KEC. NGAWI, KABUPATEN NGAWI, JAWA TIMUR</p>
        </div>

        <p class="uppercase mb-3">[ Payment Method ]</p>
        <div class="grid grid-cols-3 gap-4 mb-6">
          <button class="border border-white rounded-md py-3 text-sm font-medium">Credit Card</button>
          <button class="border border-white/30 rounded-md py-3 text-sm hover:bg-gray-800/20 transition-colors"> Bank Transfer</button>
          <button class="border border-white/30 rounded-md py-3 text-sm hover:bg-gray-800/20 transition-colors">E-Wallet</button>
        </div>

        <div class="mb-4">
          <label class="text-xs text-white/50">CARD NUMBER</label>
          <input type="text" placeholder="XXXX - XXXX - XXXX - XXXX"
            class="w-full mt-1 bg-white/5 border border-white/20 rounded-md px-3 py-3 text-sm placeholder-white/30 outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-xs text-white/50">EXPIRY DATE</label>
            <input type="text" placeholder="MM / YY"
              class="w-full mt-1 bg-white/5 border border-white/20 rounded-md px-3 py-3 text-sm placeholder-white/30 outline-none">
          </div>
          <div>
            <label class="text-xs text-white/50">CVV / CVC</label>
            <input type="text" placeholder="***"
              class="w-full mt-1 bg-white/5 border border-white/20 rounded-md px-3 py-3 text-sm placeholder-white/30 outline-none">
          </div>
        </div>

      </div>

      <div>
        <div class="border border-white/30 rounded-md p-5">
          <p class="font-semibold mb-4 tracking-wide">BILLING SPLIT</p>

          <div class="flex justify-between text-sm text-white/70 mb-2">
            <span>SUBTOTAL</span>
            <span>RP17.000.000,00</span>
          </div>
          <div class="flex justify-between text-sm text-white/70 mb-2">
            <span>TAX (10%)</span>
            <span>RP1.700.000,00</span>
          </div>
          <div class="flex justify-between text-sm text-white/70 mb-4">
            <span>DELIVERY</span>
            <span>RP0,00</span>
          </div>

          <hr class="border-white/20 mb-4">

          <div class="flex justify-between font-semibold mb-5">
            <span>GRAND TOTAL</span>
            <span>RP18.700.000,00</span>
          </div>

          <button class="w-full bg-white text-black font-semibold rounded-md py-3 text-sm mb-3 hover:bg-white/90 transition-colors">
            PLACE ORDER >>
          </button>

          <p class="text-center text-xs text-white/40">Secure Ngawi Connection</p>
        </div>
      </div>

    </div>

    <div class="flex justify-between items-center mt-12 pt-6 border-t border-white/10 text-xs text-white/50">
      <span><- HOME / CART / PAYMENT</span>
      <span class="font-semibold text-white">J+ JT PONSEL</span>
    </div>

  </div>

</body>
</html>