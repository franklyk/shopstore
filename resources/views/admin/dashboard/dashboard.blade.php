@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin')

    <div class="dashboard page-container">
        <x-ui.page-header title="Painel de Controle" description="Resumo Geral de Operações.">
            <x-slot:actions>

                <x-ui.breadcrumbs :items="[['label' => 'Dashboard']]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="metrics">

            <div class="card">
                <dl>
                    <dt>Total de Pedidos : </dt>
                    <dd>{{ $ordersCount }}</dd>
                </dl>
            </div>

            <div class="card">
                <dl>
                    <dt>Pedidos Pagos : </dt>
                    <dd>{{ $paidOrdersCount }}</dd>
                </dl>
            </div>

            <div class="card">
                <dl>
                    <dt>Pedidos Pendentes : </dt>
                    <dd>{{ $pendingOrdersCount }}</dd>
                </dl>
            </div>


            <div class="card">
                <dl>
                    <dt>Envios em Andamento : </dt>
                    <dd>{{ $shipmentsCount }}</dd>
                </dl>
            </div>

            <div class="card">
                <dl>
                    <dt>Produtos Cadastrados: </dt>
                    <dd>{{ $productsCount }}</dd>
                </dl>
            </div>


            <div class="card">
                <dl>
                    <dt>Clientes Ativos: </dt>
                    <dd>{{ $customersCount }}</dd>
                </dl>
            </div>


        </div>

        <div class="widgets">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Últimos Pedidos</h5>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table-vs">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Pagamento</th>
                                <th width="100"></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($latestOrders as $order)
                                <tr>

                                    <td data-field="center">#{{ $order->id }}</td>

                                    <td data-field="center">{{ $order->customer_name }}</td>

                                    <td data-field="center">
                                        R$ {{ number_format($order->total, 2, ',', '.') }}
                                    </td>

                                    <td data-field="center">{{ $order->payment_status }}</td>

                                    <td>
                                        <x-buttons.button href="{{ route('admin.orders.show', $order) }}" color="info"
                                            icon="eye" class="text-white" />
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Nenhum pedido encontrado.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Envios em Andamento</h5>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table-vs">

                        <thead>
                            <tr>
                                <th>Pedido nº</th>
                                <th>Status</th>
                                <th width="100"></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($activeShipments as $shipment)
                                <tr>

                                    <td data-field="center">{{ $shipment->order_id }}</td>

                                    <td data-field="center">{{ $shipment->status->value }}</td>

                                    <td>
                                        <x-buttons.button href="{{ route('admin.shipments.show', $shipment) }}"
                                            color="info" icon="eye" class="text-white" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Nenhum pedido encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
