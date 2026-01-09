@extends('layouts.master')

@section('title', $table->nom)

@php
    $isSansTable = $table->sans_table == 1;
@endphp
@section('content')
    <h1>{{ $table->nom}}</h1>
    <p>
        <button class="btn btn-xs btn-info " type="button"
                onclick="window.location='{{ route("events.one.creneau.tablesindex",['evenement'=> $evenement,'creneau' =>$creneau]) }}'">
            Retour à la liste des tables
        </button>
    </p>
    @if(!$isSansTable)
        <h5 class="card-subtitle mb-2 text-body-secondary">MJ : {{$table->mjs->name}}

        </h5>
        @if(!$table->tags->isEmpty())
            <p>
            Tags :
            @foreach($table->tags as $tag )
                <span class="{{\App\Models\types\TypeTag::findCode('BASE')->bs_class}}">{{$tag->nom}}</span>
            @endforeach
            </p>
        @endif

        @if(!$table->triggerwarnings->isEmpty())
            <p>
          {{$settings->firstWhere('name','nom_trigger')->value}} :
            @foreach($table->triggerwarnings as $tw )
                <span class="{{\App\Models\types\TypeTag::findCode('TW')->bs_class}}">{{$tw->nom}}</span>
            @endforeach
            </p>
        @endif
    @endif
    <p>

        @if(auth()->user() && (auth()->user()?->can('manage_tables_all') ||(auth()->user()?->can('manage_tables_own')&&  $table->mjs->name ==auth()->user()->name) ))
            <button class="btn btn-xs btn-info pull-right" type="button"
                    onclick="window.location='{{ route("events.one.creneau.table.edit",['evenement'=> $evenement,'creneau' =>$creneau, 'table'=>$table]) }}'">
                Edit
            </button>
            <button class="btn btn-xs btn-danger pull-right" type="button"
                    onclick="window.location='{{ route("events.one.creneau.table.delete",['evenement'=> $evenement,'creneau' =>$creneau, 'table'=>$table]) }}'">
                Supprimer
            </button>
        @endif
    </p>
    <div>
        Horaires : {{$table->debut_table->toTimeString($unitPrecision ='minute')}}
        -> {{$table->debut_table->addHour($table->duree)->toTimeString($unitPrecision ='minute')}};
    </div>
    <div>
        <h2>Description de la table</h2>
        {{$table->description}}
    </div>
    @if($table->jeu)
        <div>
            <h2>Le jeu : {{$table->jeu->nom}}</h2>
            {{$table->jeu->description}}
        </div>
    @endif

    <div>
        <span>Inscrits : {{$table->nb_inscrits()}} @if(!$isSansTable)
                / {{$table->nb_joueur_max}}
            @endif</span>

        <ul class="list-group list-group-flush">
            @foreach($table->inscriptions as $inscrit)
                <li class="list-group-item {{$inscrit->type_inscription->bs_class}}">{{$inscrit->profile->name}}</li>
            @endforeach
        </ul>
    </div>
    <span>Nombre de pré-inscriptions possible : {{$table->max_preinscription}}</span>

    @php
        $ouverture_inscription =$evenement->ouverture_inscription;
        $inscription_ouverte = $ouverture_inscription->isPast();
        $fermeture_inscription =$evenement->fermeture_inscription;
        $inscription_fermee = $fermeture_inscription->isPast();
    @endphp
    <x-bouton_inscription :table="$table"/>
@endsection
