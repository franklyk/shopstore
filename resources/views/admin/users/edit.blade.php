@extends('layouts.admin')

@section('title', 'Editar Usuário')

@section('admin')

    <div class="editors page-container">
        <x-ui.page-header title="Editar Usuário" description="Edite Qualquer Detalhe do Usuário.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Usuários', 'url' => route('admin.users.index')],
                    ['label' => 'Visualizar', 'url' => route('admin.users.show', $user)],
                    ['label' => 'Editar'],
                ]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            <x-forms.form action="{{ route('admin.users.update', $user) }}" method="PUT" class="edit-form" id="edit-form"
                enctype="multipart/form-data">

                <div class="card border border-1 shadow container-image mb-5 rounded-4">
                    <div class="preview-image" id="preview-image">
                        <div class="preview-placeholder d-flex justify-content-center">
                            <x-icons.camera />
                        </div>
                    </div>
                    <label class="label-image" for="input-image">
                        <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">
                    </label>


                </div>

                <div class="card p-3 shadow">

                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name', $user->name) }}" />


                    <x-forms.input type="text" name="email" label="E-mail:" value="{{ old('name', $user->email) }}" />


                    <x-forms.input type="text" name="phone" label="Contato:" value="{{ old('name', $user->phone) }}" />

                </div>

                <div class="container-buttons">
                    @can('view users')
                        <x-buttons.button href="{{ route('admin.users.show', $user) }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('edit users')
                        <x-buttons.button type="submit" form="edit-form" color="warning" icon="edit" label="Salvar" />
                    @endcan

                </div>

            </x-forms.form>
        </div>

    </div>

@endsection
