@extends('layouts.admin')

@section('admin')
    <div class="details page-container">
        {{-- @dd($user) --}}
        <x-ui.page-header title="Detalhes do Usuário" description="Visualize todos o detalhes do usuário.">

            <x-slot:actions>

                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Usuários', 'url' => route('admin.users.index')],
                    ['label' => 'Visualizar'],
                ]" />

                <div class="container-buttons">

                    @can('view users')
                        <x-buttons.button href="{{ route('admin.users.index') }}" color="secondary" icon="return" label="Voltar" />
                    @endcan

                    @can('edit users')
                        <x-buttons.button href="{{ route('admin.users.edit', $user) }}" color="warning" icon="edit"
                            label="Editar" />
                    @endcan

                    @can('delete users')
                        <x-buttons.button color="danger" icon="trash" label="Excluir" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $user->id }} " />
                    @endcan

                </div>

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            <div class="card border border-1 shadow container-image mb-5 rounded-4">

                <div class="preview-image" id="preview-image">
                    @if ($user->avatar)
                        <img class="m-auto" src="{{ asset('storage/' . $user->avatar) }}" id="image">
                    @else
                        <div class="preview-placeholder d-flex justify-content-center">
                            <x-icons.camera />
                        </div>
                    @endif
                </div>

                <label class="label-image" for="input-image">
                    <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">
                </label>

            </div>

            <div class="card p-3 shadow">
                
                <dl class="row">

                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Telefone</dt>
                    <dd class="col-sm-9">{{ $user->phone }}</dd>

                    <dt class="col-sm-3">Verificação do Email</dt>
                    <dd class="col-sm-9">{{ $user->email_verified_at }}</dd>

                    <dt class="col-sm-3">Cadastrado em:</dt>
                    <dd class="col-sm-9">{{ $user->created_at }}</dd>

                    <dt class="col-sm-3">Última atualização em:</dt>
                    <dd class="col-sm-9">{{ $user->updated_at }}</dd>

                </dl>
            </div>
        </div>
    </div>

@section('modals')
    @can('delete users')
        <x-modal.delete :action="route('admin.users.destroy', $user)" :id="$user->id" :name="$user->name" />
    @endcan
@endsection

@endsection
