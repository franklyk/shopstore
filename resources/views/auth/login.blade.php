@extends('layouts.auth')

@section('title', 'Login')

@section('auth')

    <div class="card shadow p-4 w-100">

        <div class="text-center mb-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" style="max-width: 150px;">
            </a>
        </div>

        <h4 class="mb-4 text-center">Login</h4>

        <x-forms.form method="POST" action="{{ route('login') }}">

            <x-forms.input name="email" type="email" label="Email" />

            <x-forms.input name="password" type="password" label="Senha" />

            <div class="d-flex justify-content-between mb-3 small">
                <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
                <a href="{{ route('register') }}">Criar conta</a>
            </div>

            <x-buttons.button type="submit" color="primary" class="w-100">
                Entrar
            </x-buttons.button>

        </x-forms.form>
        
    </div>
@endsection
