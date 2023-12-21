@extends('base')

@section('title', 'Index des evenements')


@section('content')
    <h1>{{$evenement->nom_evenement}}</h1>
    <table class="table">
        <thead>
        <tr>
            <th colspan="2">The table header</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="col">Nom creneau</th>
            <th scope="col">durée</th>
        </tr>
        @foreach($evenement->creneaus()->get() as $creneau)
            <tr>
                <td><a href="{{route('events.one.tablesindex', ['evenement' => $evenement->slug, 'creneau' => $creneau->id])}}"> {{$creneau->nom}} </a></td>
                <td>{{$creneau->duree}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
