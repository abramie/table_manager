
@extends('base')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <x-navigation-item routeName="admin.index" >Options admins</x-navigation-item>
                <x-navigation-item routeName="admin.users" >Utilisateurs</x-navigation-item>
                <x-navigation-item routeName="admin.settings" >Settings</x-navigation-item>
                <x-navigation-item routeName="admin.deleted" contain="deleted">Gestion des elements supprimés</x-navigation-item>

            </ul>
        </div>
    </nav>

<div class="container">
    @yield('content-admin')

</div>

@endsection
