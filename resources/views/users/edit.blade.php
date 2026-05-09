@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

    <h2>Editar Usuário</h2>

    <div class="card p-4">
        <form action="{{ route('users.store') }}" method="POST">

            @csrf
            @method('PUT')

            <input type="hidden" value="{{ $user->id }}">

            <div class="mb-3">
                <label for="name" class="form-label"> <strong>Nome</strong></label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label"><strong>Email</strong></label>
                <input class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                Voltar
            </a>
            <button type="submit" class="btn btn-sm btn-primary"><strong>Salvar</strong></button>
        </form>
    </div>

@endsection
