<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JT Ponsel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

</head>
<body>

    <header class="site-header">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="JT Ponsel logo">
            <span>JT Ponsel</span>
        </div>
        <ul class="main-nav">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">Phone</a></li>
            <li><a href="#">Earphone</a></li>
            <li><a href="#">Tablet</a></li>
            <li><a href="#">Casing</a></li>
            <li><a href="#">More</a></li>
        </ul>
    </header>

    {{-- ============ HERO with scroll-scrub phone animation ============ --}}
    {{--
        hero-pin-track is the tall element that "owns" the scroll distance.
        Its height (400vh below, set in app.css) controls how much scrolling
        it takes to play through the whole frame sequence — taller = slower,
        more deliberate rotation; shorter = quicker.
    --}}
    <section class="hero-pin-track" id="hero">
        <div class="hero-sticky">
            <div class="hero-pattern"></div>

            <div class="hero-copy">
                <h1>JT Ponsel</h1>
                <p>Hidup JT Ponsel</p>
                <p class="line-green">Pelanggan senang kita</p>
                <p class="line-pink">senang</p>

                <div class="hero-actions">
                    <a href="#" class="btn">Learn More</a>
                    <a href="#" class="btn secondary">Lihat Produk</a>
                </div>
            </div>

            <div class="phone-stage">
                <canvas id="phone-canvas" width="900" height="1100" aria-label="Animated phone rotating in place"></canvas>
            </div>

            <div class="scroll-progress-wrap">
                <div class="scroll-progress-bar" id="hero-progress"></div>
            </div>
            <div class="scroll-hint">Scroll to rotate</div>
        </div>
    </section>

    {{-- ============ Rest of the page (placeholder) ============ --}}
    <section class="section">
        <h2>Produk terbaru</h2>
        <p>Konten di bawah ini masih placeholder — tinggal diisi dengan produk, kategori, atau apa pun yang kamu mau tampilkan setelah animasi hero selesai.</p>
    </section>


</body>
</html>
