@extends('layouts.admin')

@section('title', 'Dashboard')

@section('layout-admin')

    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Painel de Controle">
                <x-slot:actions>

                    <x-ui.breadcrumbs :items="[['label' => 'Dashboard']]" />

                </x-slot:actions>

            </x-ui.page-header>
        </x-slot:header>

        <div class="dashboard p-3">


            <div class="metrics">

                <div class="p-1 bg-light rounded-3">
                    <div class="py-1 px-3 border border-5 border-white rounded-3">
                        <dl>
                            <dt class="text-dark fw-lighter fs-6">Total de Pedidos : </dt>
                            <dd class="text-danger">{{ $ordersCount }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="p-1 bg-light rounded-3">
                    <div class="py-1 px-3 border border-5 border-white rounded-3">
                        <dl>
                            <dt class="text-dark fw-lighter fs-6">Pedidos Pagos : </dt>
                            <dd class="text-danger">{{ $paidOrdersCount }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="p-1 bg-light rounded-3">
                    <div class="py-1 px-3 border border-5 border-white rounded-3">
                        <dl>
                            <dt class="text-dark fw-lighter fs-6">Pedidos Pendentes : </dt>
                            <dd class="text-danger">{{ $pendingOrdersCount }}</dd>
                        </dl>
                    </div>
                </div>


                <div class="p-1 bg-light rounded-3">
                    <div class="py-1 px-3 border border-5 border-white rounded-3">
                        <dl>
                            <dt class="text-dark fw-lighter fs-6">Envios em Andamento : </dt>
                            <dd class="text-danger">{{ $shipmentsCount }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="p-1 bg-light rounded-3">
                    <div class="py-1 px-3 border border-5 border-white rounded-3">
                        <dl>
                            <dt class="text-dark fw-lighter fs-6">Produtos Cadastrados: </dt>
                            <dd class="text-danger">{{ $productsCount }}</dd>
                        </dl>
                    </div>
                </div>


                <div class="p-1 bg-light rounded-3">
                    <div class="py-1y px-3 border border-5 border-white rounded-3">
                        <dl>
                            <dt class="text-dark fw-lighter fs-6">Clientes Ativos: </dt>
                            <dd class="text-danger">{{ $customersCount }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="widgets col-12">

                <div class="p-1 bg-light rounded-3">
                    <div class="p-3 border border-5 border-white rounded-3">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="d-block text-dark text-center">Últimos Pedidos</span>
                            </div>
                        </div>
                        @if (!empty($latestOrders['']))
                            <div class="table-responsive">

                                <table class="table">


                                    <thead>
                                        <tr>
                                            <th class="text-dark text-center">#</th>
                                            <th class="text-dark text-center">Cliente</th>
                                            <th class="text-dark text-center">Total</th>
                                            <th class="text-dark text-center">Pagamento</th>
                                            <th width="100"></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($latestOrders as $order)
                                            <tr>

                                                <td data-field="center">#{{ $order->id }}</td>

                                                <td data-field="center">{{ $order->customer_name }}</td>

                                                <td data-field="center">
                                                    R$ {{ number_format($order->total, 2, ',', '.') }}
                                                </td>

                                                <td data-field="center">{{ $order->payment_status }}</td>

                                                <td>
                                                    <x-buttons.button href="{{ route('admin.orders.show', $order) }}"
                                                        color="info" icon="eye" class="text-white" />
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                        @else
                            <span class="d-block text-center text-danger py-1 px-3">Nenhum pedido encontrado!</span>
                        @endif
                    </div>
                </div>

                <div class="p-1 bg-light rounded-3">
                    <div class="p-3 border border-5 border-white rounded-3">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="d-block text-dark text-center">Envios em Andamento</h5>
                                </span>
                        </div>
                        @if (!empty($activeShipments['']))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-dark text-center">Pedido nº</th>
                                            <th class="text-dark text-center">Status</th>
                                            <th width="100"></th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($activeShipments as $shipment)
                                            <tr>

                                                <td data-field="center">{{ $shipment->order_id }}</td>

                                                <td data-field="center">{{ $shipment->status->value }}</td>

                                                <td>
                                                    <x-buttons.button href="{{ route('admin.shipments.show', $shipment) }}"
                                                        color="info" icon="eye" class="text-white" />
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <span class="d-block text-center text-danger py-1 px-3">Nenhum envio encontrado!</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-layout.admin.page>

@endsection
