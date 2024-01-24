
@extends('profile.base')

@section('title', 'Options MJ')


@section('content-profile')
    <h1>Options MJ</h1>

    @role('mj')
        <form action="{{route('profile.toggle-mj')}}" method="post">
        @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-danger" type="submit">Ne plus etre MJ</button>
                </div>
            </div>
        </form>

        @foreach($tables as $table)

            <x-table-preview :table="$table" showDate/>
        @endforeach


    @else
        <form action="{{route('profile.toggle-mj')}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-success" type="submit">Devenir MJ</button>
                </div>
            </div>
        </form>
    @endrole
@endsection
