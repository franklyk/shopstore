@extends('layouts.store')

@section('content')

<div class="row">

    <div class="col-md-3">
        @include('layouts.partials.sidebars.profile')
        
    </div>

    <div class="col-md-9">
        @yield('profile')
    </div>

</div>

@endsection