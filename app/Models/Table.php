<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'duree',
        'Description',
        'tw',
        'nb_joueur_min',
        'nb_joueur_max'
    ];

    public function creneaus(): BelongsTo {
        return $this->belongsTo(Creneau::class);
    }
}
