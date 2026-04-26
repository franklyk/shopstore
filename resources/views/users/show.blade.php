@extends('layouts.app')

@section('content')

<h2>Detalhes do Usuário</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>

        <p><strong>Preço:</strong> R$ {{ $user->price }}</p>
        <p><strong>Estoque:</strong> {{ $user->stock }}</p>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Voltar
        </a>

        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
            Editar
        </a>
    </div>
</div>

@endsection