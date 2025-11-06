<div>

    <form wire:submit="save">
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        @can('manage_tables_all')
            <div class="form-group">
                <label for="mj_name">Le nom du MJ</label>
                <select wire:model="form.mj_name" class=" form-control form-select" @error("form.mj") is-invalid @enderror id="mj_name" name="mj_name">

                    @foreach(App\Models\Compte::role('mj')->get() as $mj)
                        <option value="{{$mj->mainProfile->name}}">{{$mj->mainProfile->name}}</option>
                    @endforeach
                </select>
                @error("form.mj")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>
        @endcan

            <div class="form-group">
                <label for="form.nom">Titre</label>
                <input wire:model="form.nom" type="text" class="form-control @error("form.nom") is-invalid @enderror" id="nom" name="nom">
                @error("form.nom")
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>


        <div class="form-group">
            <label for="description">description</label>
            <input wire:model="form.table_description" type="text" class="form-control @error("form.table_description") is-invalid @enderror" id="description"
                   name="description" >
            @error("form.table_description")
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

{{--            Toute la partie TW--}}
            @foreach ($tws as $tw)
                @php
                    $tw->label = $tw->nom;
                    $tw->value = $tw->id;
                @endphp
            @endforeach
            <div class="form-group">

                <Label>Tws </Label>
                {{--                Ajouter le fait que les champs soit aligner.--}}
                <div class="col-auto">
                    <x-virtual-select
                        wire:model="form.triggerwarnings"
                        :options="[
                       'options' => $tws ,
                       'selectedValue' => $form->triggerwarnings,
                       'multiple' => true,
                       'showValueAsTags' => true,
                    ]"
                    />

                    <input type="text" wire:model="new_tw" wire:keydown.enter.prevent="addNewTw()"/>
                    {{$new_tw}}
                    <a href="#" wire:click.prevent="addNewTw()">Ajouter le TW </a>
                </div>
            </div>

{{--            Toute la partie Tags --}}
            @foreach ($tags as $tag)
                @php
                    $tag->label = $tag->nom;
                    $tag->value = $tag->id;
                @endphp
            @endforeach
            <div class="form-group">

                <Label>Tags </Label>
{{--                Ajouter le fait que les champs soit aligner.--}}
                <div class="col-auto">
                        <x-virtual-select
                            wire:model="form.tags_selected"
                            :options="[
                       'options' => $tags ,
                       'selectedValue' => $form->tags_selected,
                       'multiple' => true,
                       'showValueAsTags' => true,
                    ]"
                        />

                    <input type="text" wire:model="new_tag" wire:keydown.enter.prevent="addNewTag()"/>
                    {{$new_tag}}
                    <a href="#" wire:click.prevent="addNewTag()">Ajouter le tag </a>
                </div>
            </div>



        <div class="form-group">
            <label for="nb_joueur_min">nb_joueur_min</label>
            <input wire:model="form.nb_joueur_min" type="number" class="form-control @error("form.nb_joueur_min") is-invalid @enderror" id="nb_joueur_min"
                   name="nb_joueur_min">
            @error("form.nb_joueur_min")
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nb_joueur_max">nb_joueur_max</label>
            <input wire:model="form.nb_joueur_max" type="number" class="form-control @error("form.nb_joueur_max") is-invalid @enderror" id="nb_joueur_max"
                   name="nb_joueur_max" >
            @error("form.nb_joueur_max")
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

{{--            Ajouter le controle de permission sur les préinscritions--}}
        <div class="form-group" id="open_preinscription_div">
            <label for="max_preinscription">Nombre de pré-inscription maximum sur la table</label>
            <input wire:model="form.max_preinscription" type="number" class="form-control @error("form.max_preinscription") is-invalid @enderror"
                   id="max_preinscription"
                   name="max_preinscription" >

            @error("form.max_preinscription")
            <span class="error">{{ $message }}</span>
            @enderror

        </div>

        <x-date-picker label="Debut de la table" wire:model="form.debut_table" options='{enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true
                        }'>

        </x-date-picker>
            @error("form.date_debut")
            <span class="error">{{ $message }}</span>
            @enderror
{{--Ajouter min Time et maxTime au picker https://flatpickr.js.org/examples/#time-picker--}}


        <div class="form-group">
            <label for="duree">Durée</label>
            <input wire:model="form.duree" type="number" class="form-control @error("form.duree") is-invalid @enderror" id="duree" name="duree"
                   >
            @error("form.duree")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            <div>
                @error('duree') <span class="error">{{ $message }}</span> @enderror
            </div>
            @enderror
        </div>


        <div class="form-group">
            <label for="mj_name">Jeu</label>
            <select wire:model="form.jeu" class=" form-control form-select" @error("jeu") is-invalid @enderror id="mj_name" name="mj_name"
                    data-live-search="true">

                @foreach(App\Models\Jeu::all() as $jeu_select)
                    <option value="{{$jeu_select->nom}}">{{$jeu_select->nom}}</option>
                @endforeach
            </select>
            @error("jeu")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            <div>
                @error('jeu') <span class="error">{{ $message }}</span> @enderror
            </div>
            @enderror

        </div>

            @can('manage_tables_all')
                @foreach ($profiles as $profile)
                    @php
                        $profile->label = $profile->name;
                        $profile->value = $profile->name;
                    @endphp
                @endforeach
                <div class="form-group">

                    <Label>Inscrits </Label>
                    {{--                Ajouter le fait que les champs soit aligner.--}}
                    <div class="col-auto">
                        <x-virtual-select
                            wire:model="form.inscrits"
                            :options="[
                           'options' => $profiles ,
                           'selectedValue' => $form->inscrits,
                           'multiple' => true,
                           'showValueAsTags' => true,
                        ]"
                        />

                        <input type="text" wire:model="new_tw" wire:keydown.enter.prevent="addNewProfile()"/>
                        {{$new_tw}}
                        <a href="#" wire:click.prevent="addNewProfile()">Ajouter le TW </a>
                    </div>
                </div>
            @endcan

        <button class="btn btn-primary" type="submit" name="action" value="save">

            @if($table->id)
                Modifier
            @else
                Créer
            @endif
        </button>

            <span wire:loading>Saving...</span>
    </form>


</div>
