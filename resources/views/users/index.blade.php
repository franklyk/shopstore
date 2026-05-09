@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary mb-3">
        Novo Ususário
    </a>
    <div class="card p-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>

                            <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">
                                Visualizar
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
    </div>
    @foreach ($users as $user)
        <x-modal.delete :action="route('products.destroy', $user->id)" :id="$user->id" :name="$user->name" />
    @endforeach


@endsection
