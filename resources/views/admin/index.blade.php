@extends('admin.base')

@section('title', 'Options administrateur')


@section('content-admin')

    <h1>Options admin</h1>

    <p><a href="{{route('events.add')}}">Ajout evenement</a></p>


@endsection
