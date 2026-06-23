@extends('layouts.admin')

@section('title', 'Categorias')

@section('admin')

    <x-card title="Categorias Cadastradas">
        <x-slot:actions>

            @can('create categories')
                <x-buttons.button href="{{ route('admin.categories.create') }}" color="primary" icon="plus" label="Novo" />
            @endcan

        </x-slot:actions>
        <table class="table table-bordered align-middle">

            <thead class="text-center">
                <tr>
                    <th scope="col">COD</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria Pai</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

                @forelse ($categories as $category)
                    <tr class="text-center">

                        <th scope="row">
                            {{ $category->id }}
                        </th>

                        <td>
                            {{ $category->name }}
                        </td>

                        <td>

                            @if ($category->parent)
                                {{ $category->parent->name }}
                            @else
                                <span class="badge bg-secondary">
                                    Principal
                                </span>
                            @endif

                        </td>

                        <td>

                            @if ($category->is_active)
                                <span class="badge bg-success">
                                    Ativa
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Inativa
                                </span>
                            @endif

                        </td>

                        <td>

                            @can('view categories')
                                <x-buttons.button href="{{ route('admin.categories.show', $category) }}" color="info"
                                    icon="eye" />
                            @endcan

                            @can('edit categories')
                                <x-buttons.button href="{{ route('admin.categories.edit', $category) }}" color="warning"
                                    icon="edit" />
                            @endcan

                            @can('delete categories')
                                <x-buttons.button type="button" color="danger" icon="trash" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $category->id }}" />
                            @endcan

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-5">

                            <div class="d-flex flex-column align-items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="none"
                                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="text-secondary">

                                    <path d="M3 7h18" />
                                    <path d="M6 3h12l1 4H5l1-4Z" />
                                    <path d="M5 7v11a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7" />

                                </svg>

                                <h5 class="mb-0">
                                    Nenhuma categoria cadastrada
                                </h5>
                                <p class="text-muted mb-0">
                                    Ainda não existem categorias no sistema.
                                </p>

                                @can('create categories')
                                    <x-buttons.button href="{{ route('admin.categories.create') }}" color="primary" icon="plus"
                                        label="Criar primeira categoria" />
                                @endcan

                            </div>

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>
        @can('delete categories')

            @foreach ($categories as $category)
                <x-modal.delete :action="route('admin.categories.destroy', $category)" :id="$category->id" :name="$category->name" />
            @endforeach

        @endcan

        <div class="mt-3">

            {{ $categories->links() }}

        </div>

    </x-card>

@endsection
