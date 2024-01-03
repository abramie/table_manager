<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreneauRequest;
use App\Http\Requests\FormEventRequest;
use App\Models\Creneau;
use App\Models\Evenement;
use App\Models\Settings;
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
        $creneau->max_tables = $evenement->max_tables;
        $creneau->nb_inscription_online_max = $evenement->nb_inscription_online_max;
        $settings = Settings::whereIn('name',  ['max_tables','nb_inscription_online_max' ])->get();
        //return "formulaire ajout d'evenement";
        return view('creneau.create', [
            'creneau' => $creneau,
            'evenement' => $evenement,
            'settings' => $settings
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


    public function edit(Evenement $evenement,Creneau $creneau){

        $settings = Settings::whereIn('name',  ['max_tables','nb_inscription_online_max' ])->get();
        return view('creneau.edit', [
            'creneau' => $creneau,
            'settings' => $settings
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

    public function delete(Evenement $evenement,Creneau $creneau){
        $creneau->delete();
        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "Le creneau a bien été supprimé");
    }

    public function todo (Evenement $evenement, Creneau $creneau, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
