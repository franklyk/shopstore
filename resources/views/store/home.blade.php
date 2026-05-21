@extends('layouts.store')

@section('title', 'Home')

@section('content')

    <div class="container">

        <h1 class="mb-4">Produtos</h1>

        <div class="row">

            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://picsum.photos/seed/{{ rand(1, 10000) }}/400/300" class="card-img-top"
                            alt="{{ $product->name }}">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                <a href="{{ route('products.public.show', $product->slug) }}">
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

                                {{-- <x-buttons.button href="{{ route('products.public.show', $product->slug) }}" color="info" icon="eye" label="Saiba Mais"/> --}}


                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary w-100">
                                        Adicionar ao carrinho
                                    </button>
                                </form>

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
