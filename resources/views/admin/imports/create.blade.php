@extends('layouts.admin')

@section('title', 'Nova Importação')

@section('admin')

<div class="editors page-container">

    <x-ui.page-header
        title="Nova Importação"
        description="Envie um catálogo PDF para iniciar uma importação."
    >

        <x-slot:actions>

            <x-ui.breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Importações', 'url' => route('admin.imports.index')],
                ['label' => 'Cadastrar'],
            ]" />

            <div class="container-buttons">

                @can('view import batches')
                    <x-buttons.button
                        href="{{ route('admin.imports.index') }}"
                        color="return"
                        icon="return"
                        label="Voltar"
                    />
                @endcan

                @can('create import batches')
                    <x-buttons.button
                        type="submit"
                        form="create-form"
                        color="add"
                        icon="check"
                        label="Enviar PDF"
                    />
                @endcan

            </div>

        </x-slot:actions>

    </x-ui.page-header>

    <div class="card">

        <x-forms.form
            method="POST"
            action="{{ route('admin.imports.store') }}"
            id="create-form"
            class="create-form"
            enctype="multipart/form-data"
        >

            <x-forms.row>

                <x-forms.input
                    type="file"
                    name="file"
                    label="Arquivo PDF:"
                    accept=".pdf"
                />

            </x-forms.row>

        </x-forms.form>

    </div>

</div>

@endsection
