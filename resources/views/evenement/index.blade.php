@extends('layouts.master')

@section('title', 'Index des evenements')


@section('content')

    <h1>Événements à venir
        @can('ajout_events')
            <button class="btn btn-xs btn-warning pull-right" type="button"
                    onclick="window.location='{{ route("events.add") }}'">
                Ajout
            </button>
        @endcan
    </h1>

    @foreach($evenements as $evenement)
        <x-event-preview :evenement="$evenement" />
    @endforeach
    @if($evenements->isEmpty())
        <h2>Pas d'événements ouvert pour l'instant.</h2>
    @endif

    {{ $evenements->links() }}
@endsection
