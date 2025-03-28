<form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
    @csrf

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

    <div class="mb-3">

        <label class="form-label" for="inputImage">Image:</label>

        <input
            type="file"
            name="image"
            id="image"
            class="form-control @error('image') is-invalid @enderror">

        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" class="form-control @error("description") is-invalid @enderror" id="description" name="description" >{{ old('description', $evenement->description) }}</textarea>
        @error("description")
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

    <div class="form-group">
        <div class="input-group date">
            <label for="date_debut">Date de debut de l'evenement</label>
            <input type="datetime-local" class="form-control @error("date_debut") is-invalid @enderror"  id="date_debut" name="date_debut" value="{{old('date_debut', $evenement->date_debut)}}">
            @error("date_debut")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div>
        <div class="form-group" >
            <div class="input-group date" id="affichage_evenement_div">
                <label for="affichage_evenement">Date d'affichage de l'evenement / ajout des tables</label>
                <input type="datetime-local" class="form-control @error("affichage_evenement") is-invalid @enderror"  id="affichage_evenement" name="affichage_evenement"value="{{old('affichage_evenement', $evenement->affichage_evenement)}}">
                @error("affichage_evenement")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <label for="toggle-affichage_evenement"  class="form-check-label">Choisir une date manuelle d'affichage de l'evenement</label>
            <input type="checkbox" @checked(old('toggle-affichage_evenement'))   aria-expanded="false" aria-controls="moreabout" class="form-check-input" id="toggle-affichage_evenement" name="toggle-affichage_evenement" value="no">

        </div>



        <div class="form-group">
            <div class="input-group date" id="ouverture_inscription_div">
                <label for="ouverture_inscription"  class="form-check-label">Date d'ouverture des inscriptions joueurs</label>
                <input type="datetime-local" class="form-control @error("ouverture_inscription") is-invalid @enderror" id="ouverture_inscription" name="ouverture_inscription" value="{{old('ouverture_inscription', $evenement->ouverture_inscription)}}">
                @error("ouverture_inscription")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <label for="toggle-ouverture_inscription">Choisir une date manuelle d'ouverture des inscriptions</label>
            <input type="checkbox"  @checked(old('toggle-ouverture_inscription'))  aria-expanded="false" aria-controls="moreabout" class="form-check-input" id="toggle-ouverture_inscription" name="toggle-ouverture_inscription" value="no">

        </div>

        <div class="form-group">
            <div class="input-group date" id="fermeture_inscription_div">
                <label for="fermeture_inscription">Date de fermeture des inscriptions joueurs</label>
                <input type="datetime-local" class="form-control @error("fermeture_inscription") is-invalid @enderror" id="fermeture_inscription" name="fermeture_inscription"value="{{old('fermeture_inscription', $evenement->fermeture_inscription)}}">
                @error("fermeture_inscription")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <label for="toggle-fermeture_inscription"  class="form-check-label">Choisir une date manuelle de fermeture des inscriptions</label>
            <input type="checkbox"  @checked(old('toggle-fermeture_inscription'))  aria-expanded="false" aria-controls="moreabout" class="form-check-input" id="toggle-fermeture_inscription" name="toggle-fermeture_inscription" value="no">

        </div>

        <script>
            $("input[id*='toggle'][type=checkbox]").each(function(){
                let div = $("#"+$(this).attr('id').split('-')[1] + "_div");
                if(!$(this).is(':checked'))  div.hide();
                if(div.find("input").attr('class').includes("is-invalid")) {
                    div.show();
                    $(this).prop( "checked", true );
                }
                $(this).on('click', function() {
                    if(div.is(':hidden')) {
                        div.show();
                    } else {
                        div.hide();
                    }
                });
            })
        </script>

    </div>
    <button class="btn btn-primary">

        @if($evenement->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
