<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class AccountOrderController extends Controller
{
    public function profile(): View
    {
        $section = request('section') === 'orders' ? 'orders' : 'profile';

        return view('profile', [
            'section' => $section,
            'orders' => $section === 'orders'
                ? auth()->user()->orders()->with('items')->latest()->paginate(10)
                : collect(),
        ]);
    }

    public function index(): View
    {
        return redirect()->route('profile', ['section' => 'orders']);
    }

    public function show(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('orders.show', ['order' => $order->load('items')]);
    }
}
