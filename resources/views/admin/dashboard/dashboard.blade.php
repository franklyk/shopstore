@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin')

    <div class="container-fluid">
        <x-ui.page-header title="Painel de Controle" description="Resumo Geral de Operações.">
            <x-slot:actions>
                
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard']]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="row g-4 mb-4">

            <div class="col-md-6 col-xl-4">
                <div class="card border-light px-3 py-5 bg-transparent blur">
                    <dl class="row">
                        <dt class="col-sm-8 fs-5 text-light">Total de Pedidos : </dt>
                        <dd class="col-sm-4 fs-4 text-light">{{ $ordersCount }}</dd>
                    </dl>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-light px-3 py-5 bg-transparent">
                    <dl class="row">
                        <dt class="col-sm-8 fs-5 text-light">Pedidos Pagos : </dt>
                        <dd class="col-sm-4 fs-4 text-light">{{ $paidOrdersCount }}</dd>
                    </dl>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-light px-3 py-5 bg-transparent">
                    <dl class="row">
                        <dt class="col-sm-8 fs-5 text-light">Pedidos Pendentes : </dt>
                        <dd class="col-sm-4 fs-4 text-light">{{ $pendingOrdersCount }}</dd>
                    </dl>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-light px-3 py-5 bg-transparent">
                    <dl class="row">
                        <dt class="col-sm-8 fs-5 text-light">Envios em Andamento : </dt>
                        <dd class="col-sm-4 fs-4 text-light">{{ $shipmentsCount }}</dd>
                    </dl>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-light px-3 py-5 bg-transparent">
                    <dl class="row">
                        <dt class="col-sm-8 fs-5 text-light">Produtos Cadastrados: </dt>
                        <dd class="col-sm-4 fs-4 text-light">{{ $productsCount }}</dd>
                    </dl>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-light px-3 py-5 bg-transparent">
                    <dl class="row">
                        <dt class="col-sm-8 fs-5 text-light">Clientes Ativos: </dt>
                        <dd class="col-sm-4 fs-4 text-light">{{ $customersCount }}</dd>
                    </dl>
                </div>
            </div>

        </div>

        <div class="row g-4">

            <div class="col-lg-6">
                <div class="card bg-transparent pb-3 border">
                    <div class="card-header">
                        <div class="card-title text-light   ">
                            <h5 class="text-center">Últimos Pedidos</h5>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table-dashboard">

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

                                        <td>#{{ $order->id }}</td>

                                        <td>{{ $order->customer_name }}</td>

                                        <td>
                                            R$ {{ number_format($order->total, 2, ',', '.') }}
                                        </td>

                                        <td>{{ $order->payment_status }}</td>

                                        <td>
                                            <x-buttons.button href="{{ route('admin.orders.show', $order) }}"
                                                color="info" icon="eye" />
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
            <div class="col-lg-6">
                <div class="card bg-transparent pb-3 border">
                    <div class="card-header">
                        <div class="card-title text-light   ">
                            <h5 class="text-center">Envios em Andamento</h5>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table-dashboard">

                            <thead>
                                <tr>
                                    <th># cod</th>
                                    <th>Status do Pedido</th>
                                    <th width="100"></th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($activeShipments as $shipment)
                                    <tr>

                                        <td>Pedido nº {{ $shipment->order_id }}</td>

                                        <td>{{ $shipment->status->value }}</td>

                                        <td>
                                            <x-buttons.button href="{{ route('admin.shipments.show', $shipment) }}"
                                                color="info" icon="eye" />
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

    </div>

@endsection
