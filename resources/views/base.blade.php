<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- Optional theme -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route("events.index") }}">Retour à l'accueil</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">


            <x-navigation-item routeName="events.index" >Index event</x-navigation-item>
            {{--
            <li class="nav-item">
                <a class="nav-link {{ Str::contains(url()->current(), 'som') ? 'active' : '' }}"  href="{{route("events.one.show", ['evenement'=> \App\Models\Evenement::all()->where('slug','=', "som-24")[1]])}}">Som-24</a>
            </li>
            --}}
            @role('admin')
            <x-navigation-item routeName="admin.index" contain="admin" >Admin</x-navigation-item>
            @endrole
        </ul>
    </div>
    <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth()
       <a href="{{route("profile.edit")}}"> {{\Illuminate\Support\Facades\Auth::user()->name}}</a>

            <form action="{{route('logout')}}" method="post">

                @csrf
                <button class="nav-link">Se deconnecter</button>
            </form>
        @endauth
        @guest()
                <a href="{{route('register')}}">Créer son compte </a>
                <a href="{{route('login')}}">Se connecter </a>
        @endguest


    </div>

</nav>
<a  href="{{ url()->previous() }}">
    <i class="fa fa-arrow-circle-o-left"></i>
    <span>Back</span>
</a>

<body>

<div class="container">
    @if(session('success'))
        <div class=".alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('echec'))
        <div class=".alert alert-danger">
            {{ session('echec') }}
        </div>

    @endif
</div>

<div class="container">
    @yield('content')

</div>

</body>

<footer>
    <div>Si vous rencontrez un bug, ou que vous avez une idée d'amelioration rendez vous sur :
    <a  class="link-danger" href="https://github.com/abramie/table_manager/issues">La page github, pour ajouter un ticket</a>
    </div>
    <div>
        Il s'agit d'une version alpha, il est possible (et probable) que vous rencontriez des bugs, des erreurs, ou que des trucs soit juste mal foutu.
        Pensez à signaler les choses, et j'essaierais de mettre à jour au plus vite.
    </div>

</footer>
