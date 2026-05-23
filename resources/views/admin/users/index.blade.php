@extends('layouts.admin')

@section('title', 'Usuários')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Usuários Cadastrados</h2>
            </div>
            @can('create users')
                <a href="{{ route('admin.users.create') }}" class="ms-auto btn btn-sm btn-primary">
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>

                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cargo</th>

                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->first()?->name }}</td>
                            <td>

                                @can('view users')
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>
                                @endcan

                                @can('edit users')
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        </svg>
                                    </a>
                                @endcan

                                @can('delete users')
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}">
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>
    @can('delete users')
        @foreach ($users as $user)
            <x-modal.delete :action="route('products.destroy', $user->id)" :id="$user->id" :name="$user->name" />
        @endforeach
    @endcan

    {{ $users->links() }}

@endsection
