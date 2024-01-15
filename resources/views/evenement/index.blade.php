@extends('base')

@section('title', 'Index des evenements')


@section('content')
    <h1>Index event</h1>
    @can('ajout_events')
        <button class="btn btn-xs btn-warning pull-right" type="button" onclick="window.location='{{ route("events.add") }}'">
            Ajout </button>
    @endcan
    @foreach($evenements as $evenement)
        @php
            $creneaux_count = $evenement->creneaus()->count()
        @endphp
        @if( $creneaux_count>0 || auth()->user()->can('ajout_events'))
            <evenement>
                <h2>{{$evenement->nom_evenement}}</h2>
            </evenement>
            @php
                $date = $evenement->date_debut;

             @endphp

            <h3>Le {{$date->dayName}} {{$date->day}} {{ $date->monthName }} @if($date->year != now()->year)
                    {{$date->year}}
                @endif à partir de {{$date->hour}}h</h3>
            <p>
                @if($creneaux_count == 1)
                    <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement->slug, 'creneau' =>$evenement->creneaus->first()])}}"  >Liste des tables</a>
                @else
                    <a href="{{route('events.one.show', ['evenement' => $evenement->slug])}}"  >Liste des creneaux</a>

                @endif
                    @can('ajout_events')

                        <button class="btn btn-xs btn-warning pull-right" type="button" onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
                            Edit </button>

                    @endcan

            </p>
        @endif
    @endforeach

    {{ $evenements->links() }}
@endsection
