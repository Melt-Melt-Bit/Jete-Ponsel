<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JT Ponsel — Mobile Tech Store</title>
        <meta name="description" content="JT Ponsel — your premium destination for the latest smartphones, genuine accessories, and reliable electronic services.">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-site-header active="home" :cart-href="route('cart.index')" />

        <main>
            <section class="hero" id="home">
                <div class="hero-copy">
                    <p class="eyebrow">EST. 2014 / JAKARTA</p>
                    <h1>JT Ponsel</h1>
                    <p class="hero-subtitle">Hidup JT Ponsel</p>
                    <p class="hero-line">Pelanggan senang kita<br>senang</p>
                    <div class="hero-actions">
                        <a class="button button-dark" href="{{ route('products.index') }}">Browse products <span>↗</span></a>
                        <a class="button button-outline" href="{{ route('login') }}">Sign in <span>↗</span></a>
                    </div>
                </div>
                <div class="hero-art">
                    <span class="hero-art-label">NEW / 2026</span>
                    <div class="hero-ring"></div>
                    <img src="{{ Vite::asset('resources/images/phones/Pova 7 5G.png') }}" alt="TECNO POVA 7 5G smartphone">
                    <span class="hero-art-note">SERIES<br>01 — 05</span>
                </div>
            </section>

            <section class="dark-section" id="categories">
                <div class="wire wire-one"></div>
                <div class="wire wire-two"></div>
                <div class="wire wire-three"></div>
                <div class="wire wire-four"></div>
                <div class="section-inner">
                    <div class="section-heading">
                        <p class="section-kicker">CURATED FOR YOU / 01</p>
                        <h2>Top Categories<br>This Week</h2>
                        <span class="heading-mark">✳</span>
                    </div>
                    <div class="category-layout">
                        <a class="featured-card" href="{{ route('products.index') }}">
                            <div class="card-heading">
                                <span>Featured Product Laptop</span>
                                <strong>Dell XPS 13</strong>
                            </div>
                            <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=1200&q=90" alt="Gaming laptop with vivid RGB lighting">
                            <div class="featured-caption"><span>01</span><span>SEE PRODUCT <b>↗</b></span></div>
                        </a>
                        <div class="small-card-grid">
                            <a class="small-card" href="{{ route('products.index', ['category' => 'phone']) }}">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?auto=format&fit=crop&w=700&q=85" alt="Modern laptop product">
                                <span class="card-number">02</span>
                            </a>
                            <a class="small-card" href="{{ route('products.index', ['category' => 'phone']) }}">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=700&q=85" alt="Retro handheld game console">
                                <span class="card-number">03</span>
                            </a>
                            <a class="small-card" href="{{ route('products.index', ['category' => 'earphone']) }}">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?auto=format&fit=crop&w=700&q=85" alt="Wireless headphones">
                                <span class="card-number">04</span>
                            </a>
                            <a class="small-card" href="{{ route('products.index', ['category' => 'phone']) }}">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>Apple MacBook Pro</strong></div>
                                <img src="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?auto=format&fit=crop&w=700&q=85" alt="Modern laptop product">
                                <span class="card-number">02</span>
                            </article>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>Komputer Retro</strong></div>
                                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=700&q=85" alt="Retro handheld game console">
                                <span class="card-number">03</span>
                            </article>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>boAT Airdopes 141</strong></div>
                                <img src="https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?auto=format&fit=crop&w=700&q=85" alt="Wireless headphones">
                                <span class="card-number">04</span>
                            </article>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>Apple Iphone X</strong></div>
                                <img src="https://images.unsplash.com/photo-1585060544812-6b45742d762f?auto=format&fit=crop&w=700&q=85" alt="Smartphone on a neutral background">
                                <span class="card-number">05</span>
                            </a>
                        </div>
                    </div>

                    <div class="seller-heading" id="best-seller">
                        <div><p class="section-kicker">FAN FAVOURITES / 02</p><h2>Best Seller</h2></div>
                        <a class="view-all" href="{{ route('products.index') }}">View all products <span>↗</span></a>
                    </div>
                    <div class="product-grid">
                        @forelse ($featuredProducts as $product)
                            <article class="product-card">
                                <a href="{{ route('products.show', $product) }}" aria-label="View {{ $product->brand }} {{ $product->name }}">
                                    <div class="product-image"><img src="{{ $product->image_url }}" alt="{{ $product->brand }} {{ $product->name }}"></div>
                                    <div class="product-info">
                                        <p>{{ $product->brand }}</p>
                                        <h3>{{ $product->name }}</h3>
                                        <strong>{{ $product->formatted_price }}</strong>
                                    </div>
                                </a>
                                <form class="px-6 pb-6" action="{{ route('cart.store', $product) }}" method="post">
                                    @csrf
                                    <button class="button button-dark" type="submit" @disabled($product->stock < 1)>Add to cart</button>
                                </form>
                            </article>
                        @empty
                            <p>No products are available yet. Check back soon.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer" id="footer">
            <div class="footer-inner">
                <div class="footer-brand">
                    <a class="footer-logo" href="#home"><span class="brand-icon"><svg viewBox="0 0 40 40" aria-hidden="true"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span>JT Ponsel</a>
                    <p class="footer-tagline">MOBILE TECH STORE</p>
                    <p class="footer-description">Your premium destination for the latest smartphones, genuine accessories, and reliable electronic services. Discover the future of connectivity with JT Ponsel.</p>
                    <div class="socials"><a href="#footer" aria-label="Instagram">ig</a><a href="#footer" aria-label="Facebook">f</a><a href="#footer" aria-label="TikTok">tk</a><a href="#footer" aria-label="WhatsApp">wa</a></div>
                </div>
                <div class="footer-column"><h3>QUICK LINKS</h3><a href="#categories">Products</a><a href="#footer">Services</a><a href="#footer">About Us</a><a href="#footer">Contact</a><a href="#footer">Promotions <em>NEW</em></a></div>
                <div class="footer-column"><h3>PRODUCTS</h3><a href="#categories">Apple iPhone</a><a href="#categories">Android Flagships</a><a href="#categories">Smart Accessories</a><a href="#categories">Power &amp; Cables</a><a href="#footer">Trade-in Program</a></div>
                <div class="footer-column"><h3>SERVICES &amp; CARE</h3><a href="#footer">Official Warranty</a><a href="#footer">Device Repair</a><a href="#footer">Screen Protection</a><a href="#footer">Software Upgrade</a><a href="#footer">Store Pickup</a></div>
                <div class="footer-column contact-column"><h3>CONTACT US</h3><p><span>⌁</span><b>Call Center Support</b><strong>+62 812-3456-7890</strong></p><p><span>@</span><b>Email Assistance</b><strong>support@jtponsel.com</strong></p><p><span>⌖</span><b>Retail Headquarters</b><strong>Grand Indonesia Mall, Lt. 3, Jakarta</strong></p></div>
            </div>
            <div class="copyright"><span>© 2026 JT Ponsel. All rights reserved. Your trusted gadget partner.</span><div><a href="#footer">Privacy Policy</a><a href="#footer">Terms of Service</a><a href="#footer">Sitemap</a></div></div>
        </footer>
    </body>
</html>
