@extends('layouts.base')

@section('layout')
    <x-layout.store.header />

    <main class="container mt-4">

        @yield('store')

    </main>
@endsection
