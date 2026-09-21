@props([
    'label',
    'id',
])

<x-menu.item>

    <button
        type="button"
        class="menu-link"
        data-bs-toggle="collapse"
        data-bs-target="#{{ $id }}"
        aria-expanded="false"
        aria-controls="{{ $id }}"
    >
        {{ $label }}
    </button>

    <div
        id="{{ $id }}"
        class="collapse"
    >
        <ul class="menu-list">

            {{ $slot }}

        </ul>
    </div>

</x-menu.item>
