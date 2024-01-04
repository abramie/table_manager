@extends('base')

@section('title', 'Liste des tables')


@section('content')
    @if(true || admin)
        <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Edit </button></td>
        <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.delete",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Delete </button></td>
    @endif
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
            @if(!$table->tags->isEmpty())
                Tags :
                @foreach($table->tags as $tag )
                    <span class="badge bg-secondary">{{$tag->nom}}</span>
                @endforeach

            @endif

            @if(!$table->triggerwarnings->isEmpty())
                TW :
                @foreach($table->triggerwarnings as $tw )
                    <span class="badge bg-secondary">{{$tw->nom}}</span>
                @endforeach

            @endif

        </evenement>

        <p>
            <button class="btn btn-xs btn-link" onclick="window.location='{{route('events.one.creneau.table.show', ['evenement' => $evenement->slug, 'creneau' => $creneau, 'table' => $table])}}'"  >Voir la table</button>
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
