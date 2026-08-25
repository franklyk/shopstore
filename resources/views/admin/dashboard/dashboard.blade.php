@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin')

    <x-layout.admin.page-container>
        <x-ui.page-header title="Painel de Controle" description="Resumo Geral de Operações.">
            <x-slot:actions>

                <x-ui.breadcrumbs :items="[['label' => 'Dashboard']]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="dashboard">

            <div class="card p-3 shadow">

                <div class="metrics">

                    <div class="p-1 bg-light rounded-3">
                        <div class="py-5 px-3 border border-5 border-white rounded-3">
                            <dl>
                                <dt class="text-dark fw-lighter fs-6">Total de Pedidos : </dt>
                                <dd class="text-danger fw-bold">{{ $ordersCount }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="p-1 bg-light rounded-3">
                        <div class="py-5 px-3 border border-5 border-white rounded-3">
                            <dl>
                                <dt class="text-dark fw-lighter fs-6">Pedidos Pagos : </dt>
                                <dd class="text-danger fw-bold">{{ $paidOrdersCount }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="p-1 bg-light rounded-3">
                        <div class="py-5 px-3 border border-5 border-white rounded-3">
                            <dl>
                                <dt class="text-dark fw-lighter fs-6">Pedidos Pendentes : </dt>
                                <dd class="text-danger fw-bold">{{ $pendingOrdersCount }}</dd>
                            </dl>
                        </div>
                    </div>


                    <div class="p-1 bg-light rounded-3">
                        <div class="py-5 px-3 border border-5 border-white rounded-3">
                            <dl>
                                <dt class="text-dark fw-lighter fs-6">Envios em Andamento : </dt>
                                <dd class="text-danger fw-bold">{{ $shipmentsCount }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="p-1 bg-light rounded-3">
                        <div class="py-5 px-3 border border-5 border-white rounded-3">
                            <dl>
                                <dt class="text-dark fw-lighter fs-6">Produtos Cadastrados: </dt>
                                <dd class="text-danger fw-bold">{{ $productsCount }}</dd>
                            </dl>
                        </div>
                    </div>


                    <div class="p-1 bg-light rounded-3">
                        <div class="py-5 px-3 border border-5 border-white rounded-3">
                            <dl>
                                <dt class="text-dark fw-lighter fs-6">Clientes Ativos: </dt>
                                <dd class="text-danger fw-bold">{{ $customersCount }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="widgets col-12">

                    <div class="p-1 bg-light rounded-3">
                        <div class="p-3 border border-5 border-white rounded-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="text-dark text-center fw-bold">Últimos Pedidos</h5>
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
                                <h1 class="text-center text-danger py-5 px-3">Nenhum pedido encontrado!</h1>
                            @endif
                        </div>
                    </div>

                    <div class="p-1 bg-light rounded-3">
                        <div class="p-3 border border-5 border-white rounded-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="text-dark text-center fw-bold">Envios em Andamento</h5>
                                </div>
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
                                                        <x-buttons.button
                                                            href="{{ route('admin.shipments.show', $shipment) }}"
                                                            color="info" icon="eye" class="text-white" />
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h1 class="text-center text-danger py-5 px-3  ">Nenhum envio encontrado!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-layout.admin.page-container>

@endsection
