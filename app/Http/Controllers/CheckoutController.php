<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    private const SESSION_KEY = 'cart.products';

    public function create(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);

        if ($cart === []) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Add a product before checking out.']);
        }

        $products = Product::query()->whereKey(array_keys($cart))->where('is_active', true)->get()->keyBy('id');

        if ($products->count() !== count($cart)) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'One or more products are no longer available. Review your cart before checking out.']);
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $products->get((int) $productId);

            if (! $product instanceof Product || $product->stock < (int) $quantity) {
                return redirect()->route('cart.index')->withErrors(['cart' => 'A product does not have enough stock. Update your cart before checking out.']);
            }

            $lineTotal = $product->price * (int) $quantity;
            $cartItems[] = ['product' => $product, 'quantity' => (int) $quantity, 'line_total' => $lineTotal];
            $subtotal += $lineTotal;
        }

        if ($cartItems === []) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'The products in your cart are no longer available.']);
        }

        return view('checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'customer' => $request->user(),
        ]);
    }

    public function store(StoreCheckoutRequest $request, CreateOrderAction $createOrder): RedirectResponse
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);

        if ($cart === []) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Add a product before checking out.']);
        }

        $order = $createOrder->handle($cart, $request->validated(), $request->user());
        $request->session()->forget(self::SESSION_KEY);

        return redirect()->route('orders.confirmation', ['order' => $order->order_number]);
    }

    public function confirmation(Order $order): View
    {
        return view('orders.confirmation', ['order' => $order->load('items')]);
    }
}
