<div>
    {{-- Recuperer via methode magique, a besoin de $table--}}
    @if( !Auth::check()|| $table->mjs->id != Auth::user()?->currentProfile->id)
        @php
            $ouverture_inscription =$table->creneaus->evenement->ouverture_inscription;
            $inscription_ouverte = $ouverture_inscription->isPast();
            $fermeture_inscription =$table->creneaus->evenement->fermeture_inscription;
            $inscription_fermee = $fermeture_inscription->isPast();
        @endphp
        @if(Auth::check() && $table->inscrits->contains(Auth::user()->currentProfile))
            <form
                action="{{route('events.one.creneau.table.desinscription',['evenement'=> $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table'=> $table ])}}"
                method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-danger btn-lg" type="submit">Desinscription
                        </button>
                    </div>
                </div>
            </form>
        @else
            @php
                $status_inscription = $table->creneaus->peutInscrire(Auth::user()?->currentProfile, $table);
                $message_button = match($status_inscription){
                    1 => "Inscription à la table",

                    -1 => "Les inscriptions en ligne sont fermée",
                    -2 => "Inscription aux tables à partir du {$ouverture_inscription->toDateTimeString('minute')}",
                    -3 => "Ce creneau impose une limite au nombre de personnes pouvant s'inscrire via la platforme à une table.Cette limite est de :{$table->max_preinscription}",
                    -4 => "Cette table est complete",
                };
            @endphp
            @if( $status_inscription > 0 )

                <form
                    action="{{route('events.one.creneau.table.inscription',['evenement'=> $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table'=> $table ])}}"
                    method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-default" type="submit">
                                {{$message_button}}

                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-light" type="submit"
                                disabled>{{$message_button}}
                        </button>
                    </div>
                </div>
            @endif
        @endif
    @endif

</div>
