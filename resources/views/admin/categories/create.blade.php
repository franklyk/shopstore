@extends('layouts.admin')

@section('title', 'Nova Categoria')

@section('admin')
    <div class="editors page-container">

        <x-ui.page-header title="Nova Categoria" description="Cadastrar nova Categoria">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Categorias', 'url' => route('admin.categories.index')],
                    ['label' => 'Cadastrar'],
                ]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            <x-forms.form action="{{ route('admin.categories.store') }}" method="POST">

                <div class="card p-3 shadow">
                    <x-forms.input type="text" name="name" label="Nome" required />

                    <x-forms.select name="parent_id" label="Categoria Pai" :options="$categories" :selected="$category->parent_id"
                        placeholder="Categoria Raiz" />

                </div>

                <div class="container-buttons">

                    @can('view categories')
                        <x-buttons.button href="{{ route('admin.categories.index') }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('create categories')
                        <x-buttons.button type="submit" color="success" icon="check" label="Cadastrar" />
                    @endcan

                </div>

            </x-forms.form>

        </div>
    </div>

@endsection
