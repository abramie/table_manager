<?php

namespace App\Livewire\Evenement;

use App\Models\Evenement;
use Livewire\Component;
use Carbon\Carbon;
class Form extends Component
{

    public $evenement;
    public $settings = [];
    public $debut_evenement;
    public $affichage_evenement;
    public function mount(Evenement $evenement = new Evenement(), $settings){
        $this->evenement = $evenement;
        $this->settings = $settings;
        $this->debut_evenement = old('affichage_evenement', Carbon::now()->format('d/m/Y H:i'));
    }
    public function render()
    {

        return view('livewire.evenement.form')->with(['evenement' => $this->evenement, "settings" => $this->settings]);
    }
}
