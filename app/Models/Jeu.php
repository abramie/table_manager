<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jeu extends Model
{
    protected $fillable = [
        'nom',
        'description'
    ];
    protected $table = 'jeux';
    public function tables() : HasMany{
        return $this->hasMany(Table::class);
    }
}
