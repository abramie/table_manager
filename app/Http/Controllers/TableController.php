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
use App\Models\User;
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
        $table->debut_table = $creneau->debut_creneau;
        if(session()->has('saved_table_input') ){
            session()->flash('_old_input', session("saved_table_input"));
            session()->forget('saved_table_input');
            //Ajout suppression de la valeur de session
        }
        $descriptions = Description::whereIn('name',  ['trigger_warnings' ])->get();

        //Quand un tag ou un tw est ajouter pendant le process de creation d'une table, il est automatiquement ajouter à la table
        $new_tag = $new_tw = null;
        if(session()->has('new_tag') ){
            $new_tag = session('new_tw');
            session()->forget('new_tag');
            //Ajout suppression de la valeur de session
        }
        if(session()->has('new_tw') ){
            $new_tw = session('new_tw');
            session()->forget('new_tw');
            //Ajout suppression de la valeur de session
        }
        //return "formulaire ajout d'evenement";
        return view('table.create', [
            'table' => $table,
            'evenement' => $evenement,
            'creneau' => $creneau,
            'creneaux' => Creneau::get(),
            'triggerwarnings' => Triggerwarning::select('id', 'nom')->get(),
            'tags' => Tag::select('id', 'nom')->get(),
            'new_tag' => $new_tag ,
            'new_tw' => $new_tw ,
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
        $table->users()->sync($request->validated('inscrits'));
        //Desinscrit le mj de toute les tables où il est inscrit si il ouvre une table.
        if($request->validated('mj') == Auth::user()->id){
            $desincription = $creneau->desinscrit_user(Auth::user());
        }else{
            $desincription = 0;
        }


        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
            ->with('success', "La table a bien été ajouté." . ($desincription>0 ? "Et vous avez était desinscrit de vos tables" : "" ));
    }


    public function edit(Evenement $evenement,Creneau $creneau,Table $table){

        if(!(auth()->user() && (auth()->user()?->can('manage_tables_all') ||
                (auth()->user()?->can('manage_tables_own')&&  $table->mjs->name ==auth()->user()->name)))){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau->id])
                ->with('echec', "Vous n'avez pas l'autorisation de modifier cette table");
        }
        $descriptions = Description::whereIn('name',  ['trigger_warnings' ])->get();
        if(session()->has('saved_table_input') ){
            session()->flash('_old_input', session("saved_table_input"));
            session()->forget('saved_table_input');
            //Ajout suppression de la valeur de session
        }
        $links =  [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        $new_tag = $new_tw = null;
        if(session()->has('new_tag') ){
            $new_tag = session('new_tw');
            session()->forget('new_tag');
            //Ajout suppression de la valeur de session
        }
        if(session()->has('new_tw') ){
            $new_tw = session('new_tw');
            session()->forget('new_tw');
            //Ajout suppression de la valeur de session
        }

        return view('table.edit', [
            'table' => $table,
            'evenement' => $evenement,
            'creneau' => $creneau,
            'creneaux' => Creneau::get(),
            'triggerwarnings' => Triggerwarning::select('id', 'nom')->get(),
            'tags' => Tag::select('id', 'nom')->get(),
            'new_tag' => $new_tag ,
            'new_tw' => $new_tw ,
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


        if($request->validated('inscrits'))
            $table->users()->sync($request->validated('inscrits'));



        return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau,'table'=> $table])
            ->with('success', "Le table a bien été modifier");
        //return redirect()->route('events.one.creneau.table.show', ['evenement' => $evenement,'creneau' => $creneau->id,'table'=> $table])->with('success', "Le table a bien été modifier");
    }

    public function delete(Evenement $evenement,Creneau $creneau,Table $table){
        if(!(auth()->user() && (auth()->user()?->can('manage_tables_all') ||
                (auth()->user()?->can('manage_tables_own')&&  $table->mjs->name ==auth()->user()->name)))){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Vous n'avez pas l'autorisation de modifier cette table");
        }
        $table->delete();
        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
            ->with('success', "La table a bien été supprimé");
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

        //dd($table->users);
        //Verifie dans le creneau de la table si l'utilisateur est inscrit sur une des tables existante, à l'exception de la table "sans table"
        if(($table->sans_table && $table->users->contains(Auth::user()))
            || $creneau->tables()->with('users')->where("sans_table", "=","0")->get()->pluck('users')->flatten()->contains('id',Auth::user()->id)){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Vous etes deja inscrit sur une table ");
        }elseif($table->sans_table){
            $table->users()->attach(Auth::user());
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('success', "Inscription en \"".$table->nom);
        }elseif($table->mjs == Auth::user()){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Tu ne peut pas t'inscrire sur ta propre table, comment tu es arrivé là ??? ");
        }
        //Ne marche pas, à corriger
        elseif($creneau->tables()->with('mjs')->get()->pluck('mjs')->flatten()->contains('id',Auth::user()->id)){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Tu es MJ sur ce creneau, tu ne peux pas t'inscrire");
        }
        elseif(!$table->sans_table && $table->users->count() > $creneau->nb_inscription_online_max){
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "Ce creneau impose une limite au nombre de personnes pouvant s'inscrire via la platforme à une table.Cette limite est de : ".$creneau->nb_inscription_online_max );
        }
        elseif($table->users->count() < $table->nb_joueur_max){
            $table->users()->attach(Auth::user());
            $creneau->tables()->where("sans_table", "=","1")->get()->first()?->users()->detach(Auth::user());
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('success', "Inscription validée sur la table \"".$table->nom);
        }else{
            return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $evenement,'creneau' => $creneau])
                ->with('echec', "La table n'a plus de place ");
        }


    }
    public function desinscription_table(Evenement $evenement,Creneau $creneau,Table $table,User $user = null, InscriptionTableRequest $request){
        //Do the attach

        if($user->getConnectionName() ==null){
            $user = Auth::user();
            $success_message = "Vous vous etes bien desinscrit de la table : ".$table->nom;
        }else{
            $success_message = "L'utilisateur {$user->name} a bien été desinscrit de la table : ".$table->nom;

        }

        $table->users()->detach($user);

        return redirect()->back()
            ->with('success', $success_message);



    }

    public function todo (Evenement $evenement, Creneau $creneau, Table $table, Request $request){
        return view('todo', [
            'evenement' => $evenement,
            'creneau' => $creneau
        ]);
    }
}
