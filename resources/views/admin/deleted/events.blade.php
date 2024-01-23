@extends('admin.base')

@section('title', 'Deleted events')

@section('content-admin')
@include('admin.deleted.nav')




<table class="table">
    <thead>
    <tr>
        <th colspan="2">The table header</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="col">Nom evenement</th>
        <th scope="col">Date</th>
        <th scope="col">Nombre de creneaux</th>
    </tr>

@foreach($evenements as $evenement)
    @php
        $date = $evenement->date_debut;
        $date->setTimezone('UTC');
    @endphp
        <tr>
            <td>
                <a href="{{route('events.one.show', ['evenement' => $evenement])}}"> {{$evenement->nom_evenement}} </a>
            </td>
            <td>
                    Le {{$date->dayName}} {{$date->day}} à
                {{$date->hour}}h
            </td>
            <td>{{$evenement->creneaus->count()}}</td>

            @can('ajout_events')
                <td>
                    <button class="btn btn-xs btn-warning " type="button"
                            onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-xs btn-warning " type="button"
                            onclick="window.location='{{ route("admin.deleted.restore",['type'=> "Evenement",  'id'=> $evenement->id ]) }}'">
                        Restore
                    </button>
                </td>
                <td>
                    <button class="btn btn-xs btn-danger " type="button"
                            onclick="window.location='{{ route("admin.deleted.delete",['type'=> "Evenement",  'id'=> $evenement->id ]) }}'">
                        Delete
                    </button>
                </td>
            @endcan
        </tr>


@endforeach

    </tbody>
</table>
{{ $evenements->links() }}
@endsection
