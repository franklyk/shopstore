@extends('layouts.admin')

@section('title', 'Pedidos')

@section('admin')

<div class="page-container">
    
    <x-ui.page-header title="Pedidos" description="Gerencie os Pedidos">

            <x-slot:actions>

                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Pedidos']]" />

            </x-slot:actions>

        </x-ui.page-header>



    <div class="card">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Pagamento</th>
                        <th>Data</th>
                        <th width="100"></th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

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

                                @if($order->paid_at)

                                    <span class="badge bg-success">
                                        Pago
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Pendente
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                <x-buttons.button href="{{ route('admin.orders.show', $order) }} " color="view" icon="eye"/>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td>

                                Nenhum pedido encontrado.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


        @if($orders->hasPages())

            <div class="card-footer">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
