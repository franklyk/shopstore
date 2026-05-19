@props(['columns' => []])

<thead class="text-center">
    <tr>
        @foreach ($columns as $column)
            <th scope="col">
                {{ $column }}
            </th>
        @endforeach
    </tr>
</thead>
