@extends('layouts.admin')

@section('title', 'Nova Categoria')

@section('admin')
    <div class="page-container">

        <x-ui.page-header title="Nova Categoria" description="Cadastrar nova Categoria">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Categorias']]" />

            </x-slot:actions>

        </x-ui.page-header>

        <x-forms.form action="{{ route('admin.categories.store') }}" method="POST">
            <x-forms.row>
                <x-forms.input type="text" name="name" label="Nome" required />
            </x-forms.row>

            <x-forms.row>
                <x-forms.select field_label="Categoria Pai" name="parent_id" :options="$categories" placeholder="Categoria Principal"/>
            </x-forms.row>


            <div class="container-buttons">

                @can('view categories')
                    <x-buttons.button href="{{ route('admin.categories.index') }}" color="return" icon="return"
                        label="Voltar" />
                @endcan

                @can('create categories')
                    <x-buttons.button type="submit" color="add" icon="check" label="Cadastrar" />
                @endcan

            </div>

        </x-forms.form>
    </div>

@endsection
