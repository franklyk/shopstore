@props([
    'label',
    'id',
    'active' => false,
])

<x-menu.item>

    <div class="menu-accordion">

        <button
            type="button"
            class="menu-link {{ $active ? 'active' : '' }}"
            data-bs-toggle="collapse"
            data-bs-target="#{{ $id }}"
            aria-expanded="{{ $active ? 'true' : 'false' }}"
            aria-controls="{{ $id }}"
        >
            {{ $icon ?? '' }}

            {{ $label }}
        </button>

        <div
            id="{{ $id }}"
            class="collapse {{ $active ? 'show' : '' }}"
        >
            <ul class="menu-list">

                {{ $slot }}

            </ul>
        </div>

    </div>

</x-menu.item>
