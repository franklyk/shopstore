@extends('layouts.admin')

@section('title', 'Novo Fornecedor')

@section('admin')

    <div class="page-container">

        <x-ui.page-header title="Novo Fornecedor" description="Cadastre um novo fornecedor">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Fornecedores', 'url' => route('admin.suppliers.index')],
                    ['label' => 'Novo'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.suppliers.index') }}" color="return" icon="return" label="Voltar" />
                    @endcan

                    @can('create products')
                        <x-buttons.button type="submit" form="create-form" color="add" icon="check" label="Cadastrar" />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card">
            <x-forms.form method="POST" action="{{ route('admin.suppliers.store') }}" class="create-form" id="create-form">

                <x-forms.row>
                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name') }}" required />
                </x-forms.row>

            </x-forms.form>

        </div>

    </div>

@endsection
