@extends('layouts.admin')

@section('title', 'Editar Fornecedor')

@section('admin')

    <div class="page-container">

        <x-ui.page-header title="Editar Fornecedor" description="Atualize os dados do fornecedor">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Fornecedores', 'url' => route('admin.suppliers.index')],
                    ['label' => 'Editar'],
                ]" />

                <div class="container-buttons">

                    @can('view suppliers')
                        <x-buttons.button
                            href="{{ route('admin.suppliers.index') }}"
                            color="return"
                            icon="return"
                            label="Voltar"
                        />
                    @endcan

                    @can('edit suppliers')
                        <x-buttons.button
                            type="submit"
                            form="edit-form"
                            color="edit"
                            icon="check"
                            label="Atualizar"
                        />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card">

            <x-forms.form
                method="POST"
                action="{{ route('admin.suppliers.update', $supplier) }}"
                class="edit-form"
                id="edit-form">

                @method('PUT')

                <x-forms.row>

                    <x-forms.input
                        type="text"
                        name="name"
                        label="Nome:"
                        value="{{ old('name', $supplier->name) }}"
                        required
                    />

                </x-forms.row>

            </x-forms.form>

        </div>

    </div>

@endsection
