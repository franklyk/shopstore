<div class="table-container">

    <x-ui.table>
        <x-slot:table>

            <thead>
                <tr>
                    <th scope="col">CÓDIGO</th>
                    <th scope="col">NOME</th>
                    <th scope="col">COLEÇÃO</th>
                    <th scope="col">MARCA</th>
                    <th scope="col">FORNECEDOR</th>
                    <th scope="col">STATUS</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($products as $product)

                    <tr
                        scope="row"
                        class="clickable-row"
                        data-href="{{ route('admin.products.show', $product) }}"
                    >

                        <td>{{ $product->sku }}</td>

                        <td>{{ $product->name }}</td>

                        <td>
                            {{ $product->collections->first()?->name }}
                        </td>

                        <td>
                            {{ $product->brand?->name }}
                        </td>

                        <td>
                            {{ $product->suppliers->pluck('name')->join(', ') }}
                        </td>

                        <td>
                            <span class="badge text-bg-{{ $product->status->color }}">
                                {{ $product->status->name }}
                            </span>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </x-slot:table>
    </x-ui.table>

</div>

@if ($products->hasPages())

    <div class="listing-pagination">
        {{ $products->links() }}
    </div>

@endif
