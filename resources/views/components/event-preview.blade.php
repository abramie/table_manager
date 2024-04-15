<div class="card ">

    @php
        $creneaux_count = $evenement->creneaus()->count();
        $today = now();
        $date_affichage = $evenement->affichage_evenement;

        $affiche = $date_affichage->isPast();
        if($creneaux_count == 1){
            $route = route('events.one.creneau.tablesindex', ['evenement' => $evenement->slug, 'creneau' =>$evenement->creneaus->first()]);
        }else{
            $route = route('events.one.show', ['evenement' => $evenement->slug]);
        }
    @endphp


    @if( ($affiche && $creneaux_count>0) || auth()->user()?->can('ajout_events'))

        <div class="row align-items-start g-0">
            @php
                $date = $evenement->date_debut;
                 $showMinute = $date->minute >0 ? ($date->minute > 9 ?$date->minute  : '0' . $date->minute ) : '';
            @endphp
            @if($evenement->image)
                <div class="col-md-4">

                    <img src="{{asset("storage/images/".$evenement->image?->title)}}" alt="description" width="300"
                         height="250" class="img-thumbnail rounded-start"/>
                </div>
            @endif
            <div class="col-md-8">
                <h2 class="card-title"><a href="{{$route}}"> @if(!$affiche)
                        Previsionnel
                    @endif
                        @if($evenement->archivage)
                            (Archiver)
                        @endif
                        {{$evenement->nom_evenement}}</a></h2>

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
                        @if($evenement->archivage)
                            <button class="btn btn-xs btn-warning" type="button"
                                    onclick="window.location='{{ route("events.one.unarchive",['evenement'=> $evenement]) }}'">
                                Dé-Archive
                            </button>
                        @else
                            <button class="btn btn-xs btn-warning" type="button"
                                    onclick="window.location='{{ route("events.one.archive",['evenement'=> $evenement]) }}'">
                                Archive
                            </button>
                        @endif
                    </div>
                        {{--https://getbootstrap.com/docs/4.2/components/dropdowns/  Pour les boutons, voir split button --}}
                @endcan
                <h4 class="card-subtitle mb-2 text-body-secondary">{{$evenement->showDate()}} à partir de {{$date->hour}}h{{$showMinute}}</h4>

                <p class="card-text">
                    @if(strlen($evenement->description) < 100)
                        {{$evenement->description}}
                    @else
                        {{substr($evenement->description, 0,100) . "..." }}
                    @endif
                </p>

            </div>
        </div>
    @endif
</div>
