@extends('layouts.admin')

@section('title', 'Coleções')

@section('admin')

<div class="page-container">

    <x-ui.page-header title="Coleções" description="Gerencie as coleções do sistema">

        <x-slot:actions>

            <x-ui.breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Coleções'],
            ]" />

            <div class="container-buttons">

                <x-buttons.button
                    href="{{ route('admin.collections.create') }}"
                    color="add"
                    icon="plus"
                    label="Nova coleção"
                />

            </div>

        </x-slot:actions>

    </x-ui.page-header>

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Fornecedores</th>
                    <th>Ano</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($collections as $collection)
                    <tr>
                        <td>{{ $collection->name }}</td>

                        <td>
                            {{ $collection->suppliers->pluck('name')->join(', ') }}
                        </td>

                        <td>{{ $collection->year }}</td>

                        <td>{{ $collection->active ? 'Ativo' : 'Inativo' }}</td>

                        <td>
                            <x-buttons.button
                                href="{{ route('admin.collections.show', $collection) }}"
                                color="view"
                                icon="eye"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhuma coleção cadastrada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination my-5">
            {{ $collections->links() }}
        </div>

    </div>

</div>

@endsection
