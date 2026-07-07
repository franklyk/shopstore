@extends('layouts.admin')

@section('title', 'Editar Coleção')

@section('admin')

<div class="page-container">

    <x-ui.page-header title="Editar Coleção" description="Atualize a coleção">

        <x-slot:actions>

            <x-ui.breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Coleções', 'url' => route('admin.collections.index')],
                ['label' => 'Editar'],
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
            action="{{ route('admin.collections.update', $collection) }}"
            id="form-collection"
        >

            @method('PUT')

            <x-forms.row>

                <x-forms.input
                    name="name"
                    label="Nome"
                    :value="$collection->name"
                    required
                />

            </x-forms.row>

            <x-forms.row>

                <x-forms.input
                    name="year"
                    label="Ano"
                    :value="$collection->year"
                />

            </x-forms.row>

            <x-forms.row>

                <label>Fornecedores</label>

                <select name="supplier_ids[]" multiple class="form-select">

                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            @selected($collection->suppliers->contains($supplier->id))
                        >
                            {{ $supplier->name }}
                        </option>
                    @endforeach

                </select>

            </x-forms.row>

            <x-buttons.button
                type="submit"
                color="save"
                icon="check"
                label="Atualizar"
                form="form-collection"
            />

        </x-forms.form>

    </div>

</div>

@endsection
