@props([
    'label' => 'Excluir',
    'color' => 'danger',
])

<x-buttons.button
    :color="$color"
    icon="trash"
    :label="$label"
    {{ $attributes }}
/>
