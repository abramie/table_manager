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
        <x-event-preview :evenement="$evenement" />
    @endforeach

    {{ $evenements->links() }}
@endsection
