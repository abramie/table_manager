<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<style type="text/css">

    .dropdown-toggle{

        height: 40px;

        width: 400px !important;

    }
</style>
<form action="" method="post" class="vstack gap-2">
    @csrf

    <button class="btn btn-xs btn-info pull-left" type="button" onclick="window.location='{{ url()->previous() }}'">
        Retour
    </button>
    @error('erreur_temps')
        <div class=".alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @can('manage_tables_all')
        <div class="form-group">
            <label for="mj_name">Le nom du MJ</label>
            <select class=" form-control form-select" @error("mj_name") is-invalid @enderror id="mj_name" name="mj_name" data-live-search="true">

                @foreach(App\Models\User::role('mj')->get() as $mj)
                    <option value="{{$mj->name}}" @selected( $table->mjs?->name ? old('mj_name',$table->mjs->name) ==$mj->name : old('mj_name',Auth::user()->name )== $mj->name) >{{$mj->name}}</option>
                @endforeach
            </select>
            @error("mj_name")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>
    @endcan
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
                multiple data-live-search="true">
            @php
                $tw_id = $table->triggerwarnings()->pluck('id','nom');
                $tws = [];
            @endphp
            @foreach($triggerwarnings as $triggerwarning)
                @if((old('triggerwarnings') ? collect(old('triggerwarnings'))?->contains($triggerwarning->id) : $tw_id->contains($triggerwarning->id) ) ||$triggerwarning->id == $new_tw )
                    <option selected value="{{$triggerwarning->id}}">{{$triggerwarning->nom}}</option>
                @else
                    @php
                        $tws[] = $triggerwarning;
                    @endphp
                @endif

            @endforeach
            @foreach($tws as $tw )
                <option value="{{$tw->id}}">{{$tw->nom}}</option>
            @endforeach
        </select>
        @error("triggerwarnings")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button class="btn btn-primary" type="submit" name="action" value="add_tw">

            Ajout de tw
        </button>
    </div>
    <div class="form-group">
        <label for="tag">Tags</label>
        <select class="form-control @error("tags") is-invalid @enderror" id="tag" name="tags[]" multiple data-live-search="true">
            @php
                $tags_id = $table->tags()->pluck('id', 'nom');
                $tags_unselected = [];
            @endphp
            @foreach($tags as $tag)
                @if((old('tags') ? collect(old('tags'))?->contains($tag->id) : $tags_id->contains($tag->id) )|| $tag->id == $new_tag)
                    <option selected value="{{$tag->id}}">{{$tag->nom}}</option>
                @else
                    @php
                        $tags_unselected[] = $tag;
                    @endphp
                @endif
            @endforeach
            @foreach($tags_unselected as $tag )
                <option value="{{$tag->id}}">{{$tag->nom}}</option>
            @endforeach
        </select>
        @error("tags")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button class="btn btn-primary" type="submit" name="action" value="add_tag">
            Ajout de tag
        </button>
    </div>
    <script type="text/javascript">

        $(document).ready(function() {

            $('select').selectpicker();

        });

    </script>

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


    <div class="form-group" id="open_preinscription_div">
         <label for="max_preinscription">Nombre de pré-inscription maximum sur la table</label>
        <input type="number" class="form-control @error("max_preinscription") is-invalid @enderror" id="max_preinscription"
               name="max_preinscription" value="{{ old('max_preinscription', $table->max_preinscription) }}">

        @error("max_preinscription")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <div class="input-group date">
            <label for="debut_table">Debut de la table</label>
            <input type="time" class="form-control @error("debut_table")is-invalid @enderror" id="debut_table" name="debut_table" value="{{old('debut_table', $table->debut_table?->toTimeString())}}">
            @error("debut_table")
                <div id="debut_tableFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
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

    <div class="form-group" id="ajout_jeu">


    </div>

    <div class="form-group">
        <label for="title">Nom du jeu</label>
        <input type="text" class="form-control @error("nom_jeu") is-invalid @enderror" id="nom_jeu" name="nom_jeu"
               value="{{ old('nom_jeu') }}">
        @error("nom_jeu")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="description_jeu">Description du jeu</label>
        <input type="text" class="form-control @error("description_jeu") is-invalid @enderror" id="description_jeu"
               name="description_jeu" value="{{ old('description_jeu') }}">
        @error("description_jeu")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    @can('manage_tables_all')
        <div class="form-group">
            <label for="inscrits">Joueurs inscrits</label>
            <select class=" form-control form-select @error("inscrits") is-invalid @enderror"  id="inscrit" name="inscrits[]"  multiple data-live-search="true">
                @php
                    $users_name =$table->users()->pluck('name');
                    $users_non_inscrits = [];
                @endphp

                @foreach(App\Models\User::role('joueur')->get() as $joueur)
                    @if((old('inscrits') ? collect(old('inscrits'))?->contains($joueur->name) : $users_name->contains($joueur->name)))
                        <option value="{{$joueur->name}}" selected>{{$joueur->name}}</option>

                    @else
                        @php
                            $users_non_inscrits[] = $joueur;
                        @endphp

                    @endif

                @endforeach
                @foreach($users_non_inscrits as $joueur)
                    <option value="{{$joueur->name}}" >{{$joueur->name}}</option>
                @endforeach
            </select>

            @error("inscrits")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>
    @endcan
    <button class="btn btn-primary" type="submit" name="action" value="save">

        @if($table->id)
            Modifier
        @else
            Créer
        @endif
    </button>


</form>

