<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function home(): View
    {
        return view('welcome', [
            'featuredProducts' => Product::query()->where('is_active', true)->latest()->take(3)->get(),
        ]);
    }

    public function index(Request $request): View
    {
        $category = $request->query('category');
        $category = in_array($category, ['phone', 'earphone', 'accessory'], true) ? $category : null;

        return view('featured-product', [
            'products' => Product::query()
                ->where('is_active', true)
                ->when($category, fn ($query) => $query->where('category', $category))
                ->latest()
                ->get(),
            'category' => $category,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        return view('detail', ['product' => $product]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::query()->create($request->validated());

        return back()->with('admin_status', 'Product added to the catalogue.');
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return back()->with('admin_status', 'Product updated.');
    }

    public function toggleVisibility(Product $product): RedirectResponse
    {
        $product->update(['is_active' => ! $product->is_active]);

        return back()->with('admin_status', 'Product visibility updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('admin_status', 'Product removed from the catalogue.');
    }
}
