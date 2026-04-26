@extends('layouts.app')

@section('title', 'Usuários')

@section('content')



    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
        Novo Produto
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->description }}</td>
                    <td>R$ {{ $user->price }}</td>
                    <td>{{ $user->stock }}</td>
                    <td>

                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $user->id }}">
                            Excluir
                        </button>

                        <x-modal :product="$user" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

@endsection
