@extends('base')

@section('title', 'Index des evenements')


@section('content')
    <h1>Index event</h1>
    @foreach($evenements as $evenement)
        <evenement>
            <h2>{{$evenement->nom_evenement}}</h2>
        </evenement>

        <p>
            @if($evenement->creneaus()->count()> 1)
                <a href="{{route('events.one.show', ['evenement' => $evenement->slug])}}"  >Liste des creneaux</a>
            @else

                <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement->slug, 'creneau' =>$evenement->creneaus->first()])}}"  >Liste des tables</a>
            @endif
                @if(true)

                    <button class="btn btn-xs btn-info pull-right" type="button" onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
                        Edit </button>

                @endif

        </p>
    @endforeach

    {{ $evenements->links() }}
@endsection
