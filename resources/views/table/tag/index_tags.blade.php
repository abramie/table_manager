@extends('admin.base')

@section('title', 'Liste des tables')


@section('content-admin')
    <h1>Liste settings</h1>

    @foreach($tags as $tag)
        <form action="{{route('tags.update', ['tag' => $tag])}}" method="post" class="vstack gap-2">
            @csrf
            <div class="form-group" title="{{$tag->nom}}">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" @error($tag->nom) is-invalid @enderror name="name" value="{{old("name",$tag->nom)}}">

                @error($tag->nom)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <select>
                    @foreach($typeTags as $typeTag)
                        <option class="{{$typeTag->bs_class}}" value="{{$typeTag->id}}" @selected($typeTag->id == $tag->type_tag_id) >{{$typeTag->name}}</option>
                    @endforeach

                </select>


                <button class="btn btn-primary" type="submit" name="action" value="save">
                    Modifier
                </button>
            </div>
        </form>
    @endforeach

    {{ $tags->links() }}
@endsection
