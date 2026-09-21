@extends('layouts.auth')

@section('title', 'Register')

@section('auth')

    <div class="form">

        <div class="form-header">

            <div class="form-logo">

                <a href="{{ route('home') }}">

                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">

                </a>

            </div>

            <h4 class="form-title">
                Cadastrar
            </h4>
        </div>

        <x-forms.form method="POST" action="{{ route('register.store') }}" title="Cadastre-se">

            <x-forms.input name="name" label="Nome" :value="old('name')" />

            <x-forms.input name="email" type="email" label="Email" :value="old('email')" />

            <x-forms.input type="password" name="password" label="Senha" />

            <x-forms.input type="password" name="password_confirmation" label="Confirme sua Senha" />

            <div class="form-options">
                <x-forms.checkbox name="show_password" label="Mostrar senha" id="show-password" />
            </div>

            <div class="form-links">
                <x-forms.checkbox name="newsletter" id="newsletter" label="Receba Novidades" />
                <a href="{{ route('login') }}">
                    Já possui conta?
                </a>
            </div>

            <div class="form-action">
                <x-buttons.auth label="Cadastrar" />
            </div>

        </x-forms.form>
    </div>
@endsection
