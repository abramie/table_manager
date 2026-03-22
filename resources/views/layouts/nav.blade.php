<nav class="navbar navbar-expand-lg nav">
    @php
        $authCompte = Auth::user();
        $currentProfile = $authCompte?->currentProfile;
    @endphp

    <div class="container-fluid ">
        <a class="navbar-brand" href="{{ route("events.index") }}">Retour à l'accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarIdContent" aria-controls="navbarIdContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarIdContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 col">


                <x-navigation-item routeName="events.index" >Index event</x-navigation-item>

                <x-navigation-item routeName="tutoriel" >Tutoriel d'inscription</x-navigation-item>
                {{--
                <li class="nav-item">
                    <a class="nav-link {{ Str::contains(url()->current(), 'som') ? 'active' : '' }}"  href="{{route("events.one.show", ['evenement'=> \App\Models\Evenement::all()->where('slug','=', "som-24")[1]])}}">Som-24</a>
                </li>
                --}}
                @role('admin')
                    <x-navigation-item routeName="admin.index" contain="admin" >Admin</x-navigation-item>
                @endrole

                @can('ajout_tags')
                <x-navigation-item routeName="tags.index" contain="tags" >Tags</x-navigation-item>
                @endcan

                @role('joueur')
                    <x-navigation-item routeName="profile.show" :parameter="[$authCompte]" contain="joueur" >Profiles</x-navigation-item>
                @endrole

                @role('mj')
                    <x-navigation-item routeName="profile.mj" :parameter="['compte' => $authCompte, 'profile' => $currentProfile]" contain="mj" >MJ</x-navigation-item>
                @endrole
            </ul>
            <div class="col-md-auto">
                @auth()
                    <div class="nav-item">
                        <a href="{{route("compte.edit", $authCompte)}}" class="nav-user-name"> {{ $currentProfile ? $currentProfile->name : "Compte"}}</a>
                    </div>
                    <div class="nav-item">
                    <form action="{{route('logout')}}" method="post">

                        @csrf
                        <button class="nav-user-btn logout"> Se deconnecter</button>
                    </form>
                    </div>
                @endauth
                @guest()
                    <div class="nav-item">
                        <a class="nav-user-btn" href="{{route('register')}}">Créer son compte </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-user-btn" href="{{route('login')}}"> Se connecter </a>
                    </div>
                @endguest
            </div>

        </div>
        </div>
</nav>
