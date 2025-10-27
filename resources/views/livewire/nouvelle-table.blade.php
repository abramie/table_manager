<div>
    <form wire:submit="save">

        @can('manage_tables_all')
            <div class="form-group">
                <label for="mj_name">Le nom du MJ</label>
                <select wire:model="mj" class=" form-control form-select" @error("mj_name") is-invalid @enderror id="mj_name" name="mj_name"
                        data-live-search="true">

                    @foreach(App\Models\Compte::role('mj')->get() as $mj)
                        <option value="{{$mj->mainProfile->name}}">{{$mj->mainProfile->name}}</option>
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
                <input wire:model="titre" type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom">
            </div>


        <div class="form-group">
            <label for="description">description</label>
            <input wire:model="table_description" type="text" class="form-control @error("description") is-invalid @enderror" id="description"
                   name="description" >
            @error("description")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

{{--            Toute la partie TW--}}

{{--            Toute la partie Tags --}}


        <div class="form-group">
            <label for="nb_joueur_min">nb_joueur_min</label>
            <input wire:model="nb_joueur_min" type="number" class="form-control @error("nb_joueur_min") is-invalid @enderror" id="nb_joueur_min"
                   name="nb_joueur_min">
            @error("nb_joueur_min")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nb_joueur_max">nb_joueur_max</label>
            <input wire:model="nb_joueur_max" type="number" class="form-control @error("nb_joueur_max") is-invalid @enderror" id="nb_joueur_max"
                   name="nb_joueur_max" >
            @error("nb_joueur_max")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

{{--            Ajouter le controle de permission sur les préinscritions--}}
        <div class="form-group" id="open_preinscription_div">
            <label for="max_preinscription">Nombre de pré-inscription maximum sur la table</label>
            <input wire:model="max_preinscription" type="number" class="form-control @error("max_preinscription") is-invalid @enderror"
                   id="max_preinscription"
                   name="max_preinscription" >

            @error("max_preinscription")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <x-date-picker label="Debut de la table" wire:model="debut_table" options='{enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true
                        }'>

        </x-date-picker>
{{--Ajouter min Time et maxTime au picker https://flatpickr.js.org/examples/#time-picker--}}


        <div class="form-group">
            <label for="duree">Durée</label>
            <input wire:model="duree" type="number" class="form-control @error("duree") is-invalid @enderror" id="duree" name="duree"
                   >
            @error("duree")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


            <div class="form-group">
                <label for="mj_name">Jeu</label>
                <select wire:model="jeu" class=" form-control form-select" @error("jeu") is-invalid @enderror id="mj_name" name="mj_name"
                        data-live-search="true">

                    @foreach(App\Models\Jeu::all() as $jeu_select)
                        <option value="{{$jeu_select->nom}}">{{$jeu_select->nom}}</option>
                    @endforeach
                </select>
                @error("jeu")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <button class="btn btn-primary" type="submit" name="action" value="save">

                @if($table->id)
                    Modifier
                @else
                    Créer
                @endif
            </button>
    </form>



</div>
