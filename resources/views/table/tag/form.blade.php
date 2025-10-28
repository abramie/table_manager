<form action="" method="post" class="vstack gap-2">
@csrf


    <div class="form-group">
        <label for="nom_tag">Nom du Tag</label>
        <input type="text" class="form-control @error("nom_tag") is-invalid @enderror" id="nom_tag" name="nom_tag"
               value="{{ old('nom_tag', $tag->nom) }}">
        @error("nom_tag")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <button class="btn btn-primary">

        @if($tag->id)
            Modifier
        @else
            Créer
        @endif
    </button>

</form>
