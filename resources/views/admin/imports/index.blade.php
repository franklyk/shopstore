@extends('layouts.admin')

@section('title', 'Importações')

@section('admin')
    <div class="page-container">

        <x-ui.page-header
            title="Arquivos em PDF"
            description="Gerencie os arquivos PDF enviados para importação."
        >

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Importações'],
                ]" />

                <x-buttons.button
                    href="{{ route('admin.imports.create') }}"
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
                    <th>ARQUIVO</th>
                    <th>STATUS</th>
                    <th>DATA</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($imports as $import)

                    <tr>
                        <td data-field="center">
                            {{ $import->id }}
                        </td>

                        <td>
                            {{ $import->original_name }}
                        </td>

                        <td data-field="center">
                            {{ $import->status }}
                        </td>

                        <td data-field="center">
                            {{ $import->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td>

                            <x-buttons.button
                                href="{{ route('admin.imports.show', $import) }}"
                                color="view"
                                icon="eye"
                            />

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center pt-5">
                            Sem registros de Arquivos
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="pagination my-5">
            {{ $imports->links() }}
        </div>

    </div>
@endsection
