@extends('layouts.store')

@section('title', 'Produtos')

@section('content')

    <div class="container">

        <h1 class="mb-4">Produtos</h1>

        <div class="row">

            @forelse ($products as $product)
                <div class="col-12 col-md-3 mb-3">

                    <div class="card h-100">

                        <img src="https://picsum.photos/seed/{{ rand(1, 10000) }}/400/300" class="card-img-top"
                            alt="{{ $product->name }}">
                            
                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                <a href="{{ route('products.show', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>

                            <p class="text-muted">
                                {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                            </p>


                            <div class="mt-auto">
                                <strong>
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </strong>
                            </div>

                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm mt-3">
                                Ver produto
                            </a>

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

        <div class="mt-3">
            {{ $products->links() }}
        </div>

    </div>

@endsection
