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

            @can('ajout_tags')
                <x-navigation-item routeName="tags.add" contain="admin" >Ajout Tag</x-navigation-item>
            @endcan
            @can('ajout_tws')
                <x-navigation-item routeName="tw.add" contain="admin" >Ajout TW</x-navigation-item>
            @endcan
        </ul>
    </div>
    <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth()
            <a href="{{route("profile.edit")}}"> {{\Illuminate\Support\Facades\Auth::user()->name}}</a>

            <form action="{{route('logout')}}" method="post">

                @csrf
                <button class="nav-link"> Se deconnecter</button>
            </form>
        @endauth
        @guest()
            <a href="{{route('register')}}">Créer son compte </a>

            <a href="{{route('login')}}"> Se connecter </a>
        @endguest


    </div>

</nav>
