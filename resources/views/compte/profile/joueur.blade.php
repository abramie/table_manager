@extends('compte.base')

@section('title', 'Options joueur')


@section('content-compte')
    <h1>Options Joueur</h1>

    @foreach($tables as $table)

        <x-table-preview :table="$table" showDate/>
    @endforeach

@endsection
