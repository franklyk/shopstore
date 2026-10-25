
@extends('layouts.admin')

@section('layout-admin')
    @php
        $groupLabels = [
            'users' => 'Usuários',
            'user' => 'Usuários',
            'products' => 'Produtos',
            'categories' => 'Categorias',
            'orders' => 'Pedidos',
            'roles' => 'Funções de acesso',
            'permissions' => 'Permissões de acesso',
            'reports' => 'Relatórios',
            'settings' => 'Configurações',
        ];
    @endphp

    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xxl-10">
                <div class="card shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <h1 class="h4 mb-1">Gerenciar permissões</h1>

                        <p class="text-muted mb-4">
                            Usuário: {{ $targetUser->name }}
                        </p>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.system.users.permissions.update',
                                $targetUser
                            ) }}"
                        >
                            @csrf
                            @method('PUT')

                            @forelse ($groups as $group => $permissions)
                                <section class="mb-4">
                                    <h2 class="h6 border-bottom pb-2 mb-3">
                                        {{ $groupLabels[$group] ?? ucfirst(
                                            str_replace(['.', '_', '-'], ' ', $group)
                                        ) }}
                                    </h2>

                                    <div class="row g-3">
                                        @foreach ($permissions as $permission)
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-check h-100">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        id="permission-{{ $permission->id }}"
                                                        value="{{ $permission->id }}"
                                                        @checked(
                                                            in_array(
                                                                $permission->id,
                                                                old('permissions', $assignedIds)
                                                            )
                                                        )
                                                    >

                                                    <label
                                                        class="form-check-label text-break"
                                                        for="permission-{{ $permission->id }}"
                                                    >
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @empty
                                <p class="text-muted">
                                    Não há permissões disponíveis para atribuição.
                                </p>
                            @endforelse

                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Salvar permissões
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
