<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NouvelleTable extends Component
{
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
        $this->mj = $table->mj ?? Auth::user()->mainProfile;
        $this->creneaux = $creneau;
        $this->debut_table = $table->debut_table ?? Carbon::parse($creneau->debut_creneau)->format('H:i');

//        $this->debut_table = Carbon::now();
    }
    public function render()
    {
        return view('livewire.nouvelle-table');
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
