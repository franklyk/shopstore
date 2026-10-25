
@props([
    'color' => 'primary',
    'icon' => null,
    'label' => null,
    'type' => 'button',
])

@php
    $isLink = $attributes->has('href');

    $icons = [
        'edit',
        'eye',
        'plus',
        'return',
        'check',
        'trash',
    ];

    $icon = is_numeric($icon)
        ? ($icons[(int) $icon] ?? null)
        : $icon;

    $classes = trim(
        'vs-button vs-button-' . $color . ' ' .
        ($isLink ? 'vs-button-link' : '')
    );
@endphp

@if ($isLink)
    <a {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-dynamic-component :component="'icons.' . $icon" />
        @endif

        @if ($label)
            <span>{{ $label }}</span>
        @endif

        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if ($icon)
            <x-dynamic-component :component="'icons.' . $icon" />
        @endif

        @if ($label)
            <span>{{ $label }}</span>
        @endif

        {{ $slot }}
    </button>
@endif
