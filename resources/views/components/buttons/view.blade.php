@props([
    'label' => 'Visualizar',
    'color' => 'info',
])

<x-buttons.button
    :color="$color"
    icon="eye"
    :label="$label"
    {{ $attributes }}
/>
