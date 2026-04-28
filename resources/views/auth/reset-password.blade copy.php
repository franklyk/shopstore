@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="container mt-5" style="max-width: 400px;">
        <h3 class="mb-4">Login</h3>

        <x-forms.form method="POST" action="{{ route('login') }}">

            <x-forms.input name="email" type="email" label="Email" />

            <x-forms.input name="password" type="password" label="Senha" />
            
            <x-forms.input name="password" type="password" label="Senha" />

            <x-buttons.button type="submit" color="success">
                Salvar
            </x-buttons.button>

        </x-forms.form>
    </div>
    
@endsection