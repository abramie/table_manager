<?php

namespace App\Livewire\Evenement;

use App\Models\Evenement;
use Livewire\Component;

class Form extends Component
{

    public $evenement;
    public $settings = [];

    public function mount(Evenement $evenement = new Evenement(), $settings){
        $this->evenement = $evenement;
        $this->settings = $settings;
    }
    public function render()
    {

        return view('livewire.evenement.form')->with(['evenement' => $this->evenement, "settings" => $this->settings]);
    }
}
