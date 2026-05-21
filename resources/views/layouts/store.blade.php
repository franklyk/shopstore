@extends('layouts.base')

@section('layout')

    @include('layouts.partials.headers.header')

    <main class="container mt-4">

        @yield('content')

    </main>

@endsection