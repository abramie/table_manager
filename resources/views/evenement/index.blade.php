@extends('base')

@section('title', 'Index des evenements')


@section('content')
    <h1>Index event</h1>
    @foreach($evenements as $evenement)
        @php
            $creneaux_count = $evenement->creneaus()->count()
        @endphp
        @if( $creneaux_count>0 || (true || admin))
            <evenement>
                <h2>{{$evenement->nom_evenement}}</h2>
            </evenement>

            <p>
                @if($creneaux_count == 1)
                    <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement->slug, 'creneau' =>$evenement->creneaus->first()])}}"  >Liste des tables</a>
                @else
                    <a href="{{route('events.one.show', ['evenement' => $evenement->slug])}}"  >Liste des creneaux</a>

                @endif
                    @if(true || admin)

                        <button class="btn btn-xs btn-warning pull-right" type="button" onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
                            Edit </button>

                    @endif

            </p>
        @endif
    @endforeach

    {{ $evenements->links() }}
@endsection
