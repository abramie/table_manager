<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreneauRequest;
use App\Http\Requests\FormEventRequest;
use App\Models\Creneau;
use App\Models\Description;
use App\Models\Evenement;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class CreneauController extends Controller
{
    //


    public function index (Evenement $evenement, Creneau $creneau,  Request $request) {
        //return "test";

        return view('creneau.index_tables', [
            'creneau' => $creneau,
            'tables' => $creneau->tables()->with('tags', 'triggerwarnings')->orderByDesc("sans_table")->paginate(6),
            'evenement' => $evenement
        ]);
    }


    public function add(Evenement $evenement){
        $creneau = new Creneau();
        $creneau->nom = "le nom du creneau";
        $creneau->max_tables = $evenement->max_tables;
        $creneau->nb_inscription_online_max = $evenement->nb_inscription_online_max;
        $creneau->debut_creneau = $evenement->date_debut;
        $descriptions = Description::whereIn('name',  ['max_tables','nb_inscription_online_max' ])->get();
        //return "formulaire ajout d'evenement";
        return view('creneau.create', [
            'creneau' => $creneau,
            'evenement' => $evenement,
            'descriptions' => $descriptions,
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function store(Evenement $evenement,FormCreneauRequest $request){
        //dd($request);
        $validated = $request->validated();
        $creneau = Creneau::create($validated);
        if($validated["sans_table"]){
            $this->add_sans_table($creneau);
        }else{
            $this->remove_sans_table($creneau);
        }
        $evenement->creneaus()->save($creneau);

        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "Le creneau a bien été ajouté");
    }


    public function edit(Evenement $evenement,Creneau $creneau){

        $descriptions = Description::whereIn('name',  ['max_tables','nb_inscription_online_max','sans_table_toggle' ])->get();

        return view('creneau.edit', [
            'creneau' => $creneau,
            'descriptions' => $descriptions,
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function update(Evenement $evenement,Creneau $creneau,FormCreneauRequest $request){
        $validated = $request->validated();

        if($validated["sans_table"] != $creneau->sans_table){
            if($validated["sans_table"]){
                $this->add_sans_table($creneau,$request->input()['sans_table_name']);
            }else{
                $this->remove_sans_table($creneau);
            }
        }
        $creneau->update($validated);


        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "Le creneau a bien été modifier");
    }

    private function add_sans_table(Creneau $creneau, $nom = "sans-tables", $description ="S'inscrire ici pour annoncer sa venue, sans s'attacher à une table"){
        $creneau->tables()->create([
            "nom" => $nom,
            "description" => $description,
            "duree" => $creneau->duree,
            "nb_joueur_mini" => 0,
            "nb_joueur_max" => 50,
            "mj" => User::first()->id,
            "sans_table" => 1,
            "inscription_restrainte" => 0,
            "debut_table" => $creneau->debut_creneau,
        ]);

    }
    private function remove_sans_table(Creneau $creneau){
        $creneau->tables()->where("sans_table", "=","1")->delete();
    }

    public function delete(Evenement $evenement,Creneau $creneau){
        $creneau->delete();
        return redirect()->route('events.one.show', ['evenement' => $evenement])
            ->with('success', "Le creneau a bien été supprimé");
    }

    public function todo (Evenement $evenement, Creneau $creneau, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
