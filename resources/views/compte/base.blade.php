@extends('layouts.master')


@section('navigation_bonus')
    @php
        $authCompte = Auth::user();
        $currentProfile = $authCompte?->currentProfile;
    @endphp
    <ul class="navbar-nav navbar-inner col">
    <x-navigation-item routeName="compte.edit" contain="compte" :parameter="['compte' => $authCompte]" >Edit</x-navigation-item>
    @role('joueur')
        <x-navigation-item routeName="profile.show" :parameter="[$authCompte]"  >Profiles</x-navigation-item>
    @endrole
    @if($compte->hasProfile())
        <x-navigation-item routeName="profile.mj" :parameter="['compte' => $authCompte, 'profile' => $currentProfile]"  >MJ</x-navigation-item>
    @endif
    </ul>

@endsection

@section('content')




    @yield('content-compte')

@endsection
