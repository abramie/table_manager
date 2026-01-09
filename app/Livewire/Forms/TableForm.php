<?php

namespace App\Livewire\Forms;

use App\Models\Jeu;
use App\Models\Profile;
use App\Models\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TableForm extends Form
{
    //
    public ?Table $table;

    public $mj; //Profile
    public $mj_name;
    #[Validate]
    public $nom;
    #[Validate(message: 'La description doit faire au moins dix caractères')]
    public $table_description;
    public $jeu;
    public $duree;
    public $debut_table;
    public $date_debut;
    public $max_preinscription;
    #[Validate]
    public $nb_joueur_max;
    #[Validate]
    public $nb_joueur_min;
    public $tags;

    public $inscrits;
    public float $max_duree = 0;

    public $tags_selected = [];
    public $triggerwarnings = [];
    public $type;
    public $creneau;
    public function setTable(Table $table)
    {
        $this->table = $table;
        $this->nb_joueur_max = $table->nb_joueur_max;
        $this->nb_joueur_min = $table->nb_joueur_min;
        $this->nom = $table->nom;
        $this->max_preinscription = $table->max_preinscription;
        $this->debut_table = Carbon::parse($table->debut_table)->format('H:i');
        $this->duree = $table->duree;
        $this->max_duree = floatval($this->creneau->duree);
        $this->inscrits = $table->inscrits()->pluck('name');
        $this->table_description = $table->description;

        $this->triggerwarnings = $table->triggerwarnings()->pluck('id')->toArray();
        $this->tags_selected = $table->tags->pluck('id')->toArray();

        $this->type = $table->types->pluck('id')->first();
    }

    public function update($name)
    {
        $this->validate();
        if($name == "inscrits" ){
            $this->table->inscrits()->sync($this->inscrits);
        }elseif ($name == "tags_selected" || $name == "triggerwarnings"){
            $tags = array_merge($this->tags_selected , $this->triggerwarnings, );
            if($this->type){
                $tags[] = $this->type;
            }

            $this->table->tags()->sync($tags);
        }elseif ($name == "jeu"){
            $this->table->jeu()->associate($this->jeu);

        }else{
            $this->table->update($this->only([$name]));
        }
//        $this->reset();
    }

    public function store(){
        if( $this->mj_name && \Auth::user()->can('manage_tables_all') ){
            $this->mj = Profile::get()->where('name', $this->mj_name)->first();
            if($this->mj == null){
                dump('error');
                throw ValidationException::withMessages([
                    'mj_name' => "Le Mj n'existe pas",

                ]);
            }
        }else {
            $this->mj = \Auth::user()->currentProfile;
        }



        $this->date_debut =  $this->debut_table ? $this->creneau->debut_creneau->setTimeFromTimeString($this->debut_table) : null;
Log::debug("on va valider");
        $this->validate();
        Log::debug("on a valider");
        $this->table->description = $this->table_description;
        $this->table->nb_joueur_min = $this->nb_joueur_min;
        $this->table->nb_joueur_max = $this->nb_joueur_max;
        $this->table->duree = $this->duree;
        $this->table->debut_table = $this->date_debut;
        $this->table->nom = $this->nom;
        $this->table->mj = $this->mj->id;
        $this->table->jeu_id = Jeu::where('nom', '=', $this->jeu)->first()?->id;
        $this->table->max_preinscription = $this->max_preinscription;
        $this->table->status_table_code = "PUB";
        //$this->creneau->tables()->save($this->table);
        $this->table->save();
        //En vrai pour les inscrits, ajouter une fonction, ça devrait pas marcher comme ça ...
        if($this->inscrits) {
            $inscrits_id = Profile::whereIn('name', $this->inscrits)->pluck('id')->toArray();
            $this->table->inscrits()->sync($inscrits_id);
        }

        $tags = array_merge($this->tags_selected , $this->triggerwarnings, );
        if($this->type){
            $tags[] = $this->type;
        }

        $this->table->tags()->sync($tags);
        $this->table->jeu()->associate($this->jeu);

        if($this->table->mjs == Auth::user()->currentProfile){
            $desincription = $this->creneau->desinscrit_user(Auth::user()->currentProfile);
        }else{
            $desincription = 0;
        }
        \Illuminate\Support\Facades\Log::debug("after desins");
        return $desincription;
        return 0;
    }

    public function rules(): array
    {


        //dd($this->request);
        return [
            //
            'nom' => ['required', 'min:4'],
            'duree' => ['regex:/^[0-9]+$/' , 'lte:max_duree'],
            'nb_joueur_min' => ['regex:/^[0-9]+$/', 'min:1' ],
            'nb_joueur_max' => ['regex:/^[0-9]+$/', 'min:1', 'gte:nb_joueur_min' ],
            'table_description' => ['min:4'],
            'tags_selected' => ['array'],
//            'tags_selected' => ['array', 'exists:tags,id'],
            'triggerwarnings' => ['array'],
            'type' => [],
            'mj' => ['required'],
            'date_debut' => ['required', 'date', 'after_or_equal:debut_creneau'],
            //'inscrits' => ['array', 'exists:profiles,id'],
            'max_preinscription' => ['required','regex:/^[0-9]+$/'],
            //Ajout verification clef etrangere que l'event existe bien ?
        ];

        //Ajout regle pour verification jeu https://www.youtube.com/watch?v=zy6ByXZ9DZ4&list=PLjwdMgw5TTLXz1GRhKxSWYyDHwVW-gqrm&index=12 vers 27 minutes
        //Ajout regle validation nombre de tables ? (qui serait redondant avec celle du controleur )
    }

    public function messages(): array
    {
        return [
            'table_description.min' => "La table doit avoir une description."
        ];
    }

    protected function validationAttributes()
    {
        return [
            'table_description' => 'description',
        ];
    }

}
