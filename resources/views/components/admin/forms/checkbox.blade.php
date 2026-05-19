@props(['label', 'name', 'value' => 1, 'checked' => false, 'id' => null])

<div class="form-check">

    <label class="form-check-label ms-3" for="{{ $id }}">

        <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
            class="form-check-input" @checked(old($name, $checked)) {{ $attributes }}>
        {{ $label }}

    </label>

</div>
