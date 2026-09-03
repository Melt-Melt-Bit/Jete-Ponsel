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
        <header class="site-header">
            <a class="brand-mark" href="/" aria-label="JT Ponsel home">
                <span class="brand-icon">
                    <svg viewBox="0 0 40 40" aria-hidden="true"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                </span>
                <span>JT<span class="brand-dot">.</span></span>
            </a>
            <nav class="main-nav" aria-label="Main navigation">
                <a class="active" href="#home">Home</a>
                <a href="#categories">Phone</a>
                <a href="#categories">Earphone</a>
                <a href="#categories">Tablet</a>
                <a href="#categories">Casing</a>
                <a href="#footer">More</a>
            </nav>
            <a class="cart-button" href="#best-seller" aria-label="View best seller products">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 4h2l2.2 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 1.9-1.4L21 8H6M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </header>

        <main>
            <section class="hero" id="home">
                <div class="hero-copy">
                    <p class="eyebrow">EST. 2014 / JAKARTA</p>
                    <h1>JT Ponsel</h1>
                    <p class="hero-subtitle">Hidup JT Ponsel</p>
                    <p class="hero-line">Pelanggan senang kita<br>senang</p>
                    <div class="hero-actions">
                        <a class="button button-dark" href="#categories">Learn More <span>↗</span></a>
                        <a class="button button-outline" href="login.blade.php">ntr kasi nma <span>↗</span></a>
                    </div>
                </div>
                <div class="hero-art">
                    <span class="hero-art-label">NEW / 2026</span>
                    <div class="hero-ring"></div>
                    <img src="https://images.unsplash.com/photo-1592286927505-2fdc8f7d2d2c?auto=format&fit=crop&w=900&q=90" alt="Light blue smartphone">
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
                        <article class="featured-card">
                            <div class="card-heading">
                                <span>Featured Product Laptop</span>
                                <strong>JT abcdef</strong>
                            </div>
                            <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=1200&q=90" alt="Gaming laptop with vivid RGB lighting">
                            <div class="featured-caption"><span>01</span><span>SEE PRODUCT <b>↗</b></span></div>
                        </article>
                        <div class="small-card-grid">
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?auto=format&fit=crop&w=700&q=85" alt="Modern laptop product">
                                <span class="card-number">02</span>
                            </article>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=700&q=85" alt="Retro handheld game console">
                                <span class="card-number">03</span>
                            </article>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?auto=format&fit=crop&w=700&q=85" alt="Wireless headphones">
                                <span class="card-number">04</span>
                            </article>
                            <article class="small-card">
                                <div class="card-heading"><span>Featured Product Laptop</span><strong>abcdef</strong></div>
                                <img src="https://images.unsplash.com/photo-1585060544812-6b45742d762f?auto=format&fit=crop&w=700&q=85" alt="Smartphone on a neutral background">
                                <span class="card-number">05</span>
                            </article>
                        </div>
                    </div>

                    <div class="seller-heading" id="best-seller">
                        <div><p class="section-kicker">FAN FAVOURITES / 02</p><h2>Best Seller</h2></div>
                        <a class="view-all" href="#footer">View all products <span>↗</span></a>
                    </div>
                    <div class="product-grid">
                        <article class="product-card">
                            <button class="favorite" aria-label="Add product 1 to favorites">♡</button>
                            <div class="product-image"><img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=800&q=90" alt="Black smartphone"></div>
                            <div class="product-info"><p>product 1</p><h3>Rpxx.xxx.xxx</h3><div class="rating"><span>☆ ☆ ☆ ☆ ☆</span><small>(9)</small></div></div>
                        </article>
                        <article class="product-card">
                            <button class="favorite" aria-label="Add product 2 to favorites">♡</button>
                            <div class="product-image"><img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=90" alt="Modern smartphone"></div>
                            <div class="product-info"><p>product 1</p><h3>Rpxx.xxx.xxx</h3><div class="rating"><span>☆ ☆ ☆ ☆ ☆</span><small>(5)</small></div></div>
                        </article>
                        <article class="product-card">
                            <button class="favorite" aria-label="Add product 3 to favorites">♡</button>
                            <div class="product-image"><img src="https://images.unsplash.com/photo-1607936854279-55e8c4f3f5ec?auto=format&fit=crop&w=800&q=90" alt="White smartphone"></div>
                            <div class="product-info"><p>product 1</p><h3>Rpxx.xxx.xxx</h3><div class="rating"><span>☆ ☆ ☆ ☆ ☆</span><small>(8)</small></div></div>
                        </article>
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
