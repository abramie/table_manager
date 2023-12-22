<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreneauRequest;
use App\Http\Requests\FormEventRequest;
use App\Models\Creneau;
use App\Models\Evenement;
use Illuminate\Http\Request;

class CreneauController extends Controller
{
    //


    public function index (Evenement $evenement, Creneau $creneau,  Request $request) {
        //return "test";

        return view('creneau.index', [
            'creneau' => $creneau,
            'tables' => $creneau->tables()->paginate(2),
            'evenement' => $evenement
        ]);
        return [
            "page" => "creneau",
            "id_creneau" => $creneau->id,
            "name" => $creneau->nom
        ];
    }


    public function add(Evenement $evenement){
        $creneau = new Creneau();
        $creneau->nom = "le nom du creneau";
        $creneau->evenement_id = $evenement->id;
        //return "formulaire ajout d'evenement";
        return view('creneau.create', [
            'creneau' => $creneau
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function store(Evenement $evenement,FormCreneauRequest $request){
        //dd($request);
        $creneau = Creneau::create($request->validated());
        $evenement->creneaus()->save($creneau);

        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "Le creneau a bien été ajouté");
    }


    public function edit(Creneau $creneau){

        return view('creneau.edit', [
            'creneau' => $creneau
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function update(Evenement $evenement,Creneau $creneau,FormCreneauRequest $request){
        $creneau->update($request->validated());
        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "Le creneau a bien été modifier");
    }

    public function todo (Evenement $evenement, Creneau $creneau, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
