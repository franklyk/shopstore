@props([
    'label' => 'Cadastrar',
    'color' => 'success',
    'icon' => 'plus',
    'modal' => 'modal-create',
])

<x-buttons.button
    :color="$color"
    :icon="$icon"
    :label="$label"
    {{ $attributes }}
/>
