<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormEventRequest;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\Pagination\Paginator;
class EventController extends Controller
{
    //
    public function index() : View{
        //dd(Evenement::paginate(3));
        return view('evenement.index', [
            'evenements' => Evenement::paginate(5)
        ]);
        return Evenement::with('creneaux')->limit(10)->get();
    }

    public function add(){
        $evenement = new Evenement();
        $evenement->nom_evenement = "le nom de l'evenement";
        //return "formulaire ajout d'evenement";
        return view('evenement.create', [
            'evenement' => $evenement
        ]);
    }

    public function edit(Evenement $evenement){
        //return "formulaire edit d'evenement";

        return view('evenement.edit', [
            'evenement' => $evenement
        ]);
    }

    public function show(Evenement $evenement, Request $request){
        return view('evenement.show', [
            'evenement' => $evenement
        ]);;
    }

    /*
     * Sauvegarde un Evenement depuis un formulaire
     */
    public function store(FormEventRequest $request){
        $events = Evenement::create($request->validated());

        return redirect()->route('events.one.show', ['evenement' => $events->slug])
            ->with('success', "L'evenement a bien été ajouté");
    }

    /*
     * Mise à jour des données d'un event
     */
    public function update(Evenement $evenement, FormEventRequest $request){
//dd("test");
        $evenement->update($request->validated());
        return redirect()->route('events.one.show', ['evenement' => $evenement->slug])
            ->with('success', "L'evenement a bien été editer");
    }
}
