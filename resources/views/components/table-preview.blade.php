<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    @php
        $isSansTable = $table->sans_table == 1;
    @endphp
    <div>
        <h2>
            <a href="{{route('events.one.creneau.table.show', ['evenement' => $table->creneaus->evenement->slug, 'creneau' => $table->creneaus, 'table' => $table])}}">{{$table->nom}}</a>
        </h2>
        @if(!$isSansTable)
            <span>MJ : {{$table->mjs->name}}</span>
            @if(!$table->tags->isEmpty())
                Tags :
                @foreach($table->tags as $tag )
                    <span class="badge bg-secondary">{{$tag->nom}}</span>
                @endforeach

            @endif

            @if(!$table->triggerwarnings->isEmpty())
                TW :
                @foreach($table->triggerwarnings as $tw )
                    <span class="badge bg-secondary">{{$tw->nom}}</span>
                @endforeach

            @endif
        @endif
        <span>Inscrits : {{$table->nb_inscrits()}} @if(!$isSansTable)
                / {{$table->nb_joueur_max}}
            @endif</span>

        @if($showDate)
            <div>
                {{$table->creneaus->debut_creneau->toDateString()}}
                {{$table->debut_table->toTimeString($unitPrecision ='minute')}}
            </div>
        @endif
    </div>
    <div>
        <p>
            @if(strlen($table->description) < 1000)
                {{$table->description}}
            @else
                {{substr($table->description, 0,1000) . "..." }}
            @endif
        </p>
    </div>

</div>
