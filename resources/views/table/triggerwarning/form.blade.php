<form action="" method="post" class="vstack gap-2">
@csrf


    <div class="form-group">
        <label for="nom_triggerwarning">Nom du TW</label>
        <input type="text" class="form-control @error("nom_triggerwarning") is-invalid @enderror" id="nom_triggerwarning" name="nom_triggerwarning"
               value="{{ old('nom_triggerwarning', $triggerwarning->nom) }}">
        @error("nom_triggerwarning")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <button class="btn btn-primary">

        @if($triggerwarning->id)
            Modifier
        @else
            Créer
        @endif
    </button>

</form>
