@extends('layouts.master')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{route("profile.edit")}}">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("profile.mj")}}">MJ</a>
                </li>
            </ul>
        </div>
    </nav>



    @yield('content-profile')

@endsection
