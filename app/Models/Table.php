<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|mixed $nb_joueur_min
 * @property mixed|string $nom
 * @property int|mixed $nb_joueur_max
 * @property float|mixed $duree
 */
class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'duree',
        'description',
        'tw',
        'nb_joueur_min',
        'nb_joueur_max',
        'mj',
        'sans_table'
    ];

    public function creneaus(): BelongsTo {
        return $this->belongsTo(Creneau::class);
    }
    public function mjs(): BelongsTo{
        return $this->belongsTo(User::class, 'mj');
    }

    public function users() : BelongsToMany{
        return $this->belongsToMany(User::class, 'inscrits');
    }
    public function nb_inscrits() : int {
        return $this->users->count();
    }

    public function triggerwarnings(): BelongsToMany
    {
        return $this->belongsToMany(Triggerwarning::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
