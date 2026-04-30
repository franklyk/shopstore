@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4">🛒 Carrinho</h2>

        @if (empty($items) || (is_countable($items) && count($items) === 0))
            <div class="alert alert-info">
                Seu carrinho está vazio.
            </div>
        @else
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th width="120">Qtd</th>
                        <th>Subtotal</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @php $total = 0; @endphp

                    @foreach ($items as $key => $item)
                        @php
                            $id = $isSession ? $key : $item->id;
                            $name = $isSession ? $item['name'] : $item->product->name;
                            $price = $isSession ? $item['price'] : $item->price;
                            $qty = $isSession ? $item['quantity'] : $item->quantity;

                            $subtotal = $price * $qty;
                            $total += $subtotal;
                        @endphp

                        <tr>
                            <td>{{ $name }}</td>

                            <td class="price" data-price="{{ $price }}">
                                R$ {{ number_format($price, 2, ',', '.') }}
                            </td>

                            <td>
                                <input type="number" class="form-control form-control-sm input-qty"
                                    data-id="{{ $id }}" value="{{ $qty }}" min="1">
                            </td>

                            <td class="subtotal" data-value="{{ $subtotal }}">
                                R$ {{ number_format($subtotal, 2, ',', '.') }}
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-remove"
                                    data-id="{{ $id }}">
                                    Remover
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="text-end">
                <h4>
                    Total:
                    <strong id="cart-total">
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </strong>
                </h4>
            </div>
        @endif

    </div>
    <script>
        /* =========================
       DEBOUNCE
    ========================= */
        function debounce(fn, delay = 500) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        /* =========================
           RECALCULAR TOTAL
        ========================= */
        function recalculateTotal() {

            let total = 0;

            document.querySelectorAll('.subtotal').forEach(el => {
                const value = parseFloat(el.dataset.value);
                if (!isNaN(value)) total += value;
            });

            document.getElementById('cart-total').innerText =
                'R$ ' + total.toFixed(2).replace('.', ',');
        }

        /* =========================
           REMOVER ITEM
        ========================= */
        document.addEventListener('click', function(e) {

            const button = e.target.closest('.btn-remove');
            if (!button) return;

            const id = button.dataset.id;

            fetch(`/cart/remove/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        button.closest('tr').remove();
                        recalculateTotal();
                    }
                })
                .catch(err => console.error(err));

        });

        /* =========================
           UPDATE QUANTIDADE
        ========================= */
        const handleQuantityChange = debounce(function(input) {

            const id = input.dataset.id;
            let quantity = parseInt(input.value);

            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                input.value = 1;
            }

            input.disabled = true;

            fetch(`/cart/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(res => res.json())
                .then(data => {

                    const row = input.closest('tr');

                    const price = parseFloat(row.querySelector('.price').dataset.price);

                    if (isNaN(price)) {
                        console.error('Preço inválido');
                        return;
                    }

                    const subtotal = price * quantity;

                    const subtotalCell = row.querySelector('.subtotal');

                    subtotalCell.dataset.value = subtotal;
                    subtotalCell.innerText =
                        'R$ ' + subtotal.toFixed(2).replace('.', ',');

                    recalculateTotal();

                })
                .catch(err => console.error(err))
                .finally(() => {
                    input.disabled = false;
                });

        }, 500);

        /* =========================
           EVENTO INPUT
        ========================= */
        document.querySelectorAll('.input-qty').forEach(input => {

            input.addEventListener('input', function() {
                handleQuantityChange(this);
            });

        });
    </script>
@endsection
