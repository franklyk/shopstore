@props([
    'label' => 'Cadastrar',
    'color' => 'success',
    'icon' => 'plus',
    'type' => 'button',
    'modal' => 'modal-create',
])

<x-buttons.button
    :color="$color"
    :icon="$icon"
    :label="$label"
    :type="$type"
    form="form-create"
    {{ $attributes }}
/>
