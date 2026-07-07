@extends('layouts.admin')

@section('title', 'Novo Usuário')

@section('admin')

    <div class="editors page-container">
        <div class="editors page-container">
            <x-ui.page-header title="Novo Usuário" description="Cadastre um Novo Usuário.">

                <x-slot:actions>
                    <x-ui.breadcrumbs :items="[
                        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                        ['label' => 'Usuários', 'url' => route('admin.users.index')],
                        ['label' => 'Cadastrar'],
                    ]" />

                </x-slot:actions>

            </x-ui.page-header>

            <div class="card p-5 bg-light">
                <x-forms.form method="POST" action="{{ route('admin.users.store') }}" class="create-form" id="create-form"
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

                        <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name') }}" required />

                        <x-forms.input type="text" name="email" label="Email:" value="{{ old('email') }}" required />

                        <x-forms.input type="text" name="password" label="Senha:" value="{{ old('password') }}"
                            required />

                        <x-forms.input type="text" name="password_confirmed" label="Confirmar Senha:"
                            value="{{ old('password_confirmed') }}" required />

                        <x-forms.select name="parent_id" :options="$roles" placeholder="Cliente" />

                        <x-forms.select name="status_id" :options="$statuses" :selected="$user->status_id ?? null" />

                    </div>
                    <div class="container-buttons">
                        @can('view users')
                            <x-buttons.button href="{{ route('admin.users.index') }}" color="secondary" icon="return"
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
