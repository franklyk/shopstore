@props([
    'label' => 'Editar',
    'color' => 'warning',
])

<x-buttons.button
    :color="$color"
    icon="edit"
    :label="$label"
    {{ $attributes }}
/>
