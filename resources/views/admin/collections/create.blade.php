@extends('layouts.admin')

@section('title', 'Nova Coleção')

@section('admin')

<div class="page-container">

    <x-ui.page-header title="Nova Coleção" description="Crie uma nova coleção">

        <x-slot:actions>

            <x-ui.breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Coleções', 'url' => route('admin.collections.index')],
                ['label' => 'Nova'],
            ]" />

            <x-buttons.button
                href="{{ route('admin.collections.index') }}"
                color="return"
                icon="return"
                label="Voltar"
            />

        </x-slot:actions>

    </x-ui.page-header>

    <div class="card">

        <x-forms.form
            method="POST"
            action="{{ route('admin.collections.store') }}"
            id="form-collection"
        >

            <x-forms.row>

                <x-forms.input
                    name="name"
                    label="Nome"
                    required
                />

            </x-forms.row>

            <x-forms.row>

                <x-forms.input
                    name="year"
                    label="Ano"
                />

            </x-forms.row>

            <x-forms.row>

                <label>Fornecedores</label>

                <select name="supplier_ids[]" multiple class="form-select">

                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                        </option>
                    @endforeach

                </select>

            </x-forms.row>

            <x-buttons.button
                type="submit"
                color="add"
                icon="check"
                label="Salvar"
                form="form-collection"
            />

        </x-forms.form>

    </div>

</div>

@endsection
