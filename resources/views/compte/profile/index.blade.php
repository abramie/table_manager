@extends('compte.base')

@section('title', 'Profiles')


@section('content-compte')
    <h1>Profiles</h1>

    <div class="d-flex ">

        @foreach($profiles as $profile)



                <form method="POST" action="{{route('profile.update', [$compte, $profile])}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card w-200 text-center p-4 me-2 @if($compte->currentProfile()->select('name')->first()->name == $profile->name) border-success @endif ">
                        <div class="card-title">
                            {{$profile->name}}
                        </div>
                        <div class="card-body p-2">
                            <div class="row mb-3 me-2">
                                <label class="label-text col-sm col-form-label" for="name">Pseudo*</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="{{$profile->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3 me-2">
                                <label class="label-text col-sm col-form-label" for="email">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="{{$profile->email}}" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3 me-2">
                                <label class="label-text col-sm col-form-label" for="discord_tag">Tag discord</label>
                                <div class="col-sm-8">
                                    <input type="text" name="discord_tag" value="{{$profile->discord_tag}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button class="som-btn som-btn-primary mt-2" type="submit">Mettre à jour</button>
                            </div>


                        </div>

                        <div class="card-footer" >
                            @if($compte->currentProfile()->select('name')->first()->name != $profile->name)
                            <a href="{{route('profile.change', [$compte,$profile])}}" class="btn btn-validate">Rendre actif</a>
                            <a href="{{route('profile.delete', [$compte,$profile])}}" class="btn btn-warning">Supprimer</a>
                            @else
                                <h2 class="profile-card-actif-title">Actif</h2>
                            @endif
                        </div>

{{--                    @if($compte->currentProfile()->select('name')->first()->name == $profile->name)--}}
{{--                        <div class="" >--}}

{{--

{{--                        </div>--}}
{{--                    @endif--}}
                    </div>
                </form>




        @endforeach
        <form method="POST" action="{{route('profile.store', [$compte])}}" enctype="multipart/form-data">
            @csrf
            <div class="card w-200 text-center me-2 p-4">
                <div class="card-title">
                    Ajouter un profil
                </div>
                <div class="card-body p-2">
                    <div class="row mb-3 me-2">
                        <label class="label-text col-sm col-form-label" for="name">Pseudo*</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3 me-2">
                        <label class="label-text col-sm col-form-label" for="email">Email</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3 me-2">
                        <label class="label-text col-sm col-form-label" for="discord_tag">Tag discord</label>
                        <div class="col-sm-8">
                            <input type="text" name="discord_tag" value="{{old('discord_tag')}}" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <button class="som-btn som-btn-primary mt-2" type="submit">Ajouter le profil</button>
                    </div>


                </div>
            </div>


        </form>
    </div>

@endsection
