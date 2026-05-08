@extends('layouts.app')

@section('title', 'Categorias')

@section('content')



    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        Nova Categoria
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>

                        <x-buttons.button href="{{ route('categories.show', $category) }}" color="info">
                            Visualizar
                        </x-buttons.button>

                        <x-buttons.button href="{{ route('categories.edit', $category) }}" color="warning">
                            Editar
                        </x-buttons.button>

                        <x-buttons.button type="button" color="danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $category->id }}">
                            Excluir
                        </x-buttons.button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($categories as $category)
        <x-modal.delete :action="route('products.destroy', $category->id)" :id="$category->id" :name="$category->name" />
    @endforeach

@endsection
