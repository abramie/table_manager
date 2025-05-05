<div>
    {{-- Recuperer via methode magique, a besoin de $table--}}
@if( !Auth::check()|| $table->mjs->id != Auth::user()?->mainUser->id)
    @php
        $ouverture_inscription =$table->creneaus->evenement->ouverture_inscription;
        $inscription_ouverte = $ouverture_inscription->isPast();
        $fermeture_inscription =$table->creneaus->evenement->fermeture_inscription;
        $inscription_fermee = $fermeture_inscription->isPast();
    @endphp
    @if(Auth::check() && $table->users->contains(Auth::user()->currentUser))
        <form action="{{route('events.one.creneau.table.desinscription',['evenement'=> $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table'=> $table ])}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-danger btn-lg" type="submit">Desinscription</button>
                </div>
            </div>
        </form>
    @else
        @if($inscription_ouverte && !$inscription_fermee && ($table->sans_table || $table->max_preinscription > $table->nb_inscrits()) && $table->nb_joueur_max > $table->nb_inscrits())

            <form action="{{route('events.one.creneau.table.inscription',['evenement'=> $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table'=> $table ])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-default" type="submit">Inscription à la table</button>
                    </div>
                </div>
            </form>
        @else
            <div class="input-group mb-3">
                <div class="input-group-append">
                    @php
                        if($inscription_fermee){
                            $error_button = "Les inscriptions en ligne sont fermée";
                        }
                        elseif(!$inscription_ouverte){
                           $error_button = "Inscription aux tables à partir du {$ouverture_inscription->toDateTimeString('minute')}";
                        }elseif(!$table->sans_table &&  $table->max_preinscription <= $table->nb_inscrits() ){
                            $error_button = "Ce creneau impose une limite au nombre de personnes pouvant s'inscrire via la platforme à une table.Cette limite est de :{$table->max_preinscription}";
                        }elseif($table->nb_joueur_max <=$table->nb_inscrits() ){
                            $error_button = "Cette table est complete";
                        }
                    @endphp

                    <button class="btn btn-outline-secondary btn-light" type="submit" disabled>{{$error_button}}</button>
                </div>
            </div>
        @endif
    @endif
@endif

</div>
