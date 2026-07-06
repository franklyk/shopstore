@props([
    'name',
    'label' => null,
    'options' => [],
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'selected' => null,
    'placeholder' => 'Selecione',
])

@php
    use Illuminate\Support\Collection;

    if ($options instanceof Collection) {
        $options = $options
            ->pluck($optionLabel, $optionValue)
            ->toArray();
    }

    $selected = old($name, $selected);
@endphp

@if($label)
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>
@endif

<select
    id="{{ $name }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'form-select mb-3']) }}
>

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach($options as $value => $text)

        <option
            value="{{ $value }}"
            @selected((string) $selected === (string) $value)
        >
            {{ $text }}
        </option>

    @endforeach

</select>

@error($name)
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
@enderror
