@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin')

    <div class="card">
        <div class="card-header bg-primary">
            <h2 class="card-title text-light">Dashboard</h2>
        </div>
        <div class="card-body">
            <div class="row g-3 mb-4">


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="card-title text-light">Total de Pedidos</h6>
                        </div>

                        <div class="card-body">
                            <h2>{{ $ordersCount }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="card-title text-light">Pedidos Pagos</h6>
                        </div>

                        <div class="card-body">
                            <h2>{{ $paidOrdersCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="card-title text-light">Pedidos Pendentes</h6>
                        </div>

                        <div class="card-body">
                            <h2>{{ $pendingOrdersCount }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="card-title text-light">Shipments em Andamento</h6>
                        </div>

                        <div class="card-body">
                            <h2>{{ $shipmentsCount }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="card-title text-light">Produtos</h6>
                        </div>

                        <div class="card-body">
                            <h2>{{ $productsCount }}</h2>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h6 class="card-title text-light">Clientes</h6>
                        </div>

                        <div class="card-body">
                            <h2>{{ $customersCount }}</h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-8">

                    <div class="card mb-4">

                        <div class="card-header">
                            Últimos Pedidos
                        </div>

                        <div class="card-body p-0">

                            <table class="table mb-0">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Pagamento</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($latestOrders as $order)
                                        <tr>

                                            <td>
                                                #{{ $order->id }}
                                            </td>

                                            <td>
                                                {{ $order->customer_name }}
                                            </td>

                                            <td>
                                                R$ {{ number_format($order->total, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ $order->payment_status }}
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.orders.show', $order) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Ver
                                                </a>
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="5">
                                                Nenhum pedido encontrado.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card">

                        <div class="card-header">
                            Shipments em Andamento
                        </div>

                        <div class="card-body">

                            @forelse($activeShipments as $shipment)
                                <div class="border-bottom pb-2 mb-2">

                                    <strong>
                                        Pedido #{{ $shipment->order_id }}
                                    </strong>

                                    <br>

                                    Status:
                                    {{ $shipment->status->value }}

                                    <br>

                                    <a href="{{ route('admin.shipments.show', $shipment) }}">
                                        Ver Shipment
                                    </a>

                                </div>

                            @empty

                                <p class="mb-0">
                                    Nenhum shipment em andamento.
                                </p>
                            @endforelse

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
