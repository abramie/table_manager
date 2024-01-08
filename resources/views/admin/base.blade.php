
@extends('base')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("admin.index" )}}">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("admin.users")}}">Utilisateurs</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container">
    @yield('content-admin')

</div>

@endsection
