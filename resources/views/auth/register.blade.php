@extends('layouts.auth')

@section('title', 'Register')

@section('auth')

    <x-forms.form action="{{ route('register.store') }}" method="POST" title="Cadastre-se">

        <x-forms.input name="name" label="Nome" :value="old('name')" />

        <x-forms.input name="email" type="email" label="Email" :value="old('email')" />

        <x-forms.input name="password" type="password" label="Senha" />

        <x-forms.input name="password_confirmation" type="password" label="Confirme sua Senha" />

        <div class="d-flex align-items-center justify-content-between text-end mb-3 small">
            <x-forms.checkbox name="newsletter" label="Receba Novidades" />
            <a href="{{ route('login') }}">
                Já possui conta?
            </a>
        </div>

        <x-buttons.button type="submit" color="primary" class="w-100" label="Cadastrar"/>

    </x-forms.form>

@endsection
