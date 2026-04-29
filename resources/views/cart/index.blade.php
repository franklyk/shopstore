@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">🛒 Carrinho</h2>

    @if ($cart->items->isEmpty())
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

                @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>

                        <td>R$ {{ number_format($item->product->price, 2, ',', '.') }}</td>

                        <td>
                            <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                @csrf
                                <input type="number"
                                       name="quantity"
                                       value="{{ $item->quantity }}"
                                       min="1"
                                       class="form-control form-control-sm">
                            </form>
                        </td>

                        <td>
                            R$ {{ number_format($item->subtotal(), 2, ',', '.') }}
                        </td>

                        <td>
                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Remover
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="text-end">
            <h4>
                Total: 
                <strong>
                    R$ {{ number_format($cart->total(), 2, ',', '.') }}
                </strong>
            </h4>
        </div>

    @endif

</div>
@endsection