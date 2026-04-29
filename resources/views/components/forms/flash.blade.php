@php
    $types = [
        'success' => 'alert-success',
        'error' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
    ];
@endphp

@foreach ($types as $key => $class)
    @if (session($key))
    <div class="w-100 px-3">
        <div class="alert {{ $class }} alert-dismissible fade show" role="alert">

            {{ session($key) }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
        
    @endif
@endforeach