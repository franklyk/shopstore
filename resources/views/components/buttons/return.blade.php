@props([
    'label' => 'Voltar',
    'color' => 'secondary',
])

<x-buttons.button
    :color="$color"
    icon="return"
    :label="$label"
    {{ $attributes }}
/>
