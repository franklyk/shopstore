    @props(['label' => null, 'name'])

    <div class="mb-3">
        
        @if ($label)
            <x-forms.label :for="$name" :label="$label" />
        @endif

        {{ $slot }}

        <x-forms.error :name="$name" />

    </div>