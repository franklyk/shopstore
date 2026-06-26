@extends('layouts.store')

@section('store')
    <div class="container">

        <h2 class="mb-4">
            Checkout
        </h2>

        <div class="card">

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $total = 0; @endphp

                        @foreach ($items as $item)
                            @php

                                $subtotal = $item->quantity * $item->product->price;

                                $total += $subtotal;

                            @endphp

                            <tr>

                                <td>
                                    {{ $item->product->name }}
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    R$
                                    {{ number_format($item->product->price, 2, ',', '.') }}
                                </td>

                                <td>
                                    R$
                                    {{ number_format($subtotal, 2, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <div class="text-end mb-4">

                    <h4>

                        Total:

                        <strong>

                            R$
                            {{ number_format($total, 2, ',', '.') }}

                        </strong>

                    </h4>

                </div>

                <hr>

                <form action="{{ route('checkout.store') }}" method="POST">

                    @csrf

                    <h4 class="mb-3">
                        Escolha o endereço
                    </h4>

                    @foreach ($addresses as $address)
                        <div class="form-check mb-2">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="address_id" value="{{ $address->id }}"
                                    required>

                                {{ $address->street }},
                                {{ $address->number }}

                                -

                                {{ $address->city }}/{{ $address->state }}

                            </label>

                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary mt-3">
                        Finalizar Pedido
                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection
