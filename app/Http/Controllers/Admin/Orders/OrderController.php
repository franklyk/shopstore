<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order): View
    {
        $order->load([
            'user',
            'items',
            'items.product',
            'payment',
            'shipment',
        ]);

        return view('admin.orders.show', compact('order'));
    }
}
