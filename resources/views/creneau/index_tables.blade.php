@extends('layouts.master')

@section('title', 'Liste des tables')

@section('content')
    @can('ajout_events')
        <td>
            <button class="btn btn-xs btn-warning " type="button"
                    onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Edit
            </button>

        </td>
        <td>
            <button class="btn btn-xs btn-warning " type="button"
                    onclick="window.location='{{ route("events.one.creneau.delete",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                Delete
            </button>
        </td>
    @endcan


    @if($evenement->creneaus()->count()>1)
        <h1>{{$evenement->nom_evenement}} : {{$creneau->nom}}</h1>
        <p>
            <button class="btn btn-xs btn-info " type="button"
                    onclick="window.location='{{ route("events.one.show",['evenement'=> $evenement]) }}'">
                {{$evenement->nom_evenement}}</button>
        </p>
    @else
        <h1>{{$evenement->nom_evenement}} </h1>
    @endif

    @php
        $date_creneau = $creneau->debut_creneau;
        $date_creneau->setTimezone('UTC');
    $showMinute = $date_creneau->minute >0 ? ($date_creneau->minute > 9 ?$date_creneau->minute  : '0' . $date_creneau->minute ) : '';
    @endphp
    <div>
        Date : Le {{$date_creneau->dayName}} {{$date_creneau->day}} à
        {{$date_creneau->hour}}h{{ $showMinute }}

    </div>
    <div>
        Horaires : {{$creneau->debut_creneau->toTimeString('minute')}}
        -> {{$creneau->debut_creneau->addHour($creneau->duree)->toTimeString('minute')}}
    </div>
    {{--
        <ul class="list-group list-group-flush">
            @foreach($creneau->tables()->with('users')->get()->pluck('users')->flatten() as $user)
                <li class="list-group-item">{{$user->name}}</li>
            @endforeach
        </ul>
    --}}
    @php
        $nb_inscrit = $creneau->tables()->with('inscrits')->get()->pluck('inscrits')->flatten()->count();
        $max_place = $creneau->tables()->where('sans_table','=',0)->pluck('nb_joueur_max')->sum();
    @endphp
    <div>
        Nombre d'inscrit sur ce creneau : {{ $nb_inscrit}}
        Place restante : {{$max_place-$creneau->tables()->where('sans_table','=',0)->with('inscrits')->get()->pluck('inscrits')->flatten()->count()}}/{{$max_place}}
    </div>

    @foreach($tables as $table)
        <x-table-preview :table="$table" :settings="$settings"/>


    @endforeach

    @can('ajout_tables')
        <p>
            <button class="btn btn-lg btn-info pull-right" type="button"
                    onclick="window.location='{{ route("events.one.creneau.tables.add",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                ajout d'une table
            </button>

            <button class="btn btn-lg btn-info pull-right" type="button"
                    onclick="window.location='{{ route("events.one.creneau.tables.addTest",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                ajout d'une table Nouveau formulaire
            </button>
        </p>
    @endcan
    {{ $tables->links() }}
@endsection
