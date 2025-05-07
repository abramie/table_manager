@extends('compte.base')

@section('title', 'Profiles')


@section('content-compte')
    <h1>Profiles</h1>

    <div class="d-flex flex-wrap">

    @foreach($profiles as $profil)
        <div class="card text-center">

            <form method="POST" action="{{route('profile.update', [$compte, $profil])}}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <h5 class="card-title">
                        <input type="text" name="name" value="{{$profil->name}}" class="form-control">
                    </h5>
                    <input type="text" name="email" value="{{$profil->email}}" class="form-control">
                    <input type="text" name="discord_tag" value="{{$profil->discord_tag}}" class="form-control">

                    <button class="btn btn-primary" type="submit">Mettre à jour</button>
                </div>
                <div class="card-footer text-muted">
                    <badge>Actif</badge>
                </div>
            </form>
        </div>

    @endforeach
        <form method="POST" action="{{route('profile.store', [$compte])}}" enctype="multipart/form-data">
            @csrf
        <div class="card text-center">
            <div class="card-header">
                Ajouter un profil
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <input name="name"  type="text" value="" class="form-control">
                </h5>
                <input name="email" type="text" value="" class="form-control">
                <input name="discord_tag" type="text" value="" class="form-control">
                <button class="btn btn-primary" type="submit">Ajouter le profil</button>
            </div>

        </div>
        </form>
    </div>

@endsection
