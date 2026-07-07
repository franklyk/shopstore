@props(['label' => null, 'name' => null])

<div class="form-field">

    {{ $slot }}

    @if ($label)
        <x-forms.label :for="$name" :label="$label" />
    @endif

    <x-forms.error :name="$name" />

</div>
