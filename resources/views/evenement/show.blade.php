@extends('base')

@section('title', 'Index des evenements')


@section('content')
    <h1>{{$evenement->nom_evenement}}</h1>
    <button class="btn btn-xs btn-warning pull-right" type="button" onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
        Edit </button>
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
                <td><a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau->id])}}"> {{$creneau->nom}} </a></td>
                <td>{{$creneau->duree}}</td>

                @if(true || admin)
                    <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                            Edit </button></td>
                    <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.delete",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                            Delete </button></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(true)
        <p>
            <button class="btn btn-xs btn-info " type="button" onclick="window.location='{{ route("events.one.add",['evenement'=> $evenement]) }}'">
                ajout d'un creneau </button>
        </p>
    @endif
@endsection
