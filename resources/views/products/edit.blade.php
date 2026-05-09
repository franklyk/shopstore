@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')

    <h2>Editar Produto</h2>

    <div class="card p-4">
        <form action="{{ route('products.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label"> <strong>Nome</strong></label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $product->name) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><strong>Descrição</strong></label>
                <textarea class="form-control" id="description" name="description"> {{ old('name', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label"><strong>Preço</strong></label>
                <input type="text" class="form-control" id="price" name="price"
                    value="{{ old('price', $product->price) }}">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label"><strong>Estoque</strong></label>
                <input type="text" class="form-control" id="stock" name="stock"
                    value="{{ old('stock', $product->stock) }}">
            </div>


            <button type="submit" class="btn btn-sm btn-primary"><strong>Salvar</strong></button>
        </form>
    </div>
@endsection
