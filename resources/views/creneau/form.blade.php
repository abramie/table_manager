<form action="" method="post" class="vstack gap-2">
    @csrf

    <div class="form-group">
        <label for="nom">Nom du creneau</label>
        <input type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $creneau->nom) }}">
        @error("nom")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="duree">Durée</label>
        <input type="number" class="form-control @error("duree") is-invalid @enderror" id="duree" name="duree" value="{{ old('duree', $creneau->duree) }}">
        @error("duree")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top" title="{{$settings->firstWhere('name','max_tables')->description}}">
    <label for="max_tables">Durée</label>
    <input type="number" class="form-control @error("max_tables") is-invalid @enderror" id="max_tables" name="max_tables" value="{{ old('max_tables', $creneau->max_tables) }}">
    @error("max_tables")
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    </div>

    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top" title="{{$settings->firstWhere('name','nb_inscription_online_max')->description}}">
        <label for="nb_inscription_online_max">nb_inscription_online_max</label>
        <input type="number" class="form-control @error("nb_inscription_online_max") is-invalid @enderror" id="nb_inscription_online_max" name="nb_inscription_online_max" value="{{ old('nb_inscription_online_max', $creneau->nb_inscription_online_max) }}">
        @error("nb_inscription_online_max")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button class="btn btn-primary">

        @if($creneau->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
