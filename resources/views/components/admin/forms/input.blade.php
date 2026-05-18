@props(['label' => null, 'name', 'type'])

@php
    $hasError = $errors->has($name);

    $defaults = [
        'autocomplete' => $name,
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'form-control ' . ($hasError ? 'is-invalid' : ''),
    ];
@endphp

<x-admin.forms.field :label="$label" :name="$name">
    <input {{ $attributes->merge($defaults) }}>
</x-admin.forms.field>