@props([
    'type' => null,
    'message' => null,
])

@php

    $alerts = [
        'success' => 'success',
        'error' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
    ];

@endphp

@if($message && isset($alerts[$type]))

    <div class="alert alert-{{ $alerts[$type] }} mb-3">
        {{ $message }}
    </div>

@endif

@if($errors->any())

    <div class="alert alert-danger mb-3">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

@foreach($alerts as $key => $class)

    @if(session($key))

        <div class="alert alert-{{ $class }} mb-3">
            {{ session($key) }}
        </div>

    @endif

@endforeach
