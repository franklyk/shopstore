@props(['label' => null, 'name'])

@php
    $hasError = $errors->has($name);

    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'form-input' . ($hasError ? 'is-invalid' : ''),
    ];
@endphp

<x-forms.field :label="$label" :name="$name">
    <input {{ $attributes->merge($defaults) }}>
</x-forms.field>
