@extends('layouts.admin')

@section('title', 'Editar Categoria')

@section('admin')

    <div class="page-container">
        <x-ui.page-header title="Editar Categoria" description="Edite Qualquer Detalhe da Categoria.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Categorias', 'url' => route('admin.categories.index')],
                    ['label' => 'Visualizar', 'url' => route('admin.categories.show', $category)],
                    ['label' => 'Editar'],
                ]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card-vs">
            <x-forms.form action="{{ route('admin.categories.update', $category) }}" method="PUT">

                <x-forms.row>
                    <x-forms.input type="text" name="name" label="Nome" required
                        value="{{ old('name', $category->name) }}" />
                </x-forms.row>

                <x-forms.row>
                    <x-forms.select field_label="Categoria Pai" name="parent_id" :options="$categories"
                        placeholder="Categoria Principal" />
                </x-forms.row>

                <div class="container-buttons">
                    @can('view categories')
                        <x-buttons.button href="{{ route('admin.categories.index') }}" color="return" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('edit categories')
                        <x-buttons.button type="submit" color="edit" icon="edit" label="Salvar" />
                    @endcan

                </div>

            </x-forms.form>

        </div>
    </div>

@endsection
