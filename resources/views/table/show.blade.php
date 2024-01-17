@extends('base')

@section('title', $table->nom)


@section('content')
    <h1>{{ $table->nom}}</h1>
    <p>
        <button class="btn btn-xs btn-info " type="button" onclick="window.location='{{ route("events.one.creneau.tablesindex",['evenement'=> $evenement,'creneau' =>$creneau]) }}'">
           Retour à la liste des tables </button>
    </p>
    <p>
        <button class="btn btn-xs btn-info pull-right" type="button" onclick="window.location='{{ route("events.one.creneau.table.edit",['evenement'=> $evenement,'creneau' =>$creneau, 'table'=>$table]) }}'">
            Edit </button>
    </p>
    <div>
        Horaires : {{$table->debut_table->toTimeString()}} -> {{$table->debut_table->addHour($table->duree)->toTimeString()}};
    </div>
    <div >
        <h2>Description de la table</h2>
        {{$table->description}}
    </div>

    <div>
        <span>Inscrits : {{$table->nb_inscrits()}}/{{$table->nb_joueur_max}}</span>
        <ul class="list-group list-group-flush">
        @foreach($table->users as $user)
            <li class="list-group-item">{{$user->name}}</li>
        @endforeach
        </ul>
    </div>
    @php
        $ouverture_inscription =$evenement->ouverture_inscription;
        $inscription_ouverte = $ouverture_inscription->isPast();
        $fermeture_inscription =$evenement->fermeture_inscription;
        $inscription_fermee = $fermeture_inscription->isPast();
    @endphp
    @include('table.bouton_inscription')
@endsection
