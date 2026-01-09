<div class="card">
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    @php
        $isSansTable = $table->sans_table == 1;
    @endphp

    <div class="card-body">
        <h3 class="card-title">
            <a href="{{route('events.one.creneau.table.show', ['evenement' => $table->creneaus->evenement->slug, 'creneau' => $table->creneaus, 'table' => $table])}}">{{$table->nom}}</a>
        </h3>
        <div class="row align-items-start">


            <div class="col">
                @if(!$isSansTable)
                    <h5 class="card-subtitle mb-2 text-body-secondary">MJ : {{$table->mjs->name}}
                        @if($showDate)
                        {{$table->creneaus->debut_creneau->toDateString()}}
                        {{$table->debut_table->toTimeString($unitPrecision ='minute')}}
                        @endif
                    </h5>
                    @if($table->jeu)
                        Jeu : {{$table->jeu?->nom}}
                    @endif

                    @if(!$table->tags->isEmpty())
                        <p>
                            @foreach($table->tags as $tag )
                                <span title="" class="{{$tag->typeTag->bs_class}}">{{$tag->name}}</span>
                            @endforeach
                        </p>
                    @endif



                <p class="card-text">
                    @if(strlen($table->description) < 1000)
                        {{$table->description}}
                    @else
                        {{substr($table->description, 0,1000) . "..." }}
                    @endif
                </p>
            </div>
            <div class="col">
                <a class="btn btn-link bt-xs" data-bs-toggle="collapse" href="#collapseListInscrits{{$table->id}}"
                   role="button" aria-expanded="false" aria-controls="collapseListInscrits{{$table->id}}">
                    Inscrits : {{$table->nb_inscrits()}}
                    @if(!$isSansTable)
                        / {{$table->nb_joueur_max}}
                    @endif
                    ⬇️
                </a>
                <div class="collapse" id="collapseListInscrits{{$table->id}}">
                    <div class="d-flex flex-wrap">
                        @foreach($table->inscriptionsPrenantUnePlaces as $inscrit)
                            <div class="p-2 px-3 border border-solid border-zinc-950 m-1 {{$inscrit->type_inscription?->bs_class}}">
                                {{$inscrit->profile->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>




        </div>
        <x-bouton_inscription :table="$table"/>
    </div>


</div>
