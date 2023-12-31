<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTableRequest;
use App\Http\Requests\InscriptionTableRequest;
use App\Models\Creneau;
use App\Models\Description;
use App\Models\Evenement;
use App\Models\Settings;
use App\Models\Table;
use App\Models\Tag;
use App\Models\Triggerwarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    //
    public function show(Evenement $evenement, Creneau $creneau, Table $table, Request $request) {

        return view('table.show', [
            'table' => $table,
            'creneau' => $creneau,
            'evenement' => $evenement
        ]);

    }

    public function add(Evenement $evenement,Creneau $creneau){

        //Ajouter une regle qui verifie que le nombre de table ne depasse pas le maximum
        $table = new Table();
        $table->nom = "le nom de la table";
        $table->nb_joueur_min = 3;
        $table->nb_joueur_max = 3;
        $table->duree = $creneau->duree;

        $descriptions = Description::whereIn('name',  ['trigger_warnings' ])->get();
        //return "formulaire ajout d'evenement";
        return view('table.create', [
            'table' => $table,
            'evenement' => $evenement,
            'creneau' => $creneau,
            'creneaux' => Creneau::get(),
            'triggerwarnings' => Triggerwarning::select('id', 'nom')->get(),
            'tags' => Tag::select('id', 'nom')->get(),
            'descriptions' => $descriptions
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function store(Evenement $evenement,Creneau $creneau, FormTableRequest $request){
        if($request->get('action') != 'save'){
            return $this->redirect_action($request);
        }

        $table = Table::create($request->validated());
        $creneau->tables()->save($table);
        $table->triggerwarnings()->sync($request->validated('triggerwarnings'));

        $table->tags()->sync($request->validated('tags'));
        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "La table a bien été ajouté");
    }


    public function edit(Evenement $evenement,Creneau $creneau,Table $table){
        $descriptions = Description::whereIn('name',  ['trigger_warnings' ])->get();
        if(session()->has('saved_table_input') ){
            session()->flash('_old_input', session("saved_table_input"));
            session()->forget('saved_table_input');
            //Ajout suppression de la valeur de session
        }
        $links =  [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session

        return view('table.edit', [
            'table' => $table,
            'evenement' => $evenement,
            'creneau' => $creneau,
            'creneaux' => Creneau::get(),
            'triggerwarnings' => Triggerwarning::select('id', 'nom')->get(),
            'tags' => Tag::select('id', 'nom')->get(),
            'descriptions' => $descriptions
        ]);
    }

    /*
     * Sauvegarde un Creneau depuis un formulaire
     */
    public function update(Evenement $evenement,Creneau $creneau,Table $table,FormTableRequest $request){

        if($request->get('action') != 'save'){
            return $this->redirect_action($request);
        }


        $table->update($request->validated());
        $table->triggerwarnings()->sync($request->validated('triggerwarnings'));
        $table->tags()->sync($request->validated('tags'));
        return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau,'table'=> $table])
            ->with('success', "Le table a bien été modifier");
        //return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau->id,'table'=> $table])->with('success', "Le table a bien été modifier");
    }

    private function redirect_action(FormTableRequest $request){
        if($request->get('action') == 'add_tag'){
            return redirect()->route('tags.add')->withInput();
        }
        if($request->get('action') == 'add_tw'){
            return redirect()->route('tw.add')->withInput();
        }
    }

    public function inscription_table(Evenement $evenement,Creneau $creneau,Table $table, InscriptionTableRequest $request){
        //Do the attach
        if($table->users->contains(Auth::user())){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Vous etes deja inscrit sur la table ");
        }
        elseif($table->users->count() < $table->nb_joueur_max){
            $table->users()->attach(Auth::user());
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('success', "Inscription validée sur la table \"".$table->nom);
        }else{
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "La table n'a plus de place ");
        }


    }
    public function desinscription_table(Evenement $evenement,Creneau $creneau,Table $table, InscriptionTableRequest $request){
        //Do the attach

        $table->users()->detach(Auth::user());

        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
            ->with('succes', "Vous vous etes bien desinscrit de la table : ".$table->nom);



    }
    public function todo (Evenement $evenement, Creneau $creneau, Table $table, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
