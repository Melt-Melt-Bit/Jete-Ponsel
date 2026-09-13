<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Featured products from JT Ponsel.">
        <title>Featured Products — JT Ponsel</title>
        @vite(['resources/css/featured-product.css', 'resources/js/featured-product.js'])
    </head>
    <body>
        <x-site-header active="products" :cart-href="route('cart')" />

        <main>
            <section class="featured-hero">
                <div>
                    <p class="featured-kicker">JT PONSEL / CURATED COLLECTION</p>
                    <h1>Featured<br><span>Products</span></h1>
                    <p class="featured-intro">Temukan perangkat pilihan dan aksesori terbaik untuk melengkapi gaya hidup digitalmu.</p>
                </div>
                <div class="hero-orbit" aria-hidden="true">
                    <span class="orbit-label">NEW ARRIVALS<br>2026</span>
                    <div class="orbit-circle"></div>
                    <span class="orbit-cross">✳</span>
                </div>
            </section>

            <section class="featured-content" id="products">
                <div class="featured-toolbar">
                    <div>
                        <p class="featured-kicker">HANDPICKED FOR YOU / 01</p>
                        <h2>Recommended products</h2>
                    </div>
                    <label class="product-search">
                        <span aria-hidden="true">⌕</span>
                        <input type="search" placeholder="Search products, brands, or categories..." aria-label="Search products">
                    </label>
                </div>

                @php($earphonesAnchorSet = false)
                <div class="product-grid" id="product-grid">
                    @foreach ($products as $product)
                        <article
                            class="featured-card"
                            data-product-card
                            @if (($product['category'] ?? 'Phone') === 'Earphone' && ! $earphonesAnchorSet)
                                id="earphones"
                                @php($earphonesAnchorSet = true)
                            @endif
                        >
                            <a class="card-link" href="{{ route('detail', ['product' => $product['id']]) }}" aria-label="View {{ $product['name'] }} details"></a>
                            <div class="product-visual">
                                <span class="product-badge">{{ $product['badge'] }}</span>
                                <img src="{{ $product['image'] }}" alt="{{ $product['alt'] }}" loading="lazy">
                            </div>
                            <div class="product-details">
                                <p class="product-brand">{{ $product['brand'] }}</p>
                                <div class="product-title-row">
                                    <h3>{{ $product['name'] }}</h3>
                                    <button class="wishlist" type="button" aria-label="Add {{ $product['name'] }} to wishlist" data-wishlist>♡</button>
                                </div>
                                <p class="product-price">{{ $product['price'] }}</p>
                                <div class="product-rating" aria-label="Rated {{ $product['rating'] }} out of 5">
                                    <span>★★★★★</span>
                                    <small>{{ $product['rating'] }} · {{ $product['reviews'] }} reviews</small>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <p class="empty-products" hidden>No products match your search.</p>
            </section>
        </main>

        <footer class="featured-footer" id="footer">
            <div class="featured-footer-grid">
                <div>
                    <a class="brand-mark" href="{{ route('home') }}" aria-label="JT Ponsel home"><span class="brand-icon"><svg viewBox="0 0 40 40" aria-hidden="true"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span><span>JT<span class="brand-dot">.</span></span></a>
                    <p class="footer-copy">Your premium destination for the latest smartphones, genuine accessories, and reliable electronic services.</p>
                </div>
                <div class="footer-links"><h3>QUICK LINKS</h3><a href="{{ url('/') }}">Home</a><a href="#products">Products</a><a href="#footer">Services</a><a href="#footer">Contact</a></div>
                <div class="footer-links"><h3>PRODUCTS</h3><a href="#products">Apple &amp; Android Devices</a><a href="#products">Smart Accessories</a><a href="#products">Power &amp; Cables</a><a href="#products">Trade-in Program</a></div>
                <div class="footer-links"><h3>SERVICES &amp; CARE</h3><a href="#footer">Official Warranty</a><a href="#footer">Device Repair</a><a href="#footer">Screen Protection</a><a href="#footer">Store Pickup</a></div>
                <div class="footer-links"><h3>CONTACT US</h3><a href="tel:+6281234567890">+62 812-3456-7890</a><a href="mailto:support@jtponsel.com">support@jtponsel.com</a><span>Grand Indonesia Mall, Jakarta</span></div>
            </div>
            <div class="featured-copyright"><span>© 2026 JT Ponsel. All rights reserved.</span><span>Privacy Policy&nbsp;&nbsp; Terms of Service&nbsp;&nbsp; Sitemap</span></div>
        </footer>
    </body>
</html>
