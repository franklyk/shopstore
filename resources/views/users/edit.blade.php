@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

    <h2>Editar Usuário</h2>
    
    <x-users.form :user="$user" />

@endsection
