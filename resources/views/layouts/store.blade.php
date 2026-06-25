@extends('layouts.base')

@section('layout')
    <x-layout.header />

    <main class="container mt-4">

        @yield('store')

    </main>
@endsection
