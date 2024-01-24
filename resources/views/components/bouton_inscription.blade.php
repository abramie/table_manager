<div>
    {{-- Recuperer via methode magique, a besoin de $table--}}
@if( !Auth::check()|| $table->mjs->id != Auth::user()?->id)
    @php
        $ouverture_inscription =$table->creneaus->evenement->ouverture_inscription;
        $inscription_ouverte = $ouverture_inscription->isPast();
        $fermeture_inscription =$table->creneaus->evenement->fermeture_inscription;
        $inscription_fermee = $fermeture_inscription->isPast();
    @endphp
    @if(Auth::check() && $table->users->contains(Auth::user()))
        <form action="{{route('events.one.creneau.table.desinscription',['evenement'=> $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table'=> $table ])}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-danger" type="submit">Desinscription</button>
                </div>
            </div>
        </form>
    @else
        @if($inscription_ouverte && !$inscription_fermee && ($table->sans_table || $table->creneaus->nb_inscription_online_max > $table->nb_inscrits()) && $table->nb_joueur_max > $table->nb_inscrits())

            <form action="{{route('events.one.creneau.table.inscription',['evenement'=> $table->creneaus->evenement, 'creneau' => $table->creneaus, 'table'=> $table ])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-light" type="submit">Inscription à la table</button>
                    </div>
                </div>
            </form>
        @else
            <div class="input-group mb-3">
                <div class="input-group-append">
                    @if($inscription_fermee)
                        <button class="btn btn-outline-secondary btn-light" type="submit" disabled>Les inscriptions en ligne sont fermée</button>

                    @elseif(!$inscription_ouverte)
                        <button class="btn btn-outline-secondary btn-light" type="submit" disabled>Inscription aux tables à partir du {{$ouverture_inscription->toDateTimeString('minute')}}</button>
                    @elseif(!$table->sans_table &&  $table->creneaus->nb_inscription_online_max <= $table->nb_inscrits() )
                        <button class="btn btn-outline-secondary btn-light" type="submit" disabled>Ce creneau impose une limite au nombre de personnes pouvant s'inscrire via la platforme à une table.Cette limite est de :
                            {{$table->creneaus->nb_inscription_online_max}} </button>
                    @elseif($table->nb_joueur_max <=$table->nb_inscrits() )
                        <button class="btn btn-outline-secondary btn-light" type="submit" disabled>Cette table est complete</button>

                    @endif

                </div>
            </div>
        @endif
    @endif
@endif

</div>
