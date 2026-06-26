@extends('layouts.base')

@section('layout')

<div class="row">

    <x-layout.profile.header />

    <div class="col-md-3">
        {{-- @include('layouts.partials.sidebars.profile') --}}

    </div>

    <div class="col-md-9">
        @yield('profile')
    </div>

</div>

@endsection
