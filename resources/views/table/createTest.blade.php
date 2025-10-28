@extends('layouts.master')

@section('title', 'Ajouter une table')

@section('content')

    <livewire:nouvelle-table :table="$table" :creneau="$creneau"/>

    {{--<livewire:nouvelle-table :table="$table" :descriptions="$descriptions" :evenement="$evenement" :creneau="$creneau" :creneaux="$creneaux"
    :triggerwarnings="$triggerwarnings" :tags="$tags" :new_tag="$new_tag" :new_tw="$new_tw"/>--}}
@endsection
