<?php

namespace App\Livewire;

use App\Livewire\Forms\TableForm;
use App\Models\Jeu;
use App\Models\Log;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\Triggerwarning;
use App\Models\types\TypeInscription;
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
    public $old_tags = [];
    public $new_tag;
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
        $tws = Tag::where('tags.type_tag_code', '=', 'TW')->get();
        $types = Tag::where('tags.type_tag_code', '=', 'TYPE')->get();
        $profiles = Profile::get();
        $type_inscriptions = TypeInscription::get();
        return view('livewire.nouvelle-table')->with(['tags'=> $tags,'tws'=>$tws, 'types' => $types, "profiles" => $profiles, "type_inscriptions" => $type_inscriptions]);
    }

    public function updated($name, $value)
    {
       $this->form->update($name);
    }

    public function addNewTag(){

        $newTag = $this->pull('new_tag');
        if($newTag){
            if($tag = Tag::where('name', $newTag)->first()){
                //Message tag existe
                $this->form->tags_selected[] = $tag->id;
            }else{
                $tag = Tag::create(['name' => $newTag, 'type_tag_code' => 'BASE']);
                Log::log(profile: Auth::user()->currentProfile,code: "TAG-ADD", objet: $tag);
                $this->form->tags_selected[] = $tag->id;

            }
        }else{
            //Message erreur
        }


    }

    public function addNewTw(){

        $newTag = $this->pull('new_tw');

        if($newTag){
            if($tag = Tag::where('name', $newTag)->first()){
                //Message tag existe
                $this->form->triggerwarnings[] = $tag->id;
            }else{
                $tag = Tag::create(['name' => $newTag, 'type_tag_code' => 'TW']);
                Log::log(profile: Auth::user()->currentProfile,code: "TAG-ADD", objet: $tag);
                $this->form->triggerwarnings[] = $tag->id;

            }
        }else{
            //Message erreur
        }


    }

    public function addNewProfile(){

        $new_profile = $this->pull('new_profile');
        if($new_profile){
            if($profile = Profile::where('nom', $new_profile)->first()){
                //Message tag existe
                $this->form->inscrits[] = $profile->id;
            }else{
                $profile = Profile::create(['name' => $new_profile]);
                Log::log(profile: Auth::user()->currentProfile,code: "PROF-ADD", objet: $profile);
                $this->form->inscrits[] = $profile->id;

            }
        }else{
            //Message erreur
        }


    }


    public function save(){
        //Créer la table and everything
        $desincription = $this->form->store();
        \Illuminate\Support\Facades\Log::debug("after store");

        return redirect()->route('events.one.creneau.tablesindex', ['evenement' => $this->form->table->creneau->evenement,'creneau' => $this->form->table->creneau])
            ->with('success', "La table a bien été ajouté." . ($desincription>0 ? "Et vous avez était desinscrit de vos tables" : "" ));
    }

}
