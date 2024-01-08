@extends('admin.base')

@section('title', 'Liste des tables')


@section('content-admin')

    <h1>Options admin</h1>

    <p><a href="{{route('events.add')}}">Ajout evenement</a></p>


    <h1>Liste settings</h1>

    @foreach(\App\Models\Settings::get() as $setting)
       <div>
        {{$setting->name}}
        <input value="{{$setting->value}}">

        {{$setting->description}}
       </div>
    @endforeach
@endsection
