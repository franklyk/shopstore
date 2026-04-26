@props(['user' => null])

@php
    $isEdit = isset($user);
@endphp

<x-forms.form method="{{ $isEdit ? 'PUT' : 'POST' }}"
    action="{{ $isEdit ? route('users.update', $user->id) : route('users.store') }}">

    {{-- Nome --}}
    <x-forms.input name="name" label="Nome" :value="old('name', $user->name ?? '')" />

    {{-- Descrição --}}
    <x-forms.field name="description" label="Descrição">
        <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $user->description ?? '') }}</textarea>
    </x-forms.field>

    {{-- Preço --}}
    <x-forms.input name="price" label="Preço" type="number" step="0.01" :value="old('price', $user->price ?? '')" />

    {{-- Estoque --}}
    <x-forms.input name="stock" label="Estoque" type="number" :value="old('stock', $user->stock ?? '')" />

    {{-- Botões --}}
    <div class="d-flex gap-2">

        <x-buttons.button href="{{ route('users.index') }}" color="secondary">
            Voltar
        </x-buttons.button>

        <x-buttons.button type="submit" color="{{ $isEdit ? 'warning' : 'success' }}">
            {{ $isEdit ? 'Atualizar' : 'Salvar' }}
        </x-buttons.button>

    </div>

</x-forms.form>
