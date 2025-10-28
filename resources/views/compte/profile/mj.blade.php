@extends('compte.base')

@section('title', 'Options MJ')


@section('content-compte')
    <h1>Options MJ</h1>

    @role('mj')
    <form action="{{route('compte.toggle-mj', [$compte])}}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-danger" type="submit">Ne plus etre MJ</button>
            </div>
        </div>
    </form>

    @foreach($tables as $table)

        <x-table-preview :table="$table" :settings="$settings" showDate/>
    @endforeach


    @else
        <form action="{{route('compte.toggle-mj', [$compte])}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-success" type="submit">Devenir MJ</button>
                </div>
            </div>
        </form>
        @endrole
        @endsection
