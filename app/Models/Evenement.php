<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_evenement',
        'slug'
    ];

    public function creneaus() : HasMany{
        return $this->hasMany(Creneau::class);
    }
}
