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
        <header class="featured-header">
            <a class="featured-brand" href="{{ url('/') }}" aria-label="JT Ponsel home">
                <span class="featured-logo" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none">
                        <circle cx="24" cy="24" r="23" fill="#0B0B0B" stroke="#F4F4F4" stroke-width="2"/>
                        <path d="M11 29.5C15.7 18.1 27.8 13.2 37.4 18.4C40.1 19.8 42.1 22 43 24.6" stroke="#2685E8" stroke-width="6" stroke-linecap="round"/>
                        <path d="M8.5 24.5C13.5 34.7 25.7 38.1 35.2 31.9C37.7 30.3 39.5 28.2 40.4 25.8" stroke="#F4F4F4" stroke-width="4" stroke-linecap="round"/>
                        <path d="M18 16.5V29.5C18 32.5 20.3 34 23 34C25.5 34 27.5 32.4 27.5 29.5V16.5M15 16.5H30" stroke="#F4F4F4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span>JT Ponsel</span>
            </a>
            <nav class="featured-nav" aria-label="Main navigation">
                <a href="{{ url('/') }}">Home</a>
                <a class="active" href="#products">Products</a>
                <a href="#categories">Services</a>
                <a href="#footer">About Us</a>
                <a href="#footer">Contact</a>
            </nav>
            <a class="featured-login" href="{{ route('login') }}">Sign in <span>↗</span></a>
        </header>

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

                @php
                    $products = [
                        ['brand' => 'OPPO', 'name' => 'A53', 'price' => 'Rp2.499.000', 'rating' => '4.7', 'reviews' => '1.2k', 'badge' => 'Best Seller', 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=800&q=85', 'alt' => 'OPPO A53 smartphone'],
                        ['brand' => 'iQOO', 'name' => 'Z10', 'price' => 'Rp3.999.000', 'rating' => '4.5', 'reviews' => '856', 'badge' => 'Best Seller', 'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=85', 'alt' => 'iQOO Z10 smartphone'],
                        ['brand' => 'Apple', 'name' => 'iPhone 17 Pro Max', 'price' => 'Rp24.999.000', 'rating' => '4.9', 'reviews' => '2.3k', 'badge' => 'New', 'image' => 'https://images.unsplash.com/photo-1592286927505-2fdc8f7d2d2c?auto=format&fit=crop&w=800&q=85', 'alt' => 'iPhone smartphone'],
                        ['brand' => 'Samsung', 'name' => 'Galaxy S25 Ultra', 'price' => 'Rp18.999.000', 'rating' => '4.8', 'reviews' => '4.8k', 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&w=800&q=85', 'alt' => 'Samsung Galaxy smartphone'],
                        ['brand' => 'TANCHJIM', 'name' => 'Bunny', 'price' => 'Rp1.799.000', 'rating' => '4.6', 'reviews' => '532', 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=800&q=85', 'alt' => 'TANCHJIM earphones'],
                        ['brand' => 'CVJ', 'name' => 'Vivian 10mm', 'price' => 'Rp1.299.000', 'rating' => '4.5', 'reviews' => '421', 'badge' => 'Sale', 'image' => 'https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?auto=format&fit=crop&w=800&q=85', 'alt' => 'CVJ in-ear headphones'],
                        ['brand' => 'Google', 'name' => 'Pixel 9 Pro XL', 'price' => 'Rp15.999.000', 'rating' => '4.7', 'reviews' => '1.1k', 'badge' => 'New', 'image' => 'https://images.unsplash.com/photo-1556656793-08538906a9f8?auto=format&fit=crop&w=800&q=85', 'alt' => 'Google Pixel smartphone'],
                        ['brand' => 'Samsung', 'name' => 'Galaxy Buds3 Pro', 'price' => 'Rp2.799.000', 'rating' => '4.6', 'reviews' => '980', 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1606220588913-b3aacb4d2f46?auto=format&fit=crop&w=800&q=85', 'alt' => 'Samsung wireless earbuds'],
                    ];
                @endphp

                <div class="product-grid" id="product-grid">
                    @foreach ($products as $product)
                        <article class="featured-card" data-product-card>
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
                    <a class="featured-brand" href="{{ url('/') }}"><span class="featured-logo" aria-hidden="true"><svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="23" fill="#0B0B0B" stroke="#F4F4F4" stroke-width="2"/><path d="M11 29.5C15.7 18.1 27.8 13.2 37.4 18.4C40.1 19.8 42.1 22 43 24.6" stroke="#2685E8" stroke-width="6" stroke-linecap="round"/><path d="M8.5 24.5C13.5 34.7 25.7 38.1 35.2 31.9C37.7 30.3 39.5 28.2 40.4 25.8" stroke="#F4F4F4" stroke-width="4" stroke-linecap="round"/><path d="M18 16.5V29.5C18 32.5 20.3 34 23 34C25.5 34 27.5 32.4 27.5 29.5V16.5M15 16.5H30" stroke="#F4F4F4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span>JT Ponsel</span></a>
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
