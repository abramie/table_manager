@extends('base')

@section('title', 'Liste des tables')


@section('content')
    @can('ajout_events')
        <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Edit </button></td>
        <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.delete",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Delete </button></td>
    @endcan
    <h1>Index tables</h1>

    @if($evenement->creneaus()->count()>1)
        <p>
            <button class="btn btn-xs btn-info " type="button" onclick="window.location='{{ route("events.one.show",['evenement'=> $evenement]) }}'">
                {{$evenement->nom_evenement}}</button>
        </p>
    @endif

    @foreach($tables as $table)
        <evenement>
            <h2><a href="{{route('events.one.creneau.table.show', ['evenement' => $evenement->slug, 'creneau' => $creneau, 'table' => $table])}}">{{$table->nom}}</a></h2>

            <span>MJ : {{$table->mjs->name}}</span>
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
            <span>Inscrits : {{$table->nb_inscrits()}}/{{$table->nb_joueur_max}}</span>

        </evenement>
        <p>
            @if(strlen($table->description) < 1000)
                {{$table->description}}
            @else
                {{substr($table->description, 0,1000) . "..." }}
            @endif
        </p>
        @if($table->users->contains(Auth::user()))
            <form action="{{route('events.one.creneau.table.desinscription',['evenement'=> $evenement, 'creneau' => $creneau, 'table'=> $table ])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-danger" type="submit">Desinscription</button>
                    </div>
                </div>
            </form>
        @else
            <form action="{{route('events.one.creneau.table.inscription',['evenement'=> $evenement, 'creneau' => $creneau, 'table'=> $table ])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-light" type="submit">Inscription à la table</button>
                    </div>
                </div>
            </form>
        @endif


    @endforeach
    @can('ajout_tables')
        <p>
            <button class="btn btn-xs btn-info pull-right" type="button" onclick="window.location='{{ route("events.one.creneau.tables.add",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                ajout d'une table </button>
        </p>
    @endcan
    {{ $tables->links() }}
@endsection
