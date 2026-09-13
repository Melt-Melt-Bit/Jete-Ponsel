<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="JT Ponsel admin dashboard">
        <title>Admin Dashboard — JT Ponsel</title>
        @vite(['resources/css/admin.css'])
    </head>
    <body class="admin-body">
        <div class="admin-shell">
            <aside class="admin-sidebar">
                <a class="admin-brand" href="{{ route('home') }}" aria-label="JT Ponsel home">
                    <span class="admin-logo brand-icon" aria-hidden="true"><svg viewBox="0 0 40 40"><path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/><path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span>
                    <span>JT<span class="brand-dot">.</span></span>
                </a>
                <p class="admin-eyebrow">CONTROL CENTRE</p>
                <nav class="admin-nav" aria-label="Admin navigation">
                    <a class="active" href="{{ route('admin.dashboard') }}"><span>▦</span> Overview</a>
                    <a href="#orders"><span>↗</span> Orders</a>
                    <a href="#catalogue"><span>◇</span> Catalogue</a>
                    <a href="#customers"><span>◎</span> Customers</a>
                    <a href="#settings"><span>⚙</span> Settings</a>
                </nav>
                <div class="admin-sidebar-footer">
                    <span class="admin-avatar">AD</span>
                    <div><strong>Store admin</strong><small>JT Ponsel HQ</small></div>
                </div>
            </aside>

            <main class="admin-main">
                @if (session('admin_status'))
                    <div class="admin-alert">{{ session('admin_status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="admin-alert admin-alert-error">
                        <strong>Could not save the product.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <header class="admin-header">
                    <div>
                        <p class="admin-eyebrow">SUNDAY / 13 SEPTEMBER 2026</p>
                        <h1>Good afternoon, admin.</h1>
                    </div>
                    <div class="admin-header-actions">
                        <a href="{{ route('featured-product') }}">View storefront <span>↗</span></a>
                        <a class="admin-notification" href="#notifications" aria-label="View notifications">●</a>
                    </div>
                </header>

                <section class="admin-metrics" aria-label="Store metrics">
                    @foreach ($metrics as $metric)
                        <article class="metric-card">
                            <p>{{ $metric['label'] }}</p>
                            <strong>{{ $metric['value'] }}</strong>
                            <span class="{{ $metric['tone'] }}">{{ $metric['change'] }}</span>
                        </article>
                    @endforeach
                </section>

                <section class="admin-grid">
                    <article class="admin-panel sales-panel">
                        <div class="panel-heading">
                            <div><p class="admin-eyebrow">PERFORMANCE / 01</p><h2>Sales overview</h2></div>
                            <select aria-label="Sales period"><option>Last 30 days</option><option>Last 7 days</option></select>
                        </div>
                        <div class="sales-chart" aria-label="Sales increased steadily over the last 30 days">
                            <div class="chart-bars">
                                @foreach ([42, 55, 49, 68, 61, 77, 72, 88, 81, 96, 86, 100] as $height)
                                    <span style="height: {{ $height }}%"></span>
                                @endforeach
                            </div>
                            <div class="chart-labels"><span>01 Sep</span><span>08 Sep</span><span>15 Sep</span><span>22 Sep</span><span>30 Sep</span></div>
                        </div>
                    </article>

                    <article class="admin-panel top-products" id="catalogue">
                        <div class="panel-heading"><div><p class="admin-eyebrow">CATALOGUE / 02</p><h2>Top products</h2></div><a href="{{ route('featured-product') }}">View all ↗</a></div>
                        @foreach ($topProducts as $product)
                            <div class="top-product">
                                <span class="product-rank">{{ $loop->iteration }}</span>
                                <div><strong>{{ $product['name'] }}</strong><small>{{ $product['category'] }} · {{ $product['sold'] }} sold</small></div>
                                <span class="{{ $product['stock'] < 6 ? 'stock-low' : 'stock-ok' }}">{{ $product['stock'] }} left</span>
                            </div>
                        @endforeach
                    </article>
                </section>

                <section class="admin-panel orders-panel" id="orders">
                    <div class="panel-heading"><div><p class="admin-eyebrow">LATEST ACTIVITY / 03</p><h2>Recent orders</h2></div><a href="#orders">Manage orders ↗</a></div>
                    <div class="orders-table-wrap">
                        <table class="orders-table">
                            <thead><tr><th>Order</th><th>Customer</th><th>Product</th><th>Total</th><th>Status</th></tr></thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr><td>{{ $order['id'] }}</td><td>{{ $order['customer'] }}</td><td>{{ $order['product'] }}</td><td>{{ $order['total'] }}</td><td><span class="status status-{{ \Illuminate\Support\Str::slug($order['status']) }}">{{ $order['status'] }}</span></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="admin-panel catalogue-panel" id="catalogue-management">
                    <div class="panel-heading">
                        <div><p class="admin-eyebrow">PRODUCT MANAGEMENT / 04</p><h2>Manage catalogue</h2></div>
                    </div>
                    <form class="product-form" action="{{ route('admin.products.store') }}" method="post">
                        @csrf
                        <input name="brand" placeholder="Brand" required>
                        <input name="name" placeholder="Product name" required>
                        <input name="price" placeholder="Rp price" required>
                        <input name="badge" placeholder="Badge" value="New" required>
                        <input name="image" type="text" placeholder="Image URL or local asset path" required>
                        <button type="submit">Add product</button>
                    </form>
                    <div class="admin-product-list">
                        @foreach ($products as $product)
                            <div class="admin-product-row {{ $product['visible'] ? '' : 'is-hidden' }}">
                                <img class="admin-product-image" src="{{ $product['image'] }}" alt="{{ $product['alt'] }}">
                                <div class="admin-product-copy">
                                    <strong>{{ $product['brand'] }} {{ $product['name'] }}</strong>
                                    <small>{{ $product['price'] }} · {{ $product['visible'] ? 'Visible in storefront' : 'Hidden from storefront' }}</small>
                                </div>
                                <div class="admin-product-actions">
                                    <details>
                                        <summary>Edit</summary>
                                        <form class="product-edit-form" action="{{ route('admin.products.update', $product['id']) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input name="brand" value="{{ $product['brand'] }}" required>
                                            <input name="name" value="{{ $product['name'] }}" required>
                                            <input name="price" value="{{ $product['price'] }}" required>
                                            <input name="badge" value="{{ $product['badge'] }}" required>
                                            <input name="image" type="text" value="{{ $product['image'] }}" required>
                                            <button type="submit">Save</button>
                                        </form>
                                    </details>
                                    <form action="{{ route('admin.products.visibility', $product['id']) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">{{ $product['visible'] ? 'Hide' : 'Show' }}</button>
                                    </form>
                                    <form action="{{ route('admin.products.destroy', $product['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
