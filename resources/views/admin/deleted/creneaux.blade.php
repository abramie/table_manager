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
        <th scope="col">Nom creneau</th>
        <th scope="col">Début</th>
        <th scope="col">durée</th>
        <th scope="col">Nombre de tables</th>
    </tr>
    @foreach($creneaux as $creneau)
        @php $date_creneau = $creneau->debut_creneau;
                $date_creneau->setTimezone('UTC');
        @endphp
        <tr>
            <td>
                <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $creneau->evenement, 'creneau' => $creneau])}}"> {{$creneau->nom}} </a>
            </td>
            <td>
                    Le {{$date_creneau->dayName}} {{$date_creneau->day}} à
                 {{$date_creneau->hour}}h
            </td>
            <td>{{$creneau->duree}}h</td>
            <td>{{$creneau->tables->count()}}</td>

            @can('ajout_events')
                <td>
                    <button class="btn btn-xs btn-warning " type="button"
                            onclick="window.location='{{ route("events.one.creneau.edit",['evenement'=> $creneau->evenement, 'creneau' => $creneau]) }}'">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-xs btn-warning " type="button"
                            onclick="window.location='{{ route("admin.deleted.restore",['type'=> "Creneau",  'id'=> $creneau->id ]) }}'">
                        Restore
                    </button>
                </td>
                <td>
                    <button class="btn btn-xs btn-warning " type="button"
                            onclick="window.location='{{ route("admin.deleted.delete",['type'=> "Creneau",  'id'=> $creneau->id ]) }}'">
                        Delete
                    </button>
                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>
{{ $creneaux->links() }}

@endsection
