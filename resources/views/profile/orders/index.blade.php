@extends('layouts.profile')

@section('title', 'Meus Pedidos')

@section('profile')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header d-flex align-items-center">

                <div class="card-title">
                    <h2>Meus Pedidos</h2>
                </div>

            </div>

            <div class="card-body">

                @if($orders->isEmpty())

                    <div class="alert alert-info mb-0">
                        Você ainda não realizou nenhum pedido.
                    </div>

                @else

                    <div class="list-group">

                        @foreach($orders as $order)

                            <a href="{{ route('profile.orders.show', $order) }}"
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                                <div>

                                    <div>
                                        <strong>Pedido #{{ $order->id }}</strong>
                                    </div>

                                    <small class="text-muted">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </small>

                                </div>

                                <div class="text-end">

                                    <div>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>

                                    <div class="fw-bold">
                                        R$ {{ number_format($order->total, 2, ',', '.') }}
                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @endif

            </div>

            <div class="card-footer d-flex align-items-center gap-1">

                <x-buttons.button
                    href="{{ route('profile.show') }}"
                    color="secondary"
                    icon="return"
                    label="Voltar" />

            </div>

        </div>

    </div>

</div>

@endsection
