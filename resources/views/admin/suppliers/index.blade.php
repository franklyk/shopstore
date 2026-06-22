@extends('layouts.admin')

@section('title', 'Fornecedores')

@section('admin')
    <div class="page-container">

        <x-ui.page-header title="Fornecedores Cadastrados" description="Gerencie os fornecedores do sistema">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Fornecedores']
                ]" />

                <x-buttons.button
                    href="{{ route('admin.suppliers.create') }}"
                    color="add"
                    icon="plus"
                    label="Novo"
                />
            </x-slot:actions>

        </x-ui.page-header>

        <table>
            <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td data-field="center">{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->slug }}</td>
                        <td data-field="center">
                            {{ $supplier->active ? 'Sim' : 'Não' }}
                        </td>
                        <td>
                            <x-buttons.button
                                href="{{ route('admin.suppliers.show', $supplier) }}"
                                color="view"
                                icon="eye"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Sem registros de Fornecedores</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <div class="pagination my-5">
            {{ $suppliers->links() }}
        </div>

    </div>
@endsection
