@extends('layouts.auth')

@section('title', 'Login')

@section('auth')

    <x-forms.form method="POST" action="{{ route('login.create') }}" title="Login">

        <x-forms.input name="email" type="email" label="Email" />

        <x-forms.input name="password" type="password" label="Senha" />

        <x-forms.checkbox name="remember" label="Sempre Conectado" />

        <x-buttons.button type="submit" color="primary" class="w-100" label="Entrar"/>

    </x-forms.form>
    <div class="d-flex justify-content-between m-3 small">
        <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        <a href="{{ route('register.create') }}">Criar conta</a>
    </div>

    



@endsection
