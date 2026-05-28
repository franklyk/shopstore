<?php

namespace App\Http\Controllers\Store\Orders;

use App\Actions\Orders\CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
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

        // dd($cart, $cart?->items);

        return view('store.checkout.index', [

            'cart' => $cart,

            'items' => $cart->items,

            'addresses' => $addresses,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = CreateOrderAction::run(
            user: $request->user(),
            data: $request->validated(),
        );

        return redirect()
            ->route('home')
            ->with('success', 'Pedido criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
