@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>Novo Produto</h2>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" id="create-form">

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

            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary ms-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">

                    <path d="M9 14L4 9l5-5" />

                    <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                </svg>
                Voltar
            </a>

            <button type="submit" class="btn btn-sm btn-success" form="create-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">

                    <path d="M20 6L9 17l-5-5" />

                </svg>

                Cadastrar
            </button>
        </div>
    </div>
@endsection
