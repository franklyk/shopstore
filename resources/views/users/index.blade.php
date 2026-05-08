@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

    <x-buttons.button href="{{ route('users.create') }}" color="primary">
        Novo Ususário
    </x-buttons.button>

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
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->description }}</td>
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

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($users as $user)
        <x-modal.delete :action="route('products.destroy', $user->id)" :id="$user->id" :name="$user->name" />
    @endforeach


@endsection
