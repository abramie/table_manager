<?php

namespace App\Livewire\Forms;

use App\Models\Jeu;
use App\Models\Profile;
use App\Models\Table;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TableForm extends Form
{
    //
    public ?Table $table;

    public $mj; //Profile
    public $titre;
    public $table_description;
    public $jeu;
    public $duree;
    public $debut_table;
    public $max_preinscription;
    public $nb_joueur_max;
    public $nb_joueur_min;

    public function setTable(Table $table)
    {
        $this->table = $table;

    }

    public function update($name)
    {
        $this->validate();

        $this->table->update($this->only([$name]));

        $this->reset();
    }

    public function store(){

        $this->validate();

        $this->table->descriptions = $this->table_description;
        $this->table->nb_joueur_min = $this->nb_joueur_min;
        $this->table->nb_joueur_max = $this->nb_joueur_max;
        $this->table->duree = $this->duree;
        $this->table->debut_table = $this->debut_table;
        $this->table->nom = $this->titre;
        $this->table->mj = Profile::where('name', '=', $this->mj)->first()->id;
        $this->table->jeu = Jeu::where('nom', '=', $this->mj)->first()->id;

        $this->table->save();
    }

    public function rules(): array
    {
        //Ignore la validation si l'action n'est pas de sauvegarder les données (quand je veux conserver le form en changeant de fenetre.
        if($this->action != 'save'){
            return [];
        }
        //dd($this->request);
        return [
            //
            'nom' => ['required', 'min:4'],
            'duree' => ['regex:/^[0-9]+$/' , 'lte:max_duree'],
            'nb_joueur_min' => ['regex:/^[0-9]+$/' ],
            'nb_joueur_max' => ['regex:/^[0-9]+$/' ],
            'description' => ['min:4'],
            'tags' => ['array', 'exists:tags,id'],
            'triggerwarnings' => ['array', 'exists:triggerwarnings,id'],
            'mj' => ['required'],
            'debut_table' => ['required', 'date', 'after_or_equal:debut_creneau'],
            'inscrits' => ['array', 'exists:profiles,id'],
            'nom_jeu' => [''],
            'description_jeu' => [''],
            'max_preinscription' => ['required','regex:/^[0-9]+$/'],
            //Ajout verification clef etrangere que l'event existe bien ?
        ];

        //Ajout regle pour verification jeu https://www.youtube.com/watch?v=zy6ByXZ9DZ4&list=PLjwdMgw5TTLXz1GRhKxSWYyDHwVW-gqrm&index=12 vers 27 minutes
        //Ajout regle validation nombre de tables ? (qui serait redondant avec celle du controleur )
    }

}
