@extends('layouts.store')

@section('content')
    
    <div class="container">

        <h2 class="mb-4">🛒 Carrinho</h2>


        @if (empty($items) || (is_countable($items) && count($items) === 0))
            <div class="alert alert-info">
                Seu carrinho está vazio.
            </div>
        @else
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th width="120">Qtd</th>
                        <th>Subtotal</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @php $total = 0; @endphp

                    @foreach ($items as $key => $item)
                        @php
                            $id = $isSession ? $key : $item->id;
                            $name = $isSession ? $item['name'] : $item->product->name;
                            $price = $isSession ? $item['price'] : $item->price;
                            $qty = $isSession ? $item['quantity'] : $item->quantity;

                            $subtotal = $price * $qty;
                            $total += $subtotal;
                        @endphp

                        <tr>
                            <td>{{ $name }}</td>

                            <td class="price" data-price="{{ $price }}">
                                R$ {{ number_format($price, 2, ',', '.') }}
                            </td>

                            <td>
                                <input type="number" class="form-control form-control-sm input-qty"
                                    data-id="{{ $id }}" value="{{ $qty }}" min="1">
                            </td>

                            <td class="subtotal" data-value="{{ $subtotal }}">
                                R$ {{ number_format($subtotal, 2, ',', '.') }}
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-remove"
                                    data-id="{{ $id }}">
                                    Remover
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="text-end">
                <h4>
                    Total:
                    <strong id="cart-total">
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </strong>
                </h4>
            </div>
        @endif

        <a href="{{ route('checkout.index') }}" class="btn btn-primary">
            Ir para Checkout
        </a>
        {{-- <form action="{{ route('checkout.store') }}" method="POST">

            @csrf

            <button type="submit">
                Finalizar Compra
            </button>

        </form> --}}

    </div>

@endsection
