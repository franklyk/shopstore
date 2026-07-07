@extends('layouts.admin')

@section('title', 'Envios')

@section('admin')

    <div class="page-container">

        <x-ui.page-header title="Envios" description="Gerencie os Envios dos Produtos">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Envios']]" />
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card">

            <table>

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
                                    <x-buttons.button href="{{ route('admin.shipments.show', $shipment) }}" color="view" icon="eye" />

                                </td>

                            </tr>

                        @empty

                        <tr>

                            <td>
                                Nenhum Envio Encontrado.
                            </td>

                        </tr>
                        @endforelse

                    </tbody>

                </table>
        </div>

        <div class="mt-3">

            {{ $shipments->links() }}

        </div>


    </div>

@endsection
