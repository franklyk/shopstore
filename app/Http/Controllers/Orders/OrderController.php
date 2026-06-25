<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('profile.orders.index', compact('orders'));
    }

    public function show(Order $order): View
{
    $this->authorize('view', $order);

    $order->load([
        'items',
        'payment',
        'shipment',
    ]);

    return view(
        'profile.orders.show',
        compact('order')
    );
}
}
