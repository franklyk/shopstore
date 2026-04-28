@props(['route', 'title'])


<x-forms.card :title="$title">

    <form action="{{ route($route) }}"
        {{ $attributes->merge(['class' => 'needs-validation p-3']) }}>

        @if (strtoupper($attributes->get('method', 'GET')) !== 'GET')
            @csrf
            @method($attributes->get('method'))
        @endif

        {{ $slot }}

    </form>
</x-forms.card>
