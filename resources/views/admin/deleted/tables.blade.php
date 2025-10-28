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
        @foreach($tables as $table)

            <tr>
                <td>
                    <a href="{{route('events.one.creneau.table.show', ['evenement' => $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table' => $table])}}"> {{$table->nom}} </a>
                </td>

                @can('ajout_events')
                    <td>
                        <button class="btn btn-xs btn-info pull-right" type="button"
                                onclick="window.location='{{ route("events.one.creneau.table.edit",['evenement' => $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table' => $table]) }}'">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-warning " type="button"
                                onclick="window.location='{{ route("admin.deleted.restore",['type'=> "Table",  'id'=> $table->id ]) }}'">
                            Restore
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-warning " type="button"
                                onclick="window.location='{{ route("admin.deleted.delete",['type'=> "Table",  'id'=> $table->id ]) }}'">
                            Delete
                        </button>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $tables->links() }}

@endsection
