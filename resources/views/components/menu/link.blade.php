@props(['href', 'label'])

<x-menu.item>
    <a href="{{ $href }}" class="menu-link">
        {{ $label }}
    </a>
</x-menu.item>
