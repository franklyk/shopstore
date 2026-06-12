@extends('layouts.admin')

@section('title', 'Pedido #' . $order->id)

@section('admin')

    <div class="container-fluid">

        <h1 class="mb-4">
            Pedido #{{ $order->id }}
        </h1>

        {{-- Dados do Pedido --}}
        <div class="card mb-4">
            <div class="card-header">
                Dados do Pedido
            </div>

            <div class="card-body">

                <p>
                    <strong>Status:</strong>
                    {{ $order->status }}
                </p>

                <p>
                    <strong>Status do Pagamento:</strong>
                    {{ $order->payment_status }}
                </p>

                <p>
                    <strong>Método de Pagamento:</strong>
                    {{ $order->payment_method }}
                </p>

                <p>
                    <strong>Subtotal:</strong>
                    R$ {{ number_format($order->subtotal, 2, ',', '.') }}
                </p>

                <p>
                    <strong>Frete:</strong>
                    R$ {{ number_format($order->shipping, 2, ',', '.') }}
                </p>

                <p>
                    <strong>Desconto:</strong>
                    R$ {{ number_format($order->discount, 2, ',', '.') }}
                </p>

                <p>
                    <strong>Total:</strong>
                    R$ {{ number_format($order->total, 2, ',', '.') }}
                </p>

                <p>
                    <strong>Pago em:</strong>

                    @if($order->paid_at)
                        {{ $order->paid_at->format('d/m/Y H:i') }}
                    @else
                        —
                    @endif
                </p>

            </div>
        </div>

        {{-- Cliente --}}
        <div class="card mb-4">
            <div class="card-header">
                Cliente
            </div>

            <div class="card-body">

                <p>
                    <strong>Nome:</strong>
                    {{ $order->customer_name }}
                </p>

                @if($order->user)
                    <p>
                        <strong>Usuário:</strong>
                        {{ $order->user->name }}
                    </p>

                    <p>
                        <strong>Email:</strong>
                        {{ $order->user->email }}
                    </p>
                @endif

            </div>
        </div>

        {{-- Endereço --}}
        <div class="card mb-4">
            <div class="card-header">
                Endereço de Entrega
            </div>

            <div class="card-body">

                <p>
                    <strong>CEP:</strong>
                    {{ $order->zipcode }}
                </p>

                <p>
                    <strong>Rua:</strong>
                    {{ $order->street }}
                </p>

                <p>
                    <strong>Número:</strong>
                    {{ $order->number }}
                </p>

                <p>
                    <strong>Complemento:</strong>
                    {{ $order->complement ?: '-' }}
                </p>

                <p>
                    <strong>Bairro:</strong>
                    {{ $order->district }}
                </p>

                <p>
                    <strong>Cidade:</strong>
                    {{ $order->city }}
                </p>

                <p>
                    <strong>Estado:</strong>
                    {{ $order->state }}
                </p>

            </div>
        </div>

        {{-- Itens --}}
        <div class="card mb-4">
            <div class="card-header">
                Itens do Pedido
            </div>

            <div class="card-body">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($order->items as $item)

                            <tr>

                                <td>
                                    {{ $item->product?->name }}
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    R$ {{ number_format($item->price, 2, ',', '.') }}
                                </td>

                                <td>
                                    R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

        {{-- Pagamento --}}
        {{-- <div class="card mb-4">
            <div class="card-header">
                Pagamento
            </div>

            <div class="card-body">

                @if($order->payment)

                    <pre>{{ json_encode($order->payment->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                @else

                    <p>Nenhum pagamento encontrado.</p>

                @endif

            </div>
        </div> --}}

        {{-- Shipment --}}
        {{-- <div class="card mb-4">
            <div class="card-header">
                Shipment
            </div>

            <div class="card-body">

                @if($order->shipment)

                    <pre>{{ json_encode($order->shipment->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                @else

                    <p>Nenhum shipment encontrado.</p>

                @endif

            </div>
        </div> --}}

    </div>

@endsection
