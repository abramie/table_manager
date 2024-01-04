<form action="" method="post" class="vstack gap-2">
    @csrf

    <button class="btn btn-xs btn-info pull-left" type="button" onclick="window.location='{{ url()->previous() }}'">
        Retour
    </button>

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom"
               value="{{ old('nom', $table->nom) }}">
        @error("nom")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control @error("description") is-invalid @enderror" id="description"
               name="description" value="{{ old('description', $table->description) }}">
        @error("description")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <div class="form-group">
        <label for="tw" data-toggle="tooltip" rel="tooltip" data-placement="top"
               title="{{$descriptions->firstWhere('name','trigger_warnings')->description}}">TW/CW</label>
        <select type="text" class="form-control @error("tw") is-invalid @enderror" id="tw" name="triggerwarnings[]"
                multiple>
            @php
                $tw_id = $table->triggerwarnings()->pluck('id');
            @endphp
            @foreach($triggerwarnings as $triggerwarning)
                <option
                    @selected($tw_id->contains($triggerwarning->id)) value="{{$triggerwarning->id}}">{{$triggerwarning->nom}}</option>
            @endforeach
        </select>
        @error("triggerwarnings")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="tag">Tags</label>
        <select class="form-control @error("tags") is-invalid @enderror" id="tag" name="tags[]" multiple>
            @php
                $tag_id = $table->tags()->pluck('id');
            @endphp
            @foreach($tags as $tag)
                <option @selected($tag_id->contains($tag->id)) value="{{$tag->id}}">{{$tag->nom}}</option>
            @endforeach
        </select>
        @error("tags")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <a  href="{{ route('tags.add') }}">
            <i class="fa fa-arrow-circle-o-left"></i>

            <span>Ajout de tag</span>
        </a>

        <button class="btn btn-primary" type="submit" name="action" value="add_tag">

            Ajout de tag
        </button>
    </div>


    <div class="form-group">
        <label for="nb_joueur_min">nb_joueur_min</label>
        <input type="number" class="form-control @error("nb_joueur_min") is-invalid @enderror" id="nb_joueur_min"
               name="nb_joueur_min" value="{{ old('nb_joueur_min', $table->nb_joueur_min) }}">
        @error("nb_joueur_min")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="nb_joueur_max">nb_joueur_max</label>
        <input type="number" class="form-control @error("nb_joueur_max") is-invalid @enderror" id="nb_joueur_max"
               name="nb_joueur_max" value="{{ old('nb_joueur_max', $table->nb_joueur_max) }}">
        @error("nb_joueur_max")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="duree">duree</label>
        <input type="number" class="form-control @error("duree") is-invalid @enderror" id="duree" name="duree"
               value="{{ old('duree', $table->duree) }}">
        @error("duree")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mj_name">mj_name</label>
        <input type="text" class="form-control @error("mj_name") is-invalid @enderror" id="mj_name" name="mj_name"
               value="{{ old('mj_name', $table->mj_name) }}">
        @error("mj_name")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="jeu">jeu</label>
        <select class="form-control" id="jeu" name="jeu">
            {{-- @foreach($jeux as $jeu)
                 <option @selected(old('jeu') == $jeu->id) value="{{$jeu->id}}> {{$jeu->name}}</option>
             @endforeach
             --}}
            <option value="-1">Option test</option>
        </select>
        <script>
            function ouverture_page_ajout_table() {

                var win = window.open('{{ route("events.one.add",['evenement'=> $evenement,'creneau' =>$creneau])}}', '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                }
            }
        </script>

        <button class="btn btn-xs btn-info pull-right" type="button" onclick='window.location.reload()'>
            Refresh
        </button>
        <button class="btn btn-xs btn-info pull-right" type="button" onclick='ouverture_page_ajout_table()'>
            Ajouter un jeu (todo)
        </button>
    </div>

    <button class="btn btn-primary" type="submit" name="action" value="save">

        @if($table->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
