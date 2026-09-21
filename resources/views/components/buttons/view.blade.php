@props([
    'label' => 'Visualizar',
    'color' => 'info',
    'icon' => 'eye',
    'type' => 'button'
])

<x-buttons.button
    :color="$color"
    :icon="$icon"
    :label="$label"
    :type="$type"
    {{ $attributes }}
/>

