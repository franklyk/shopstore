@props(['label' => null, 'name'])

<div class="form-field">

    @if ($label)
        <x-forms.label :for="$name" :label="$label" />
    @endif

    {{ $slot }}

</div>
