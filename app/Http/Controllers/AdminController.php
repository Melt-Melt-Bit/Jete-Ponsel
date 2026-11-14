<?php

namespace App\Http\Controllers;

use App\Actions\UpdateOrderStatusAction;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'products' => Product::query()->latest()->get(),
            'orders' => Order::query()->with('items')->latest()->take(10)->get(),
            'metrics' => [
                ['label' => 'Orders', 'value' => number_format(Order::query()->count())],
                ['label' => 'Products', 'value' => number_format(Product::query()->count())],
                ['label' => 'Low stock', 'value' => number_format(Product::query()->where('stock', '<', 6)->count())],
                ['label' => 'Awaiting pickup', 'value' => number_format(Order::query()->whereIn('status', ['pending', 'ready_for_pickup'])->count())],
            ],
            'topProducts' => OrderItem::query()
                ->selectRaw('product_id, SUM(quantity) as quantity_sold')
                ->whereNotNull('product_id')
                ->whereHas('order', fn ($query) => $query->whereNot('status', 'cancelled'))
                ->groupBy('product_id')
                ->orderByDesc('quantity_sold')
                ->with('product')
                ->take(3)
                ->get(),
        ]);
    }

    public function updateOrderStatus(
        UpdateOrderStatusRequest $request,
        Order $order,
        UpdateOrderStatusAction $updateOrderStatus,
    ): RedirectResponse {
        $updateOrderStatus->handle($order, $request->validated('status'));

        return back()->with('admin_status', 'Order status updated.');
    }
}
