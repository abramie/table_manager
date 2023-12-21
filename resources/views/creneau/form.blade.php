<form action="" method="post" class="vstack gap-2">
    @csrf

    <div class="form-group">
        <label for="nom">Nom de l'événément</label>
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
    <button class="btn btn-primary">

        @if($creneau->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
