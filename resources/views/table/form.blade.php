<form action="" method="post" class="vstack gap-2">
    @csrf

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $table->nom) }}">
        @error("nom")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control @error("description") is-invalid @enderror" id="description" name="description" value="{{ old('description', $table->description) }}">
        @error("description")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="tw">TW</label>
        <input type="text" class="form-control @error("tw") is-invalid @enderror" id="tw" name="tw" value="{{ old('tw', $table->tw) }}">
        @error("tw")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="nb_joueur_min">nb_joueur_min</label>
        <input type="number" class="form-control @error("nb_joueur_min") is-invalid @enderror" id="nb_joueur_min" name="nb_joueur_min" value="{{ old('nb_joueur_min', $table->nb_joueur_min) }}">
        @error("nb_joueur_min")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="nb_joueur_max">nb_joueur_max</label>
        <input type="number" class="form-control @error("nb_joueur_max") is-invalid @enderror" id="nb_joueur_max" name="nb_joueur_max" value="{{ old('nb_joueur_max', $table->nb_joueur_max) }}">
        @error("nb_joueur_max")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="duree">duree</label>
        <input type="number" class="form-control @error("duree") is-invalid @enderror" id="duree" name="duree" value="{{ old('duree', $table->duree) }}">
        @error("duree")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mj_name">mj_name</label>
        <input type="text" class="form-control @error("mj_name") is-invalid @enderror" id="mj_name" name="mj_name" value="{{ old('mj_name', $table->mj_name) }}">
        @error("mj_name")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button class="btn btn-primary">

        @if($table->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
