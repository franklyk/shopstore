@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')

    <h2>Editar Categoria</h2>
    
    <x-categories.form :category="$category" />

@endsection
