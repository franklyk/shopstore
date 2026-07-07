@extends('layouts.admin')

@section('title', 'Novo Fornecedor')

@section('admin')

    <div class="page-container">

        <x-ui.page-header title="Novo Fornecedor" description="Cadastre um novo fornecedor">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Fornecedores', 'url' => route('admin.suppliers.show', $supplier)],
                    ['label' => 'Novo'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.suppliers.index') }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('create products')
                        <x-buttons.button type="submit" form="create-form" color="success   " icon="check" label="Cadastrar" />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            <div class="card p-3 shadow">
                <x-forms.form method="POST" action="{{ route('admin.suppliers.update', $supplier) }}" class="create-form"
                    id="create-form">

                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name',$supplier->name) }}" required />

                </x-forms.form>
            </div>
        </div>

    </div>

@endsection
