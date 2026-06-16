@props([
    'color',
    'icon' => null,
    'label' => null,
    'type' => 'button',
])

@php
    $isLink = $attributes->has('href');

    $icons = [
        'edit' => 'edit',
        'eye' => 'eye',
        'plus' => 'plus',
        'return' => 'return',
        'check' => 'check',
        'trash' => 'trash',
    ];

    $icon = $icons[$icon] ?? $icon;
@endphp

@if ($isLink)

    <a {{ $attributes->merge(['class' => 'button button-' . $color]) }}>

        @if($icon)
            <x-dynamic-component
                :component="'icons.' . $icon"
            />
        @endif

        {{ $label }}

    </a>

@else

    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => 'button button-' . $color]) }}
    >

        @if($icon)
            <x-dynamic-component
                :component="'icons.' . $icon"
            />
        @endif

        {{ $label }}

    </button>

@endif
