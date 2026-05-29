<?php

namespace App\Http\Controllers\Store\Checkout;

use App\Actions\Orders\CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\StoreCheckoutRequest;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = Cart::with('items.product')
            ->firstWhere('user_id', auth()->id());

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Carrinho vazio.');
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

    public function store(StoreCheckoutRequest $request)
    {
        $order = CreateOrderAction::run(
            user: $request->user(),
            data: $request->validated(),
        );

        return redirect()->route('profile.orders.pay', $order)
            ->with('success', 'Pedido criado com sucesso.');
    }

}
