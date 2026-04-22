<form {{ $attributes->merge(['class' => 'needs-validation']) }}>
    
    @if (strtoupper($attributes->get('method', 'GET')) !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif

    {{ $slot }}

</form>