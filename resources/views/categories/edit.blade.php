@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

    

    <div class="card p-4">
        <div class="card-header">
            <div class="card-title">
                <h2>
                    Editar Produto
                </h2>
            </div>
        </div>
        

        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label"> <strong>Nome</strong></label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $category->name) }}">
                </div>

                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-secondary">
                    Voltar
                </a>

                <button type="submit" class="btn btn-sm btn-primary"><strong>Salvar</strong></button>
            </form>
        </div>
    </div>
@endsection
