<?php

namespace App\Http\Controllers\Profile\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('profile.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('profile.orders.show', compact('order'));
    }
}
