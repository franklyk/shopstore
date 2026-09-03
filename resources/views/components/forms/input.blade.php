@props(['label' => null, 'name', 'type' => null])

@php

    $hasError = $errors->has($name);

    $defaults = [

        'placeholder' => '',

        'type' => $type,

        'id' => $name,

        'name' => $name,

        'value' => old($name),

        'class' => 'form-control' . ($hasError ? ' is-invalid' : ''),

    ];

@endphp

<div class="form-field mb-3">

    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif

    <input {{ $attributes->merge($defaults) }}>

</div>
