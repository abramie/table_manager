@extends('layouts.master')

@section('title', 'Index des evenements')


@section('content')
    <h1>{{$evenement->nom_evenement}}</h1>
    @can('ajout_events')
        <button class="btn btn-xs btn-warning pull-right" type="button"
                onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
            Edit
        </button>
    @endcan
    <div class="d-flex">
        @if($evenement->image)
            <img src="{{asset("storage/images/".$evenement->image?->title)}}" alt="description" width="300" height="250"/>
        @endif
        <div class="ml-5">
            <h3>{{$evenement->showDate()}} {{$evenement->date_debut->year}}</h3>

            <p class="text-justify">
                {{$evenement->description}}
            </p>
        </div>
    </div>



    <table class="table">
        <thead>
        <tr >
            <th colspan="2" >Créneaux</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="col">Nom du créneau</th>
            <th scope="col">Début</th>
            <th scope="col">durée</th>
            <th scope="col">Nombre de tables</th>
            <th scope="col">Nombre de personnes inscrit.e.s</th>
            @can('ajout_events')
                <th></th>
                <th></th>
            @endcan
        </tr>
        @foreach($evenement->creneaus()->get() as $creneau)
            @php $date_creneau = $creneau->debut_creneau;
                $date = $evenement->date_debut;
                $date->setTimezone('UTC');
                $date_creneau->setTimezone('UTC');
                $showMinute = $date_creneau->minute >0 ? ($date_creneau->minute > 9 ?$date_creneau->minute  : '0' . $date_creneau->minute ) : '';
            @endphp
            <tr>
                <td>
                    <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement, 'creneau' => $creneau->id])}}"> {{$creneau->nom}} </a>
                </td>
                <td>@if(!$date_creneau->isSameDay($date))
                        Le {{$date_creneau->dayName}} {{$date_creneau->day}} à
                    @endif {{$date_creneau->hour}}h{{ $showMinute }}
                </td>
                <td>{{$creneau->duree}}h</td>
                <td class="text-center">{{$creneau->tables_normal->count()}}</td>
                <td class="text-center">{{$creneau->tables()->withCount('inscrits')->get()->sum('inscrits_count')}}</td>

                @can('ajout_events')
                    <td>
                        <button class="btn btn-xs btn-warning " type="button"
                                onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-danger " type="button"
                                onclick="window.location='{{ route("events.one.creneau.delete",['evenement'=> $evenement, 'creneau' => $creneau]) }}'">
                            Delete
                        </button>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

    @can('ajout_events')
        <p>
            <button class="btn btn-xs btn-info " type="button"
                    onclick="window.location='{{ route("events.one.add",['evenement'=> $evenement]) }}'">
                Ajout d'un creneau
            </button>
        </p>
    @endcan
@endsection
