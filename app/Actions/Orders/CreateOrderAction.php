<?php

namespace App\Actions\Orders;

use App\Enums\PaymentStatus;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public static function run(User $user, array $data = []): Order
    {
        return DB::transaction(function () use ($user, $data) {

            /*
            |--------------------------------------------------------------------------
            | Carrinho
            |--------------------------------------------------------------------------
            */

            $cart = Cart::with('items.product')
                ->firstWhere('user_id', $user->id);

            /*
            |--------------------------------------------------------------------------
            | Validação básica
            |--------------------------------------------------------------------------
            */

            if (! $cart || $cart->items->isEmpty()) {
                abort(400, 'Carrinho vazio.');
            }

            /*
            |--------------------------------------------------------------------------
            | Totais
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;

            foreach ($cart->items as $item) {

                $subtotal += (
                    $item->quantity * $item->product->price
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Criar pedido
            |--------------------------------------------------------------------------
            */

            /*
            |--------------------------------------------------------------------------
            | Endereço
            |--------------------------------------------------------------------------
            */

            $address = Address::findOrFail(
                $data['address_id']
            );

            /*
            |--------------------------------------------------------------------------
            | Ownership
            |--------------------------------------------------------------------------
            */

            abort_if(
                $address->user_id !== $user->id,
                403
            );

            $order = Order::create([

                'user_id' => $user->id,

                'status' => 'pending',

                'payment_status' => 'pending',

                'subtotal' => $subtotal,

                'shipping' => 0,

                'discount' => 0,

                'total' => $subtotal,

                /*
                |--------------------------------------------------------------------------
                | Snapshot temporário
                |--------------------------------------------------------------------------
                */

                'customer_name' => $user->name,

                'zipcode' => $address->cep,

                'street' => $address->street,

                'number' => $address->number,

                'complement' => $address->complement,

                'district' => $address->district,

                'city' => $address->city,

                'state' => $address->state,
            ]);

            
            Payment::create([
                'order_id' => $order->id,
                'status' => PaymentStatus::PENDING->value,
                'amount' => $order->total,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Criar itens do pedido
            |--------------------------------------------------------------------------
            */

            foreach ($cart->items as $item) {

                $product = $item->product;

                $order->items()->create([

                    'product_id' => $product->id,

                    /*
                    |--------------------------------------------------------------------------
                    | Snapshot do produto
                    |--------------------------------------------------------------------------
                    */

                    'name' => $product->name,

                    'slug' => $product->slug,

                    'sku' => $product->sku,

                    /*
                    |--------------------------------------------------------------------------
                    | Valores
                    |--------------------------------------------------------------------------
                    */

                    'price' => $product->price,

                    'quantity' => $item->quantity,

                    'subtotal' => (
                        $item->quantity * $product->price
                    ),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Limpar carrinho
            |--------------------------------------------------------------------------
            */

            $cart->items()->delete();

            return $order;
        });
    }
}
