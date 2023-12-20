<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormEventRequest;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index(){
        return Evenement::with('creneaux')->limit(10)->get();
    }

    public function add(){
        $event = new Evenement();
        return "formulaire ajout d'evenement";
        return view('event.create', [
            'event' => $event
        ]);
    }

    public function edit(Evenement $event){
        return "formulaire edit d'evenement";
        return view('event.edit', [
            'event' => $event
        ]);
    }

    public function show(Evenement $event, Request $request){
        return $event;
    }

    /*
     * Sauvegarde un Evenement depuis un formulaire
     */
    public function store(FormEventRequest $request){
        $events = Evenement::create($request->validated());
        return redirect()->route('events.show', ['slug' => $events->slug])
            ->with('success', "L'evenement a bien été ajouté");
    }

    /*
     * Mise à jour des données d'un event
     */
    public function update(Evenement $event, FormEventRequest $request){
        $event->update($request->validated());
        return redirect()->route('events.show', ['slug' => $event->slug]);
    }
}
