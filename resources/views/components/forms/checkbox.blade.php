@props(['name', 'label'])

@php
    $defaults = [
        'type' => 'checkbox',
        'name' => $name,
        'id' => $name,
        'class' => 'form-check-input ',
    ];

@endphp

<div class="d-flex align-items-center gap-2">

    <input {{ $attributes->merge($defaults) }}>
    <x-forms.label :for="$name" :label="$label" />
    
</div>
