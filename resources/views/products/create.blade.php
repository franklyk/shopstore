@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')

    <h2>Novo Produto</h2>

    <div class="card p-4">

        <form action="{{ route('products.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">

                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Preço</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Estoque</label>
                <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
            </div>


            <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
        </form>
    </div>
@endsection
