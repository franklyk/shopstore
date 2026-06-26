@extends('layouts.admin')

@section('title', 'Categorias')

@section('admin')
    <div class=" page-container">

        <x-ui.page-header title="Categorias Cadastradas" description="Gerencie as Categorias da loja">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Categorias']]" />
                <x-buttons.button href="{{ route('admin.categories.create') }}" color="add" icon="plus" label="Novo" />
            </x-slot:actions>

        </x-ui.page-header>

        <table>
            <thead>
                <tr>
                    <th scope="col">COD</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria Pai</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>

                        <th scope="row">
                            {{ $category->id }}
                        </th>

                        <td>
                            {{ $category->name }}
                        </td>

                        <td>

                            @if ($category->parent)
                                <span class="badge bg-black">
                                    {{ $category->parent->name }}
                                </span>
                            @else
                                <span class="badge bg-black">
                                    Principal
                                </span>
                            @endif

                        </td>

                        <td>

                            @if ($category->active)
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
                                    <x-buttons.button href="{{ route('admin.categories.create') }}" color="primary"
                                        icon="plus" label="Criar primeira categoria" />
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
        <div class="pagination my-5">
            {{ $categories->links() }}
        </div>

    </div>

@endsection
