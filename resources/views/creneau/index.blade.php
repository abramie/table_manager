@extends('base')

@section('title', 'Liste des tables')


@section('content')

    <h1>Index tables</h1>

    @if($evenement->creneaus()->count()>1)
        <p>
            <button class="btn btn-xs btn-info " type="button" onclick="window.location='{{ route("events.one.show",['evenement'=> $evenement]) }}'">
                {{$evenement->nom_evenement}}</button>
        </p>
    @endif

    @foreach($tables as $table)
        <evenement>
            <h2>{{$table->nom}}</h2>
        </evenement>

        <p>
            <a href="{{route('events.one.creneau.table.show', ['evenement' => $evenement->slug, 'creneau' => $creneau, 'table' => $table])}}"  >{{$table->nom}}</a>
        </p>
    @endforeach
    @if(true)
        <p>
            <button class="btn btn-xs btn-info " type="button" onclick="window.location='{{ route("events.one.creneau.tables.add",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                ajout d'une table </button>
        </p>
    @endif
    {{ $tables->links() }}
@endsection
