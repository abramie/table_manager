@extends('layouts.master')

@section('title', 'Modification de la table')

@section('content')
    <livewire:nouvelle-table :table="$table" :creneau="$creneau"/>
@endsection
