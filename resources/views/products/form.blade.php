@props(['product' => null])


@php
    $isEdit = isset($product);
@endphp

<x-forms.form method="{{ $isEdit ? 'PUT' : 'POST' }}"
    action="{{ $isEdit ? route('products.update', $product->id) : route('products.store') }}">

    {{-- Nome --}}
    <x-forms.input name="name" label="Nome" :value="old('name', $product->name ?? '')" />

    {{-- Descrição --}}
    <x-forms.field name="description" label="Descrição">
        <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $product->description ?? '') }}</textarea>
    </x-forms.field>

    {{-- Preço --}}
    <x-forms.input name="price" label="Preço" type="number" step="0.01" :value="old('price', $product->price ?? '')" />

    {{-- Estoque --}}
    <x-forms.input name="stock" label="Estoque" type="number" :value="old('stock', $product->stock ?? '')" />

    {{-- Botões --}}
    <div class="d-flex gap-2">

        <x-buttons.button href="{{ route('products.index') }}" color="secondary">
            Voltar
        </x-buttons.button>

        <x-buttons.button type="submit" color="{{ $isEdit ? 'warning' : 'success' }}">
            {{ $isEdit ? 'Atualizar' : 'Salvar' }}
        </x-buttons.button>

    </div>

</x-forms.form>
