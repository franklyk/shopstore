@extends('layouts.auth')

@section('title', 'Inicialização do ShopStore')

@section('auth')

    <div class="form">

        <div class="form-header">

            <div class="form-logo">

                <a>

                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">

                </a>

            </div>

            <h4 class="form-title">
                Inicialização
            </h4>
        </div>

        <x-forms.form method="POST" action="{{ route('bootstrap.store') }}">

            <x-forms.input name="name" type="text" label="Nome" />

            <x-forms.input name="email" type="email" label="Email" />

            <x-forms.input name="password" type="password" label="Senha" />

            <x-forms.input name="password_confirmation" type="password" label="Confirmar Senha" />

            <div class="form-options">
                <x-forms.checkbox name="show_password" label="Mostrar senha" id="show-password" />

                <x-forms.checkbox name="remember" label="Manter conectado" id="remember" value="1" />
            </div>

            <div class="form-action">

                <x-buttons.auth label="Entrar" />

            </div>

        </x-forms.form>
    </div>

@endsection
