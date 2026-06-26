@extends('layouts.profile')

@section('title', 'Pedido #' . $order->id)

@section('profile')

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div class="card-title">
                        <h2>Pedido #{{ $order->id }}</h2>
                    </div>

                    <span class="badge bg-secondary">
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

                <div class="card-body">

                    {{-- RESUMO --}}
                    <div class="mb-4">

                        <h5>Resumo</h5>

                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>R$ {{ number_format($order->subtotal, 2, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Frete</span>
                            <span>R$ {{ number_format($order->shipping, 2, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Desconto</span>
                            <span>R$ {{ number_format($order->discount, 2, ',', '.') }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>R$ {{ number_format($order->total, 2, ',', '.') }}</span>
                        </div>

                    </div>

                    {{-- PAGAMENTO --}}
                    <div class="mb-4">

                        <h5>Pagamento</h5>

                        <p class="mb-0">
                            Status:
                            <strong>{{ ucfirst($order->payment_status) }}</strong>
                        </p>

                        @if ($order->paid_at)
                            <p class="mb-0">
                                Pago em:
                                {{ $order->paid_at->format('d/m/Y H:i') }}
                            </p>
                        @endif

                    </div>

                    {{-- ENTREGA --}}
                    @if ($order->shipment)

                        <div class="mb-4">

                            <h5>Entrega</h5>

                            <p class="mb-0">
                                Status:
                                <strong>{{ ucfirst($order->shipment->status->value) }}</strong>
                            </p>

                            @if ($order->shipment->carrier)
                                <p class="mb-0">
                                    Transportadora:
                                    {{ $order->shipment->carrier }}
                                </p>
                            @endif

                            @if ($order->shipment->tracking_code)
                                <p class="mb-0">
                                    Código de rastreio:
                                    {{ $order->shipment->tracking_code }}
                                </p>
                            @endif

                            @if ($order->shipment->shipped_at)
                                <p class="mb-0">
                                    Enviado em:
                                    {{ $order->shipment->shipped_at->format('d/m/Y H:i') }}
                                </p>
                            @endif

                            @if ($order->shipment->delivered_at)
                                <p class="mb-0">
                                    Entregue em:
                                    {{ $order->shipment->delivered_at->format('d/m/Y H:i') }}
                                </p>
                            @endif

                        </div>

                    @endif

                    {{-- ENDEREÇO --}}
                    <div class="mb-4">

                        <h5>Endereço de entrega</h5>

                        <p class="mb-0">
                            {{ $order->customer_name }} <br>
                            {{ $order->street }}, {{ $order->number }} <br>
                            {{ $order->district }} - {{ $order->city }}/{{ $order->state }} <br>
                            CEP: {{ $order->zipcode }}
                        </p>

                    </div>

                    {{-- ITENS --}}
                    <div class="mb-3">

                        <h5>Itens</h5>

                        <div class="list-group">

                            @foreach ($order->items as $item)
                                <div class="list-group-item d-flex justify-content-between">

                                    <div>
                                        <strong>{{ $item->name }}</strong><br>

                                        <small class="text-muted">
                                            SKU: {{ $item->sku }}
                                            |
                                            Qtd: {{ $item->quantity }}
                                        </small>
                                    </div>

                                    <div>
                                        R$
                                        {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="card-footer d-flex gap-1">

                    <x-buttons.button href="{{ route('profile.orders.index') }}" color="secondary" icon="return"
                        label="Voltar" />

                    @if (in_array($order->payment_status, ['pending', 'failed']))
                        <form action="{{ route('profile.orders.pay', $order) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-success">
                                Pagar Pedido
                            </button>

                        </form>
                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
