<?php

namespace App\Livewire;

use Livewire\Component;

class NouvelleTable extends Component
{
    public $table;
    public $descriptions;


    public $evenement;
    public $creneau;
    public $creneaux;
    public $triggerwarnings;
    public $tags;
    public $new_tag;
    public $new_tw;



    public $tw;

    public $test=0;
    public function render()
    {
        return view('livewire.nouvelle-table');
    }

    public function new_tw()
    {
        //$this->triggerwarnings->prepend(['id'=> 0, 'nom'=> 'test']);

        $this->test ++;
        dd('test');
    }
}
