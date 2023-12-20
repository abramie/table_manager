@extends('base')

@section('title', 'Index des evenements')


@section('content')
    <h1>Index event</h1>

    @foreach($evenements as $evenement)
        <evenement>
            <h2>{{$evenement->nom_evenement}}</h2>
        </evenement>

        <p>
            <a href="{{route('events.one.show', ['evenement' => $evenement->slug])}}"  >evenement</a>
        </p>
    @endforeach

    {{ $evenements->links() }}
@endsection
