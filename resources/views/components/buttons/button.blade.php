@props([
    'color',
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

    $icon = $icons[$icon] ?? $icon;
@endphp

@if ($isLink)

    <a {{ $attributes->merge(['class' => 'd-flex gap-1 btn btn-sm btn-' . $color]) }}>

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
        {{ $attributes->merge(['class' => 'd-flex gap-1 btn btn-sm btn-' . $color]) }}
    >

        @if($icon)
            <x-dynamic-component
                :component="'icons.' . $icon"
            />
        @endif

        {{ $label }}

    </button>

@endif
