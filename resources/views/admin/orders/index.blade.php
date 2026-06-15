@extends('layouts.admin')

@section('title', 'Pedidos')

@section('admin')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-1">
                Pedidos
            </h1>

            <p class="text-muted mb-0">
                Gerencie os pedidos realizados na loja.
            </p>

        </div>

    </div>

    <div class="card">

        <div class="card-header">
            Lista de Pedidos
        </div>

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

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

                                <a
                                    href="{{ route('admin.orders.show', $order) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Ver
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-4">

                                Nenhum pedido encontrado.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($orders->hasPages())

            <div class="card-footer">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
