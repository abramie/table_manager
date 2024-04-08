<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int|mixed $nb_joueur_min
 * @property mixed|string $nom
 * @property int|mixed $nb_joueur_max
 * @property float|mixed $duree
 * @method static find(\Illuminate\Routing\Route|object|string|null $route)
 */
class Table extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nom',
        'duree',
        'description',
        'tw',
        'nb_joueur_min',
        'nb_joueur_max',
        'mj',
        'sans_table',
        'debut_table',
        'inscription_restrainte'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'debut_table' => 'datetime:Y-m-d',
        'sans_table' => 'boolean',
    ];

    public function creneaus(): BelongsTo {
        return $this->belongsTo(Creneau::class, 'creneau_id');
    }

    public function jeu(): BelongsTo {
        return $this->belongsTo(Jeu::class, 'jeu_id');
    }
    public function mjs(): BelongsTo{
        return $this->belongsTo(User::class, 'mj');
    }

    public function users() : BelongsToMany{
        return $this->belongsToMany(User::class, 'inscrits');
    }

    /**
     * @return int
     */
    public function nb_inscrits() : int {
        return $this->users->count();
    }

    public function triggerwarnings(): BelongsToMany
    {
        return $this->belongsToMany(Triggerwarning::class);
    }

    public function tags(): MorphToMany
    {
        //return $this->belongsToMany(Tag::class);
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
