@extends('layouts.admin')

@section('title', 'Editar Produto')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Editar Produto</h2>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" id="edit-form">

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

            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">

                    <path d="M9 14L4 9l5-5" />

                    <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                </svg>
                Voltar
            </a>


            <button type="submit" class="btn btn-sm btn-primary" form="edit-form">
                <strong>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path d="M20 6L9 17l-5-5" />

                    </svg>

                    Salvar
                </strong>
            </button>
        </div>
    </div>
@endsection
