<?php

namespace App\Livewire\Evenement;

use App\Models\Evenement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ItemNotFoundException;
use Livewire\Component;
use Carbon\Carbon;
class Form extends Component
{

    public $evenement;

    public $settings = [];
    public $debut_evenement;
    public bool $toggle_affichage_evenement;
    public bool $toggle_fermeture_inscription;
    public bool $toggle_ouverture_inscription;
    public $affichage_evenement;
    public $fermeture_inscription;
    public $ouverture_inscription;
    public function mount(Evenement $evenement = new Evenement(), $settings){
        $this->evenement = $evenement;
        $this->settings = $settings;
        $this->debut_evenement = old('debut_evenement', $evenement->date_debut->format("d/m/Y H:i") );

        try{
            $this->affichage_evenement = old('affichage_evenement', Carbon::createFromFormat("d/m/Y H:i",$this->debut_evenement )->subDays($settings->where('name', 'visibiliter_avant_date')->firstOrFail()->value)->format("d/m/Y H:i") );
            $this->fermeture_inscription = old('fermeture_inscription', Carbon::createFromFormat("d/m/Y H:i",$this->debut_evenement )->subDays($settings->where('name', 'fermeture_inscriptions_avant_date')->firstOrFail()->value )->format("d/m/Y H:i"));
            $this->ouverture_inscription = old('ouverture_inscription', Carbon::createFromFormat("d/m/Y H:i",$this->debut_evenement )->subDays( $settings->where('name', 'ouverture_inscriptions_avant_date')->firstOrFail()->value )->format("d/m/Y H:i"));

        }catch (ItemNotFoundException $e)
        {
            Log::warning("Erreur recuperation settings ". $e);
        }
            }
    public function render()
    {

        return view('livewire.evenement.form')->with(['evenement' => $this->evenement, "settings" => $this->settings]);
    }
}
