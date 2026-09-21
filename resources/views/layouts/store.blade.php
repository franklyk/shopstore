@extends('layouts.base')

@section('view-port')
    <x-layout.store.header />

    <main class="container mt-4">
        <x-feedback.flesh/>

        @yield('store')

    </main>
@endsection
