<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $ordersCount = Order::count();

        $paidOrdersCount = Order::query()
            ->whereNotNull('paid_at')
            ->count();

        $pendingOrdersCount = Order::query()
            ->whereNull('paid_at')
            ->count();

        $shipmentsCount = Shipment::query()
            ->whereNotIn('status', ['delivered', 'returned'])
            ->count();

        $productsCount = Product::count();

        $customersCount = User::count();

        $latestOrders = Order::query()
            ->latest()
            ->take(10)
            ->get();

        $activeShipments = Shipment::query()
            ->with('order')
            ->whereNotIn('status', ['delivered', 'returned'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard.dashboard', compact(
            'ordersCount',
            'paidOrdersCount',
            'pendingOrdersCount',
            'shipmentsCount',
            'productsCount',
            'customersCount',
            'latestOrders',
            'activeShipments'
        ));
    }
}
