<?php

namespace App\Http\Controllers\Store\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\StoreCheckoutRequest;
use App\Services\Checkout\CheckoutService;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = auth()->user()
            ->cart()
            ->with('items.product')
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Seu carrinho está vazio!');
        }

        $addresses = auth()->user()
            ->addresses()
            ->latest()
            ->get();

        return view('store.checkout.index', [
            'cart' => $cart,
            'items' => $cart->items,
            'addresses' => $addresses,
        ]);
    }

    public function store(StoreCheckoutRequest $request, CheckoutService $service)
    {
        $order = $service->checkout(
            user: $request->user(),
            data: $request->validated(),
        );

        return redirect()
            ->route('profile.orders.show', $order)
            ->with('success', 'Pedido criado com sucesso.');
    }
}
