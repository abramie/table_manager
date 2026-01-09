<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTable extends Model
{
    //

    protected $fillable = [
        'name','code', 'bs_class', 'indicateur_nom', 'afficher_public', 'inscription_possible'
    ];

}
