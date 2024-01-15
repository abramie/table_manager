
@extends('base')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::currentRouteNamed('admin.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route("admin.index" )}}">Settings</a>
                </li>
                <li class="nav-item {{ Route::currentRouteNamed('admin.users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route("admin.users")}}">Utilisateurs</a>
                </li>
                <li class="nav-item {{ Route::currentRouteNamed('admin.settings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route("admin.settings")}}">Settings</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container">
    @yield('content-admin')

</div>

@endsection
