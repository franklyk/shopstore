@extends('layouts.auth')

@section('title', 'Login')

@section('auth')

    <x-forms.form method="POST" route='login' title="Login">

        <x-forms.input name="email" type="email" label="Email" />

        <x-forms.input name="password" type="password" label="Senha" />

        <x-forms.checkbox name="remember" label="Sempre Conectado" />

        <x-buttons.button type="submit" color="primary" class="w-100">
            Entrar
        </x-buttons.button>

    </x-forms.form>
    <div class="d-flex justify-content-between m-3 small">
        <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        <a href="{{ route('register') }}">Criar conta</a>
    </div>

    



@endsection
