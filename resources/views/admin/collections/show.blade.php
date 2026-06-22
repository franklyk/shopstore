@extends('layouts.admin')

@section('title', 'Detalhe da Coleção')

@section('admin')

<div class="container-fluid">

    <x-ui.page-header title="Detalhes da Coleção" description="Visualização da coleção">

        <x-slot:actions>

            <x-ui.breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Coleções', 'url' => route('admin.collections.index')],
                ['label' => 'Detalhes'],
            ]" />

            <div class="container-buttons">

                <x-buttons.button
                    href="{{ route('admin.collections.index') }}"
                    color="return"
                    icon="return"
                    label="Voltar"
                />

                <x-buttons.button
                    href="{{ route('admin.collections.edit', $collection) }}"
                    color="edit"
                    icon="edit"
                    label="Editar"
                />

            </div>

        </x-slot:actions>

    </x-ui.page-header>

    <div class="card-vs">

        <dl class="desc-list">

            <dt>Nome</dt>
            <dd>{{ $collection->name }}</dd>

            <dt>Ano</dt>
            <dd>{{ $collection->year }}</dd>

            <dt>Status</dt>
            <dd>{{ $collection->active ? 'Ativo' : 'Inativo' }}</dd>

            <dt>Fornecedores</dt>
            <dd>{{ $collection->suppliers->pluck('name')->join(', ') }}</dd>

            <dt>Criado em</dt>
            <dd>{{ $collection->created_at }}</dd>

            <dt>Atualizado em</dt>
            <dd>{{ $collection->updated_at }}</dd>

        </dl>

    </div>

</div>

@endsection
