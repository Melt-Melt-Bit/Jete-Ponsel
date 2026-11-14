<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class AccountOrderController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);

        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('orders.show', ['order' => $order->load('items')]);
    }
}
