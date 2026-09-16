@props([

    'label' => 'Editar',
    'color' => 'warning',
    'type' => 'button',

])

<x-buttons.button
    color="{{ $color }}"
    icon="edit"
    label="{{ $label }}"
    type="{{ $type }}"
    form="form-edit"
    {{ $attributes }}
/>
