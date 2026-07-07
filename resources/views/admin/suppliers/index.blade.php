@extends('layouts.admin')

@section('title', 'Fornecedores')

@section('admin')
    <div class=" page-container">

        <x-ui.page-header title="Fornecedores" description="Gerencie os Fornecedores da loja">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Fornecedores']]" />
                <x-buttons.button href="{{ route('admin.suppliers.create') }}" color="success" icon="plus" label="Novo" />
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">
            @if (!empty($suppliers))
                <table class="table align-middle table-responsive table-bordered table-hover shadow">
                    <thead>
                        <tr>

                            <th scope="col" class="text-light bg-primary">CÓDIGO</th>
                            <th scope="col" class="text-light bg-primary">Nome</th>
                            <th scope="col" class="text-light bg-primary">Slug</th>
                            <th scope="col" class="text-light bg-primary">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr scope="row" class="clickable-row"
                                data-href="{{ route('admin.suppliers.show', $supplier) }}">
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->slug }}</td>
                                <td>
                                    <span class="badge text-bg-{{ $supplier->status->color }}">{{ $supplier->status->name }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <h1>Sem registros de Fornecedores</h1>
            @endif

            <div class="my-5">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
@endsection
