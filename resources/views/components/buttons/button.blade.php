@props([
    'color' => 'primary',
    'type' => null
])

@php
    $isLink = $attributes->has('href');
    $baseClass = 'btn btn-' . $color;
@endphp

@if ($isLink)
    <a {{ $attributes->merge(['class' => $baseClass]) }}>
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type ?? 'button' }}"
        {{ $attributes->merge(['class' => $baseClass]) }}
    >
        {{ $slot }}
    </button>
@endif