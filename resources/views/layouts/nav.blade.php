<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @php
        $authCompte = Auth::user();
        $currentProfile = $authCompte?->currentProfile;
    @endphp
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route("events.index") }}">Retour à l'accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


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
                    <x-navigation-item routeName="tags.add" contain="tags" >Ajout Tag</x-navigation-item>
                @endcan
                @can('ajout_tws')
                    <x-navigation-item routeName="tw.add" contain="tw" >Ajout TW</x-navigation-item>
                @endcan

                @role('joueur')
                    <x-navigation-item routeName="profile.show" :parameter="[$authCompte]" contain="joueur" >Profiles</x-navigation-item>
                @endrole

                @role('mj')
                    <x-navigation-item routeName="profile.mj" :parameter="['compte' => $authCompte, 'profile' => $currentProfile]" contain="mj" >MJ</x-navigation-item>
                @endrole
            </ul>
            <div class="">
                @auth()
                    <div class="nav-item">
                    <a href="{{route("compte.edit", $authCompte)}}"> {{ $currentProfile ? $currentProfile->name : "Compte"}}</a>
                    </div>
                    <div class="nav-item">
                    <form action="{{route('logout')}}" method="post">

                        @csrf
                        <button class="nav-link"> Se deconnecter</button>
                    </form>
                    </div>
                @endauth
                @guest()
                    <div class="nav-item">
                    <a href="{{route('register')}}">Créer son compte </a>
                    </div>
                    <div class="nav-item">
                    <a href="{{route('login')}}"> Se connecter </a>
                    </div>
                @endguest
            </div>


        </div>
    </div>
</nav>
