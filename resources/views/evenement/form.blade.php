<form action="" method="post" class="vstack gap-2">
    @csrf

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control @error("nom_evenement") is-invalid @enderror" id="nom_evenement" name="nom_evenement" value="{{ old('nom_evenement', $evenement->nom_evenement) }}">
        @error("title")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control @error("slug") is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $evenement->slug) }}">
        @error("slug")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top" title="{{$settings->firstWhere('name','max_tables')->description}}">
        <label for="max_tables">max_tables</label>
        <input  type="number" class="form-control @error("max_tables") is-invalid @enderror" id="max_tables" name="max_tables" value="{{ old('max_tables', $evenement->max_tables) }}">
        @error("max_tables")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

    </div>

    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top" title="{{$settings->firstWhere('name','nb_inscription_online_max')->description}}">
        <label for="nb_inscription_online_max">nb_inscription_online_max</label>
        <input  type="number" class="form-control @error("nb_inscription_online_max") is-invalid @enderror" id="nb_inscription_online_max" name="nb_inscription_online_max" value="{{ old('nb_inscription_online_max', $evenement->nb_inscription_online_max) }}">
        @error("nb_inscription_online_max")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button class="btn btn-primary">

        @if($evenement->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
