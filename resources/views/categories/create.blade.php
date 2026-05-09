@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

    <div class="card p-4">
        <div class="card-header">
            <div class="card-title">
                <h2>
                    Nova Categoria
                </h2>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection
