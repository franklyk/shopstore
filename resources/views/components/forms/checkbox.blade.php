@props(['name', 'label'])

@php
    $defaults = [
        'type' => 'checkbox',
        'name' => $name,
        'id' => $name,
        'class' => 'form-check-input ',
    ];

@endphp

<div class="form-check">
    <input {{ $attributes->merge($defaults) }}>
    <label for="{{ $name }} ">{{ $label }}</label>
</div>

