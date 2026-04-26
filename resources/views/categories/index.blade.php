@extends('layouts.app')

@section('title', 'Categorias')

@section('content')



    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        Novo Produto
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

                        <a href="{{ route('categories.show', $category) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $category->id }}">
                            Excluir
                        </button>

                        <x-modal :category="$category" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

@endsection
