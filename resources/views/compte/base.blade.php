@extends('layouts.master')
@section('navigation_bonus')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{route("compte.edit",$compte)}}">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("profile.show", $compte)}}">Profiles</a>
                </li>

                @if($compte->hasProfile())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("profile.mj",["compte" => $compte, "profile" => $compte->currentProfile])}}">MJ</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endsection

@section('content')




    @yield('content-compte')

@endsection
