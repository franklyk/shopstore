@extends('layouts.app')

@section('title', 'Novo Usuário')

@section('content')

    <h2>Novo Usuário</h2>
    <div class="card p-4">

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">

                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmed" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmed" name="password_confirmed">
            </div>


            <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
        </form>
    </div>

@endsection
