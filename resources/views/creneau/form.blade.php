<form action="" method="post" class="vstack gap-2">
    @csrf

    <div class="form-group">
        <label for="nom">Nom du creneau</label>
        <input type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom"
               value="{{ old('nom', $creneau->nom) }}">
        @error("nom")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="duree">Durée</label>
        <input type="number" class="form-control @error("duree") is-invalid @enderror" id="duree" name="duree"
               value="{{ old('duree', $creneau->duree) }}">
        @error("duree")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top"
         title="{{$descriptions->firstWhere('name','max_tables')->description}}">
        <label for="max_tables">Max tables</label>
        <input type="number" class="form-control @error("max_tables") is-invalid @enderror" id="max_tables"
               name="max_tables" value="{{ old('max_tables', $creneau->max_tables) }}">
        @error("max_tables")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top"
         title="{{$descriptions->firstWhere('name','nb_inscription_online_max')->description}}">
        <label for="nb_inscription_online_max">nb_inscription_online_max</label>
        <input type="number" class="form-control @error("nb_inscription_online_max") is-invalid @enderror"
               id="nb_inscription_online_max" name="nb_inscription_online_max"
               value="{{ old('nb_inscription_online_max', $creneau->nb_inscription_online_max) }}">
        @error("nb_inscription_online_max")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <div class="form-group" data-toggle="tooltip" rel="tooltip" data-placement="top"
         title="{{$descriptions->firstWhere('name','sans_table_toggle')?->description}}">
        <label for="sans_table">sans_table</label>
        <input type="checkbox" class="form-check-input" @checked(old('sans_table', $creneau->sans_table)) @error("sans_table") is-invalid @enderror
               id="sans_table" name="sans_table" value="1">
        {{old('sans_table', $creneau->sans_table)}}

        @error("sans_table")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        @if(!old('sans_table', $creneau->sans_table))
        <label for="sans_table_name">Nom de la table "Sans tables" </label>
        <input type="text" class="form-check-input" id="sans_table_name" name="sans_table_name" value="Sans tables" >
        @error("sans_table_name")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        @endif
    </div>
    <div class="form-group">
        <div class="input-group date">
            <label for="debut_creneau">Debut du creneau</label>
            <input type="datetime-local" class="form-control @error("debut_creneau")is-invalid @enderror" id="debut_creneau" name="debut_creneau" value="{{old('debut_creneau', $creneau->debut_creneau)}}">
            @error("debut_creneau")
            <div id="debut_creneauFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>



    <button class="btn btn-primary">

        @if($creneau->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
