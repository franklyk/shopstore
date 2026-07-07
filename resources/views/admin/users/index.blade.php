@extends('layouts.admin')

@section('title', 'Usuários')

@section('admin')

    <div class="listing page-container">

        <x-ui.page-header title="Usuários Cadastrados" description="Listagem dos usuários da loja">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Usuários']]" />

                <div class="d-flex gap-2">

                    <div class="dropdown">

                        <x-forms.form method="GET">

                            <ul class="dropdown-menu p-2">


                                {{-- STATUS --}}
                                <li class="px-2 fw-bold">Status</li>

                                @foreach ($statuses as $status)
                                    <li class="px-2">
                                        <x-forms.checkbox name="status[]" label="{{ $status->name }}"
                                            value="{{ $status->id }}" :id="'status-' . $status->id" :checked="in_array($status->id, request('status', []))" />
                                    </li>
                                @endforeach

                                <hr>

                                <li class="d-flex justify-content-between px-2">

                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-light">
                                        Limpar
                                    </a>

                                    <x-buttons.button type="submit" color="primary" label="Aplicar" class="btn-sm" />

                                </li>

                            </ul>

                        </x-forms.form>

                    </div>

                    <x-buttons.button color="secondary" label="Filtros" icon="filter" data-bs-toggle="dropdown" />

                    <x-buttons.button href="{{ route('admin.products.create') }}" color="success" icon="plus"
                        label="Novo" />

                </div>

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            @if ($users)

                <table class="table align-middle table-responsive table-bordered table-hover shadow">
                    <thead>
                        <tr>
                            <th scope="col" class="text-light bg-primary">ID</th>

                            <th scope="col" class="text-light bg-primary">Nome</th>
                            <th scope="col" class="text-light bg-primary">Email</th>
                            <th scope="col" class="text-light bg-primary">Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr scope="row" class="clickable-row" data-href="{{ route('admin.users.show', $user->id) }}">

                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->first()?->name }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center text-danger">Sem registros de Usuários</h1>
            @endif
            <div class="my-5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @can('delete users')
        @foreach ($users as $user)
            <x-modal.delete :action="route('admin.users.destroy', $user->id)" :id="$user->id" :name="$user->name" />
        @endforeach
    @endcan


@endsection
