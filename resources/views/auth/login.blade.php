@extends('layouts.auth')

@section('title', 'Login')

@section('auth')

    <div class="form">

        <div class="form-header">

            <div class="form-logo">

                <a href="{{ route('home') }}">

                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">

                </a>

            </div>

            <h4 class="form-title">
                Login
            </h4>
        </div>

        <x-forms.form method="POST" action="{{ route('login.store') }}" title="Login">

            <x-forms.input name="email" type="email" label="Email" />

            <x-forms.input name="password" type="password" label="Senha" />


            <div class="form-options">
                <x-forms.checkbox name="show_password" label="Mostrar senha" id="show-password" />

                <x-forms.checkbox name="remember" label="Manter conectado" id="remember" value="1" />
            </div>

            <div class="form-action">

                <x-buttons.auth label="Entrar" />

            </div>

        </x-forms.form>

        <div class="form-links">

            <a href="{{ route('password.request') }}">
                Esqueceu a senha?
            </a>

            <a href="{{ route('register') }}">
                Criar conta
            </a>

        </div>

    </div>

@endsection
