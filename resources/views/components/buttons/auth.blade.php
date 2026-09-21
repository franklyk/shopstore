@props([
    'label' => 'Enviar',
    'color' => 'primary',
    'icon' => 'check',
    'type' => 'submit',
])

<x-buttons.button
    color="{{ $color }}"
    icon="{{ $icon }}"
    label="{{ $label }}"
    type="{{ $type }}"
    {{ $attributes }}
/>
