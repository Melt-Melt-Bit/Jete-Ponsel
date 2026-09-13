<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('login')->withErrors(['email' => 'Sign in with the admin account to continue.']);
        }

        return view('admin.dashboard', [
            'products' => ProductCatalog::all(),
            'metrics' => [
                ['label' => 'Revenue this month', 'value' => 'Rp48.760.000', 'change' => '+18.4%', 'tone' => 'positive'],
                ['label' => 'Orders', 'value' => '128', 'change' => '+12.1%', 'tone' => 'positive'],
                ['label' => 'Products in catalogue', 'value' => '86', 'change' => '8 low stock', 'tone' => 'warning'],
                ['label' => 'Pending payments', 'value' => '14', 'change' => 'Needs review', 'tone' => 'warning'],
            ],
            'orders' => [
                ['id' => '#JT-1048', 'customer' => 'Nadia Putri', 'product' => 'iPhone 17 Pro Max', 'total' => 'Rp24.999.000', 'status' => 'Paid'],
                ['id' => '#JT-1047', 'customer' => 'Rizky Maulana', 'product' => 'Galaxy S25 Ultra', 'total' => 'Rp18.999.000', 'status' => 'Processing'],
                ['id' => '#JT-1046', 'customer' => 'Salsa Amalia', 'product' => 'OPPO A53', 'total' => 'Rp2.499.000', 'status' => 'Ready for pickup'],
                ['id' => '#JT-1045', 'customer' => 'Dimas Pratama', 'product' => 'Pixel 9 Pro XL', 'total' => 'Rp15.999.000', 'status' => 'Pending'],
            ],
            'topProducts' => [
                ['name' => 'iPhone 17 Pro Max', 'category' => 'Smartphone', 'sold' => 24, 'stock' => 6],
                ['name' => 'OPPO A53', 'category' => 'Smartphone', 'sold' => 19, 'stock' => 12],
                ['name' => 'Galaxy Buds3 Pro', 'category' => 'Audio', 'sold' => 16, 'stock' => 4],
            ],
        ]);
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('login');
        }

        ProductCatalog::create($request->validate([
            'brand' => ['required', 'string', 'max:80'],
            'name' => ['required', 'string', 'max:120'],
            'price' => ['required', 'string', 'max:40'],
            'badge' => ['required', 'string', 'max:40'],
            'image' => ['required', 'string', 'max:500', 'regex:/^(https?:\/\/|\/|resources\/)/'],
        ]));

        return back()->with('admin_status', 'Product added to the catalogue.');
    }

    public function updateProduct(Request $request, string $product): RedirectResponse
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('login');
        }

        $updated = ProductCatalog::update($product, $request->validate([
            'brand' => ['required', 'string', 'max:80'],
            'name' => ['required', 'string', 'max:120'],
            'price' => ['required', 'string', 'max:40'],
            'badge' => ['required', 'string', 'max:40'],
            'image' => ['required', 'string', 'max:500', 'regex:/^(https?:\/\/|\/|resources\/)/'],
        ]));

        if (! $updated) {
            return back()->withErrors(['product' => 'The selected product could not be found.']);
        }

        return back()->with('admin_status', 'Product updated.');
    }

    public function toggleProduct(string $product): RedirectResponse
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('login');
        }

        ProductCatalog::toggleVisibility($product);

        return back()->with('admin_status', 'Product visibility updated.');
    }

    public function destroyProduct(string $product): RedirectResponse
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('login');
        }

        ProductCatalog::delete($product);

        return back()->with('admin_status', 'Product removed from the catalogue.');
    }
}
