@extends('layouts.admin')

@section('title', 'Categorias')

@section('content')

    <div class="card">

        <div class="card-header d-flex align-items-center">

            <div class="card-title">
                <h2>Categorias Cadastradas</h2>
            </div>

            @can('create categories')
                <a href="{{ route('categories.create') }}" class="ms-auto btn btn-sm btn-primary">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">

                        <path d="M12 5v14" />
                        <path d="M5 12h14" />

                    </svg>

                    Novo

                </a>
            @endcan

        </div>

        <div class="card-body">

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
                                    <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />

                                            <circle cx="12" cy="12" r="3" />

                                        </svg>

                                    </a>
                                @endcan

                                @can('edit categories')
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                            <path d="M12 20h9" />

                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />

                                        </svg>

                                    </a>
                                @endcan

                                @can('delete categories')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $category->id }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                            <path d="M3 6h18" />
                                            <path d="M8 6V4h8v2" />
                                            <path d="M19 6l-1 14H6L5 6" />
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />

                                        </svg>

                                    </button>
                                @endcan

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-4">

                                Nenhuma categoria encontrada.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @can('delete categories')

        @foreach ($categories as $category)
            <x-modal.delete :action="route('categories.destroy', $category)" :id="$category->id" :name="$category->name" />
        @endforeach

    @endcan

    <div class="mt-3">

        {{ $categories->links() }}

    </div>

@endsection
