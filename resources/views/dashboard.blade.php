@extends('layouts.master')

@section('title', "dashboard")


@section('content')

    Page de dashboard :)
    @auth()
        Tu es bien connecter !
    @endauth
    @guest()
        Pas connecter :(
    @endguest

@endsection
