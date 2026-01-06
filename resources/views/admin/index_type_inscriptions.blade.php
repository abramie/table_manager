@extends('admin.base')

@section('title', 'Liste des tables')


@section('content-admin')
    <h1>Liste settings</h1>

    @foreach($type_inscriptions as $type_inscription)
        <form action="{{route('admin.type_inscriptions.update', ['type_inscription' => $type_inscription])}}" method="post" class="vstack gap-2">
            @csrf
            <div class="form-group" title="{{$type_inscription->name}}">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" @error($type_inscription->name) is-invalid @enderror name="name" value="{{old("name",$type_inscription->name)}}">

                @error($type_inscription->name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="bs_class">Classes bootstrap</label>
                <input type="text" class="form-control" id="bs_class" @error($type_inscription->bs_class) is-invalid @enderror name="bs_class" value="{{old("bs_class",$type_inscription->bs_class)}}">

                @error($type_inscription->bs_class)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="prend_une_place">Compte comme inscrit à la table</label>
                <input type="checkbox" class="" id="prend_une_place" @checked($type_inscription->prend_une_place)>

                @error($type_inscription->prend_une_place)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror



                <button class="btn btn-primary" type="submit" name="action" value="save">
                    Modifier
                </button>
            </div>
        </form>
    @endforeach

    {{ $type_inscriptions->links() }}
@endsection
