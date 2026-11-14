<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateOrderAction
{
    /**
     * @param  array<int|string, int>  $cart
     * @param  array<string, string|null>  $attributes
     */
    public function handle(array $cart, array $attributes, ?User $user): Order
    {
        return DB::transaction(function () use ($cart, $attributes, $user): Order {
            $products = Product::query()
                ->whereKey(array_keys($cart))
                ->where('is_active', true)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($products->count() !== count($cart)) {
                throw ValidationException::withMessages([
                    'cart' => 'One or more products are no longer available. Review your cart and try again.',
                ]);
            }

            $subtotal = 0;

            foreach ($cart as $productId => $quantity) {
                $product = $products->get((int) $productId);

                if (! $product instanceof Product || $quantity < 1 || $quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'cart' => 'A product does not have enough stock. Update your cart and try again.',
                    ]);
                }

                $subtotal += $product->price * $quantity;
            }

            $order = Order::query()->create([
                'order_number' => 'JT-'.Str::upper((string) Str::ulid()),
                'user_id' => $user?->id,
                'customer_name' => $attributes['customer_name'],
                'customer_email' => $attributes['customer_email'],
                'customer_phone' => $attributes['customer_phone'],
                'fulfillment_method' => 'pickup',
                'payment_method' => 'pay_at_pickup',
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => 0,
                'total' => $subtotal,
                'notes' => $attributes['notes'] ?? null,
            ]);

            foreach ($cart as $productId => $quantity) {
                $product = $products->get((int) $productId);

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->brand.' '.$product->name,
                    'sku' => $product->sku,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'line_total' => $product->price * $quantity,
                ]);

                $product->decrement('stock', $quantity);
            }

            return $order->load('items');
        });
    }
}
