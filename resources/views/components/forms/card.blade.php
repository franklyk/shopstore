@props(['title' => null])

<div class="card d-flex justify-content-center align-items-center">

    <div class="w-100">
        <div class="border border-light rounded-2 py-3">
            <div class="text-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" style="max-width: 140px;">
                </a>
                <h4 class="mb-4 text-center">{{ $title }}</h4>
            </div>


            {{ $slot }}

        </div>

    </div>

</div>
