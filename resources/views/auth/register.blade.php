@extends('layouts.auth')

@section('title', 'Register')

@section('auth')

    

    <div class="card shadow p-4 w-100">

        <div class="text-center mb-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" style="max-width: 150px;">
            </a>
        </div>

        <h4 class="mb-4 text-center">Criar Conta</h4>

        <x-forms.form method="POST" action="{{ route('register') }}">

            <x-forms.input name="name" label="Nome" :value="old('name')" />

            <x-forms.input name="email" type="email" label="Email" :value="old('email')" />

            <x-forms.input name="password" type="password" label="Senha" />

            <x-forms.input name="password_confirmation" type="password" label="Confirmar Senha" />

            <div class="text-end mb-3 small">
                <a href="{{ route('login') }}">
                    Já possui conta?
                </a>
            </div>

            <x-buttons.button type="submit" color="primary" class="w-100">
                Cadastrar
            </x-buttons.button>

        </x-forms.form>

    </div>

@endsection
