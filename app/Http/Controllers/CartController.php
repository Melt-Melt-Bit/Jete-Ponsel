<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CartController extends Controller
{
    private const SESSION_KEY = 'cart.products';

    public function index(Request $request): View
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);
        $products = Product::query()
            ->whereKey(array_keys($cart))
            ->where('is_active', true)
            ->get()
            ->keyBy('id');
        $cartItems = [];
        $subtotal = 0;
        $cartAdjusted = false;

        foreach ($cart as $productId => $quantity) {
            $product = $products->get((int) $productId);

            if (! $product instanceof Product || $product->stock < 1) {
                unset($cart[$productId]);
                $cartAdjusted = true;

                continue;
            }

            $quantity = min((int) $quantity, $product->stock);
            $cartAdjusted = $cartAdjusted || $quantity !== (int) $cart[$productId];
            $lineTotal = $product->price * $quantity;
            $cartItems[] = ['product' => $product, 'quantity' => $quantity, 'line_total' => $lineTotal];
            $subtotal += $lineTotal;
            $cart[$productId] = $quantity;
        }

        $request->session()->put(self::SESSION_KEY, $cart);

        if ($cartAdjusted) {
            $request->session()->flash('cart_notice', 'Your cart was updated because some items are no longer available in the requested quantity.');
        }

        return view('cart', ['cartItems' => $cartItems, 'subtotal' => $subtotal]);
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active && $product->stock > 0, 404);

        $validated = Validator::make($request->all(), [
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:99'],
        ])->validate();
        $cart = $request->session()->get(self::SESSION_KEY, []);
        $quantity = ($cart[$product->id] ?? 0) + ($validated['quantity'] ?? 1);

        if ($quantity > $product->stock) {
            return back()->withErrors(['cart' => 'The requested quantity exceeds available stock.']);
        }

        $cart[$product->id] = $quantity;
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')->with('status', 'Product added to your cart.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock],
        ])->validate();
        $cart = $request->session()->get(self::SESSION_KEY, []);

        if (! array_key_exists($product->id, $cart)) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'That product is not in your cart.']);
        }

        $cart[$product->id] = $validated['quantity'];
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')->with('status', 'Cart quantity updated.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);
        unset($cart[$product->id]);
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')->with('status', 'Product removed from your cart.');
    }
}
