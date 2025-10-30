<?php

namespace App\Livewire;

use App\Livewire\Forms\TableForm;
use App\Models\Jeu;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NouvelleTable extends Component
{

    public TableForm $form;
    public $table;
    public $descriptions;


    public $evenement;
    public $creneau;
    public $creneaux;
    public $triggerwarnings = [];
    public $tags_selected = [];
    public $newTag;
    public $new_tw;

    //Attributs form
    public $mj; //Profile
    public $nom;
    public $table_description;
    public $jeu;
    public $duree;
    public $debut_table;
    public $max_preinscription;
    public $nb_joueur_max;
    public $nb_joueur_min;
    public $tw;

    public $test=0;

    public function mount($table, $creneau){
        $this->table = $table;
        $this->form->mj_name = $table->mj?->name ?? Auth::user()->mainProfile->name;
        $this->jeu = Jeu::get()->first()->nom;
        $this->form->creneau = $creneau;
        $this->form->setTable($this->table);
//        $this->debut_table = Carbon::now();
    }
    public function render()
    {
        $tags = Tag::query()->get();
        return view('livewire.nouvelle-table')->with('tags', $tags);
    }

    public function updated($name, $value)
    {
       // $this->form->update($name);
    }

    public function addNewTag(){

        $newTag = $this->pull('newTag');

        if(Tag::where('nom', $newTag)->exists()){
            //Message tag existe
        }else{
            Tag::create(['nom' => $newTag]);
        }

    }


    public function save(){
        //Créer la table and everything
        $this->form->store();
        if($this->form->table->mjs == Auth::user()->currentProfile){
            $desincription = $this->form->table->creneaus->desinscrit_user(Auth::user()->currentProfile);
        }else{
            $desincription = 0;
        }
        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $this->form->table->creneaus->evenement,'creneau' => $this->form->table->creneaus])
            ->with('success', "La table a bien été ajouté." . ($desincription>0 ? "Et vous avez était desinscrit de vos tables" : "" ));
    }
    public function new_tw()
    {
        //$this->triggerwarnings->prepend(['id'=> 0, 'nom'=> 'test']);

        $this->test ++;
        dd('test');
    }
}
