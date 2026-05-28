@extends('layouts.store')

@section('title', 'Home')

@section('content')

    <div class="container">

        <h1 class="mb-4">Produtos</h1>

        <div class="row">

            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://placehold.co/400x300" class="img-fluid rounded" alt="{{ $product->name }}">
                        
                        {{-- <img src="https://picsum.photos/seed/{{ rand(1, 10000) }}/400/300" class="card-img-top"
                            alt="{{ $product->name }}"> --}}

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>

                            </h5>

                            <p class="card-text text-muted">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <div class="mt-auto">

                                <strong class="d-block mb-2">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </strong>

                                <div class="d-flex gap-2 justify-content-end align-items-center">

                                    <x-buttons.button href="{{ route('products.show', $product->slug) }}" color="info"
                                        icon="eye" label="Saiba Mais" />


                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf

                                        <x-buttons.button type="submit" color="primary" icon="check"
                                            label="Adicionar ao carrinho" />

                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-info">
                        Nenhum produto encontrado.
                    </div>
                </div>
            @endforelse

        </div>

    </div>

@endsection
