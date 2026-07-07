@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin')

    <div class="dashboard page-container">

        <x-ui.page-header title="Painel de Controle" description="Resumo Geral de Operações.">
            <x-slot:actions>

                <x-ui.breadcrumbs :items="[['label' => 'Dashboard']]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light shadow">

            <div class="metrics">

                <div class="p-2 bg-dark rounded-3">
                    <div class="py-5 px-3 border border-5 border-danger bg-dark rounded-3 shadow">
                        <dl>
                            <dt class="text-light fw-lighter fs-6">Total de Pedidos : </dt>
                            <dd class="text-danger fw-bold">{{ $ordersCount }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="p-2 bg-dark rounded-3">
                    <div class="py-5 px-3 border border-5 border-danger bg-dark rounded-3 shadow">
                        <dl>
                            <dt class="text-light fw-lighter fs-6">Pedidos Pagos : </dt>
                            <dd class="text-danger fw-bold">{{ $paidOrdersCount }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="p-2 bg-dark rounded-3">
                    <div class="py-5 px-3 border border-5 border-danger bg-dark rounded-3 shadow">
                        <dl>
                            <dt class="text-light fw-lighter fs-6">Pedidos Pendentes : </dt>
                            <dd class="text-danger fw-bold">{{ $pendingOrdersCount }}</dd>
                        </dl>
                    </div>
                </div>


                <div class="p-2 bg-dark rounded-3">
                    <div class="py-5 px-3 border border-5 border-danger bg-dark rounded-3 shadow">
                        <dl>
                            <dt class="text-light fw-lighter fs-6">Envios em Andamento : </dt>
                            <dd class="text-danger fw-bold">{{ $shipmentsCount }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="p-2 bg-dark rounded-3">
                    <div class="py-5 px-3 border border-5 border-danger bg-dark rounded-3 shadow">
                        <dl>
                            <dt class="text-light fw-lighter fs-6">Produtos Cadastrados: </dt>
                            <dd class="text-danger fw-bold">{{ $productsCount }}</dd>
                        </dl>
                    </div>
                </div>


                <div class="p-2 bg-dark rounded-3">
                    <div class="py-5 px-3 border border-5 border-danger bg-dark rounded-3 shadow">
                        <dl>
                            <dt class="text-light fw-lighter fs-6">Clientes Ativos: </dt>
                            <dd class="text-danger fw-bold">{{ $customersCount }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="widgets col-12">

                <div class="p-2 rounded-3 bg-dark">
                    <div class="p-3 border border-5 border-danger rounded-3 shadow">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-light text-center fw-bold">Últimos Pedidos</h5>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table-vs">


                                <thead>
                                    @if (!empty($latestOrders['']))
                                        <tr>
                                            <th class="text-light text-center">#</th>
                                            <th class="text-light text-center">Cliente</th>
                                            <th class="text-light text-center">Total</th>
                                            <th class="text-light text-center">Pagamento</th>
                                            <th width="100"></th>
                                        </tr>
                                    @endif
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
                                                <x-buttons.button href="{{ route('admin.orders.show', $order) }}"
                                                    color="info" icon="eye" class="text-white" />
                                            </td>

                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger fw-bold py-5 px-3">
                                                Nenhum pedido encontrado!
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>

                <div class="p-2 rounded-3 bg-dark">
                    <div class="p-3 border border-5 border-danger rounded-3 shadow">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-light text-center fw-bold">Envios em Andamento</h5>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table-vs">

                                <thead>
                                    @if (!empty($activeShipments['']))

                                    <tr>
                                        <th class="text-light text-center">Pedido nº</th>
                                        <th class="text-light text-center">Status</th>
                                        <th width="100"></th>
                                    </tr>
                                    @endif
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
                                            <td colspan="5" class="text-center text-danger fw-bold py-5 px-3">
                                                Nenhum envio encontrado!
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
