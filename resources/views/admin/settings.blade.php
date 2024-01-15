@extends('admin.base')

@section('title', 'Liste des tables')


@section('content-admin')
    <h1>Liste settings</h1>

    @foreach($settings as $setting)
        <form action="{{route('admin.settings.update', ['setting' => $setting])}}" method="post" class="vstack gap-2">
            @csrf
            <div class="form-group" title="{{$setting->description}}">
                <label  for="value">{{$setting->name}}</label>
                <input type="text" class="form-control" id="value" @error($setting->name) is-invalid @enderror name="value" value="{{old("value",$setting->value)}}">

                @error($setting->name)
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

    {{ $settings->links() }}
@endsection
