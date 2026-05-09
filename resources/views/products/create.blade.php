@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')

    <h2>Novo Produto</h2>
    
    

    <form action="{{ route('products.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                value="{{ old('name') }}">
        </div>

        <div class="mb-3">

            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" id="description" name="description" aria-describedby="emailHelp"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Estoque</label>
            <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    {{-- <x-forms.form method="POST" title="Novo Produto" action="{{ route('products.store') }}">

        
        <x-forms.input name="name" label="Nome" :value="old('name', $product->name ?? '')" />

        
        <x-forms.field name="description" label="Descrição">
            <textarea name="description" id="description"
                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $product->description ?? '') }}</textarea>
        </x-forms.field>

        
        <x-forms.input name="price" label="Preço" type="number" step="0.01" :value="old('price', $product->price ?? '')" />

        
        <x-forms.input name="stock" label="Estoque" type="number" :value="old('stock', $product->stock ?? '')" />

        
        <div class="d-flex gap-2">

            <x-buttons.button href="{{ route('products.index') }}" color="secondary">
                Voltar
            </x-buttons.button>

            <x-buttons.button type="submit" color="warning">
                Salvar
            </x-buttons.button>

        </div>

    </x-forms.form> --}}


@endsection
