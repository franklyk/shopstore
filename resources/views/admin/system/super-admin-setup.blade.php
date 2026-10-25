@extends('layouts.auth')

@section('title', 'INICIALIZAÇÃO DO SISTEMA')

@section('auth')

    <div class="form">

        <div class="form-header">

            <div class="form-logo">

                <a href="{{ route('home') }}">

                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">

                </a>

            </div>

            <h4 class="form-title">
                Cadastrar Super Admin
            </h4>

            <x-forms.form method="POST" action="{{ route('admin.system.super-admin.store') }}">

                <x-forms.input name="name" type="text" label="Nome completo" value="{{ old('name') }}"
                    maxlength="255" autocomplete="name" required autofocus />

                <x-forms.input name="email" type="email" label="E-mail" value="{{ old('email') }}" maxlength="255"
                    autocomplete="email" required />

                <x-forms.input name="password" type="password" label="Senha Provisória" value="{{ old('password') }}"
                    minlength="12" autocomplete="new-password" required />
                <div class="form-text px-3 text-danger">
                    Use pelo menos 12 caracteres. O Super Admin
                    deverá alterar essa senha no primeiro acesso.
                </div>

                <x-forms.input name="password_confirmation" type="password" label="Confirme a Senha Provisória"
                    value="{{ old('password_confirmation') }}" minlength="12" autocomplete="new-password" required />

                    <div class="form-action">

                        <x-buttons.auth label="Cadastrar Super Admin" />
                    </div>

            </x-forms.form>

        </div>
    </div>
@endsection
