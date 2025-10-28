@extends('layouts.master')

@section('navigation_bonus')
    @include('admin.nav_admin')
@endsection



@section('content')
    @yield('content-admin')
@endsection

