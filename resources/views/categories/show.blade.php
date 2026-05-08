@extends('layouts.app')

@section('content')

<h2>Detalhes da Categoria</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $category->name }}</h5>

        <p><strong>Descrição:</strong> R$ {{ $category->desciption }}</p>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            Voltar
        </a>

        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
            Editar
        </a>
    </div>
</div>

@endsection