<div class="card ">

    @php
        $creneaux_count = $evenement->creneaus()->count();
        $today = now();
        $date_affichage = $evenement->affichage_evenement;

        $affiche = $date_affichage->isPast();

    @endphp
    @if( ($affiche && $creneaux_count>0) || auth()->user()?->can('ajout_events'))

        <div class="row align-items-start g-0">
            @php
                $date = $evenement->date_debut;

            @endphp
            @if($evenement->image)
                <div class="col-md-4">

                    <img src="{{asset("storage/images/".$evenement->image?->title)}}" alt="description" width="300"
                         height="250" class="img-thumbnail rounded-start"/>
                </div>
            @endif
            <div class="col-md-8">
                <h2 class="card-title">@if(!$affiche)
                        Previsionnel
                    @endif{{$evenement->nom_evenement}}</h2>

                @can('ajout_events')
                    <div class="pull-right">
                        <button class="btn btn-xs btn-danger " type="button"
                                onclick="window.location='{{ route("events.one.delete",['evenement'=> $evenement]) }}'">
                            Delete
                        </button>
                        <button class="btn btn-xs btn-warning" type="button"
                                onclick="window.location='{{ route("events.one.edit",['evenement'=> $evenement]) }}'">
                            Edit
                        </button>
                    </div>
                        {{--https://getbootstrap.com/docs/4.2/components/dropdowns/  Pour les boutons, voir split button --}}
                @endcan
                <h4 class="card-subtitle mb-2 text-body-secondary">{{$evenement->showDate()}} à partir de {{$date->hour}}h</h4>

                <p class="card-text">
                    @if(strlen($evenement->description) < 100)
                        {{$evenement->description}}
                    @else
                        {{substr($evenement->description, 0,100) . "..." }}
                    @endif
                </p>
                <p class="card-text">
                    @if($creneaux_count == 1)
                        <a href="{{route('events.one.creneau.tablesindex', ['evenement' => $evenement->slug, 'creneau' =>$evenement->creneaus->first()])}}">Liste
                            des tables</a>
                    @else
                        <a href="{{route('events.one.show', ['evenement' => $evenement->slug])}}">Liste des creneaux</a>

                    @endif

                </p>

            </div>
        </div>
    @endif
</div>
