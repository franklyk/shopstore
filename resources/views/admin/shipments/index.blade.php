
@extends('layouts.admin')

@section('title', 'Shipments')

@section('admin')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>
            Shipments
        </h1>

    </div>

    <div class="card">

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Pedido</th>
                        <th>Status</th>
                        <th>Transportadora</th>
                        <th>Rastreio</th>
                        <th></th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($shipments as $shipment)

                        <tr>

                            <td>
                                #{{ $shipment->id }}
                            </td>

                            <td>
                                #{{ $shipment->order_id }}
                            </td>

                            <td>
                                {{ $shipment->status->value }}
                            </td>

                            <td>
                                {{ $shipment->carrier ?? '-' }}
                            </td>

                            <td>
                                {{ $shipment->tracking_code ?? '-' }}
                            </td>

                            <td class="text-end">

                                <a
                                    href="{{ route('admin.shipments.show', $shipment) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Abrir
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-4">

                                Nenhum shipment encontrado.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">

        {{ $shipments->links() }}

    </div>

</div>

@endsection
