@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="container mt-5" style="max-width: 400px;">
        <h3 class="mb-4">Recupere sua senha</h3>

        <x-forms.form method="POST" action="{{ '/forgot-password' }}">

            <x-forms.input name="email" type="email" label="Email" />

            <x-buttons.button type="submit" color="success">
                Enviar
            </x-buttons.button>

        </x-forms.form>
    </div>
    
@endsection