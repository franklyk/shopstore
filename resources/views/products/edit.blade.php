@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')

    <h2>Editar Produto</h2>
    
    <x-products.form :product="$product" />

@endsection
