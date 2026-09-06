@extends('layouts.admin')

@section('layout-admin')
    <div class="page-container">
        {{ $header }}
        <div class="content-page">

            {{ $slot }}

        </div>
    </div>
@endsection
