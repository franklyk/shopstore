@props([
    'label',
    'value' => null,
])

<dt class="col-sm-3">
    {{ $label }}
</dt>

<dd class="col-sm-9">

    {{ $value ?? $slot }}

</dd>