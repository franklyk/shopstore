@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')

    <h2>Editar Produto</h2>
    
    <x-product-form :product="$product" />

@endsection
