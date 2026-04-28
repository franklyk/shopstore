@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="card shadow p-4 w-100" style="max-width: 420px;">

            <h4 class="mb-4 text-center">Criar Conta</h4>

            <x-forms.form method="POST" action="{{ '/register' }}">

                {{-- Nome --}}
                <x-forms.input name="name" label="Nome" :value="old('name')" />

                {{-- Email --}}
                <x-forms.input name="email" type="email" label="Email" :value="old('email')" />

                {{-- Senha --}}
                <x-forms.input name="password" type="password" label="Senha" />

                {{-- Lembrar de mim --}}
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">
                        Lembrar de mim
                    </label>
                </div>

                {{-- Links auxiliares --}}
                <div class="d-flex justify-content-between mb-3 small">
                    <a href="{{ route('login') }}">
                        Já sou cadastrado
                    </a>
                </div>

                {{-- Botão --}}
                <x-buttons.button type="submit" color="primary" class="w-100">
                    Cadastrar
                </x-buttons.button>

            </x-forms.form>

        </div>

    </div>
@endsection
