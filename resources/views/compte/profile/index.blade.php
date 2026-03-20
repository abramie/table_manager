@extends('compte.base')

@section('title', 'Profiles')


@section('content-compte')
    <h1>Profiles</h1>

    <div class="d-flex flex-wrap">

        @foreach($profiles as $profile)

            <div class="card text-center @if($compte->currentProfile()->select('name')->first()->name == $profile->name) border-success @endif ">

                <form method="POST" action="{{route('profile.update', [$compte, $profile])}}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 >
                            <label class="label-text" for="name">Pseudo*</label>
                            <input type="text" name="name" value="{{$profile->name}}" class="form-control">
                        </h5>
                        <label class="label-text" for="email">Email</label>
                        <input type="text" name="email" value="{{$profile->email}}" class="form-control">
                        <label class="label-text" for="discord_tag">Tag discord</label>
                        <input type="text" name="discord_tag" value="{{$profile->discord_tag}}" class="form-control">

                        <button class="btn btn-primary mt-2" type="submit">Mettre à jour</button>

                    </div>

                    <div class="card-footer" >
                        @if($compte->currentProfile()->select('name')->first()->name != $profile->name)
                        <a href="{{route('profile.change', [$compte,$profile])}}" class="btn btn-validate">Rendre actif</a>
                        <a href="{{route('profile.delete', [$compte,$profile])}}" class="btn btn-warning">Supprimer</a>
                        @else
                            <h2 class="profile-card-actif-title">Actif</h2>--}}
                        @endif
                    </div>

{{--                    @if($compte->currentProfile()->select('name')->first()->name == $profile->name)--}}
{{--                        <div class="" >--}}

{{--

{{--                        </div>--}}
{{--                    @endif--}}
                </form>


            </div>

        @endforeach
        <form method="POST" action="{{route('profile.store', [$compte])}}" enctype="multipart/form-data">
            @csrf
            <div class="card text-center">
                <div class="card-title">
                    Ajouter un profil
                </div>
                <div class="card-body">
                    <h5 >
                        <label class="label-text" for="name">Pseudo</label>
                        <input name="name" type="text" value="" class="form-control">
                    </h5>
                    <label class="label-text" for="email">Email</label>
                    <input name="email" type="text" value="" class="form-control">
                    <label class="label-text" for="discord_tag">Tag discord</label>
                    <input name="discord_tag" type="text" value="" class="form-control">
                    <button class="btn btn-primary mt-2" type="submit">Ajouter le profil</button>
                </div>

            </div>
        </form>
    </div>

@endsection
