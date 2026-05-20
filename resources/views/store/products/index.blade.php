@extends('layouts.store')

@section('title', 'Produtos')

@section('content')

<div class="container">

    <h1 class="mb-4">Produtos</h1>

    <div class="row">

        @foreach ($products as $product)
            <div class="col-12 col-md-3 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h5>{{ $product->name }}</h5>

                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <strong>
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

</div>

@endsection