@extends('base')

@section('title', 'Liste des tables')

@section('content')
    @can('ajout_events')
        <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Edit </button></td>
        <td><button class="btn btn-xs btn-warning " type="button" onclick="window.location='{{ route("events.one.creneau.delete",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Delete </button></td>
    @endcan
    <h1>{{$evenement->nom_evenement}} : {{$creneau->nom}}</h1>

    @if($evenement->creneaus()->count()>1)
        <p>
            <button class="btn btn-xs btn-info " type="button" onclick="window.location='{{ route("events.one.show",['evenement'=> $evenement]) }}'">
                {{$evenement->nom_evenement}}</button>
        </p>
    @endif
    <div>
        Date : {{$evenement->showDate()}}

    </div>
    <div>
        Horaires : {{$creneau->debut_creneau->toTimeString()}} -> {{$creneau->debut_creneau->addHour($creneau->duree)->toTimeString()}};
    </div>

    <ul class="list-group list-group-flush">
        @foreach($creneau->tables()->with('users')->get()->pluck('users')->flatten() as $user)
            <li class="list-group-item">{{$user->name}}</li>
        @endforeach
    </ul>

    @php
        $ouverture_inscription =$evenement->ouverture_inscription;
        $inscription_ouverte = $ouverture_inscription->isPast();
        $fermeture_inscription =$evenement->fermeture_inscription;
        $inscription_fermee = $fermeture_inscription->isPast();
    @endphp
    @foreach($tables as $table)
        @php
            $isSansTable = $table->sans_table == 1;
         @endphp
        <evenement>
            <h2><a href="{{route('events.one.creneau.table.show', ['evenement' => $evenement->slug, 'creneau' => $creneau, 'table' => $table])}}">{{$table->nom}}</a></h2>
            @if(!$isSansTable)
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
            @endif
            <span>Inscrits : {{$table->nb_inscrits()}} @if(!$isSansTable)/ {{$table->nb_joueur_max}}@endif</span>

        </evenement>
        <p>
            @if(strlen($table->description) < 1000)
                {{$table->description}}
            @else
                {{substr($table->description, 0,1000) . "..." }}
            @endif
        </p>
        @include('table.bouton_inscription')


    @endforeach

    @can('ajout_tables')
        <p>
            <button class="btn btn-xs btn-info pull-right" type="button" onclick="window.location='{{ route("events.one.creneau.tables.add",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                ajout d'une table </button>
        </p>
    @endcan
    {{ $tables->links() }}
@endsection
