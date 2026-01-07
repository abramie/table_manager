@extends('admin.base')

@section('title', 'Liste des tables')


@section('content-admin')
    <h1>Liste des tags</h1>

        @can('ajout_tag')
            <button href="{{route('tags.add')}}" class="btn btn-primary">
                Ajout Tag
            </button>
        @endcan
    <table class="table">

        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom du Tag</th>
            <th scope="col">Type de Tag</th>
            <th scope="col">Createur</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>

            <form action="{{route('tags.update', ['tag' => $tag])}}" method="post" class="vstack gap-2">
                @csrf

                <div class="form-group" title="{{$tag->name}}">
                    <td>
                        <span class="{{$tag->typeTag->bs_class}}">{{$tag->name}}</span>
                    </td>
                    <td>
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" @error($tag->name) is-invalid @enderror name="name" value="{{old("name",$tag->name)}}">

                        @error($tag->name)
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    </td>
                    @enderror
                    <td>
                        <select>
                            @foreach($typeTags as $typeTag)
                                <option class="{{$typeTag->bs_class}}" value="{{$typeTag->id}}" @selected($typeTag->code == $tag->type_tag_code) >{{$typeTag->name}}</option>
                            @endforeach

                        </select>
                    </td>
                    <td>

                    </td>
                        @can('change_tags')
                            <td>
                                <button class="btn btn-primary" type="submit" name="action" value="save">
                                    Modifier
                                </button>
                            </td>
                        @endcan
                </div>
            </form>
        @endforeach
    </table>
    {{ $tags->links() }}
@endsection
