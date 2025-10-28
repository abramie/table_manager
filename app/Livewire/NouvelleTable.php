<?php

namespace App\Livewire;

use App\Livewire\Forms\TableForm;
use App\Models\Jeu;
use App\Models\Profile;
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
    public $tags;
    public $new_tag;
    public $new_tw;

    //Attributs form
    public $mj; //Profile
    public $titre;
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
        $this->titre = "Nom de la table ";
        $this->mj = $table->mj?->name ?? Auth::user()->mainProfile->name;
        $this->creneaux = $creneau;
        $this->debut_table = $table->debut_table ?? Carbon::parse($creneau->debut_creneau)->format('H:i');
        $this->jeu = Jeu::get()->first()->nom;

        $this->form->setTable($table);
//        $this->debut_table = Carbon::now();
    }
    public function render()
    {
        return view('livewire.nouvelle-table');
    }

    public function updated($name, $value)
    {
        $this->form->update($name);
    }


    public function save(){
        //Créer la table and everything

    }
    public function new_tw()
    {
        //$this->triggerwarnings->prepend(['id'=> 0, 'nom'=> 'test']);

        $this->test ++;
        dd('test');
    }
}
