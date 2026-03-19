@extends('layouts.master')

@section('title', 'Modifier un evenement')

@section('content')
    <livewire:evenement.form :evenement="$evenement" :settings="$settings" />
{{--    @include('evenement.form')--}}
@endsection
