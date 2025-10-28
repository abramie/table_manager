@extends('compte.base')

@section('title', 'Profiles')


@section('content-compte')
    <h1>Profiles</h1>

    <div class="d-flex flex-wrap">

        @foreach($profiles as $profile)
            <div class="card text-center">

                <form method="POST" action="{{route('profile.update', [$compte, $profile])}}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="card-title">
                            <label for="name">Pseudo*</label>
                            <input type="text" name="name" value="{{$profile->name}}" class="form-control">
                        </h5>
                        <label for="name">Email</label>
                        <input type="text" name="email" value="{{$profile->email}}" class="form-control">
                        <label for="name">Tag discord</label>
                        <input type="text" name="discord_tag" value="{{$profile->discord_tag}}" class="form-control">

                        <button class="btn btn-primary" type="submit">Mettre à jour</button>

                    </div>
                    <div class="card-footer  @if($compte->currentProfile()->select('name')->first()->name == $profile->name) bg-success @endif " >

                        @if($compte->currentProfile()->select('name')->first()->name != $profile->name)
                            <a href="{{route('profile.change', [$compte,$profile])}}" class="btn btn-primary">Selectionner comme actif</a>
                        @else
                            <span class="badge badge-sucess">Actif</span>
                        @endif
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
                        <input name="name" type="text" value="" class="form-control">
                    </h5>
                    <input name="email" type="text" value="" class="form-control">
                    <input name="discord_tag" type="text" value="" class="form-control">
                    <button class="btn btn-primary" type="submit">Ajouter le profil</button>
                </div>

            </div>
        </form>
    </div>

@endsection
