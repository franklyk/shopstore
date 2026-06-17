@props(['label' => null, 'name', 'type'])

@php


    $defaults = [
        'autocomplete' => $name,
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'form-input',
    ];
@endphp

<x-admin.forms.field :label="$label" :name="$name">
    <input {{ $attributes->merge($defaults) }}>
</x-admin.forms.field>
