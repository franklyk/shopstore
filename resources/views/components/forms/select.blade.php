@props(['name', 'label' => null, 'options' => [], 'selected' => null, 'placeholder' => 'Selecione'])

@php
    $selected = old($name, $selected);
@endphp
<div class="form-field">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-select mb-3']) }}>

        <option value="">
            {{ $placeholder }}
        </option>

        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected((string) $selected === (string) $value)>
                {{ $text }}
            </option>
        @endforeach

    </select>
</div>
