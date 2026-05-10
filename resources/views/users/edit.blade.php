@extends('layouts.admin')

@section('title', 'Editar Usuário')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Editar Usuário</h2>
            </div>
        </div>
        <div class="card-body">
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


            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">

                    <path d="M9 14L4 9l5-5" />

                    <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                </svg>
                Voltar
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">

                    <path d="M20 6L9 17l-5-5" />

                </svg>
                <strong>
                    Salvar
                </strong>
            </button> 
        </div>
    </div>

@endsection
