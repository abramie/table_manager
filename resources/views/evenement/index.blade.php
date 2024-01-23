@extends('layouts.master')

@section('title', 'Index des evenements')


@section('content')
    <h1>Index event</h1>
    @can('ajout_events')
        <button class="btn btn-xs btn-warning pull-right" type="button"
                onclick="window.location='{{ route("events.add") }}'">
            Ajout
        </button>
    @endcan
    @foreach($evenements as $evenement)
        @php
            $creneaux_count = $evenement->creneaus()->count();
            $today = now();
            $date_affichage = $evenement->affichage_evenement;

            $affiche = $date_affichage->isPast();

        @endphp
        @if( ($affiche && $creneaux_count>0) || auth()->user()?->can('ajout_events'))

            <div class="container">
                <h2>@if(!$affiche)
                        Previsionnel
                    @endif{{$evenement->nom_evenement}}</h2>

                @can('ajout_events')
                    <button class="btn btn-xs btn-danger pull-right" type="button"
                            onclick="window.location='{{ route("events.one.delete",['evenement'=> $evenement]) }}'">
                        Delete
                    </button>
                    <button class="btn btn-xs btn-warning pull-right" type="button"
                            onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
                        Edit
                    </button>
                    {{--https://getbootstrap.com/docs/4.2/components/dropdowns/  Pour les boutons, voir split button --}}
                @endcan
                @php
                    $date = $evenement->date_debut;

                @endphp

                <h3>{{$evenement->showDate()}} à partir de {{$date->hour}}h</h3>
                @if($evenement->image)
                    <img src="{{asset("storage/images/".$evenement->image?->title)}}" alt="description" width="300"
                         height="250" class="img-thumbnail rounded float-left"/>
                @endif
                <p>
                    @if(strlen($evenement->description) < 100)
                        {{$evenement->description}}
                    @else
                        {{substr($evenement->description, 0,100) . "..." }}
                    @endif
                </p>
                <p>
                    @if($creneaux_count == 1)
                        <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement->slug, 'creneau' =>$evenement->creneaus->first()])}}">Liste
                            des tables</a>
                    @else
                        <a href="{{route('events.one.show', ['evenement' => $evenement->slug])}}">Liste des creneaux</a>

                    @endif

                </p>
            </div>
        @endif
    @endforeach

    {{ $evenements->links() }}
@endsection
