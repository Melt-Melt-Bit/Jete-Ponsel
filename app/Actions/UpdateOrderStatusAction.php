<?php

namespace App\Actions;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class UpdateOrderStatusAction
{
    public function handle(Order $order, string $status): Order
    {
        return DB::transaction(function () use ($order, $status): Order {
            $order = Order::query()
                ->whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($status === 'cancelled' && $order->status !== 'cancelled') {
                $order->load('items.product');

                foreach ($order->items as $item) {
                    $item->product?->increment('stock', $item->quantity);
                }
            }

            $updates = ['status' => $status];

            if ($status === 'completed' && $order->payment_method === 'pay_at_pickup') {
                $updates['payment_status'] = 'paid';
            }

            $order->update($updates);

            return $order;
        });
    }
}
