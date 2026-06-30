@props(['label' => null, 'name', 'type' => null])

@php
    $hasError = $errors->has($name);

    $defaults = [
        'placeholder' => '',
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'form-control' . ($hasError ? 'is-invalid' : ''),
    ];
@endphp

<div class="form-floating mb-3">
    <input {{ $attributes->merge($defaults) }}>
    <label for="{{ $name }}">{{ $label }} </label>
</div>
