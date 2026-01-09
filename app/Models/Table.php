<?php

namespace App\Models;

use App\Casts\TimeCast;
use App\Models\types\TypeInscription;
use App\Models\types\TypeTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int|mixed $nb_joueur_min
 * @property mixed|string $nom
 * @property int|mixed $nb_joueur_max
 * @property float|mixed $duree
 * @property string $status : plusieurs valeurs : {published, unpublished}
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
        'inscription_restrainte',
        'max_preinscription',
        'open_preinscription',
        'status'
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
    public function creneau(): BelongsTo {
        return $this->belongsTo(Creneau::class, 'creneau_id');
    }

    public function jeu(): BelongsTo {
        return $this->belongsTo(Jeu::class, 'jeu_id');
    }
    public function mjs(): BelongsTo{
        return $this->belongsTo(Profile::class, 'mj');
    }

    public function inscrits() : BelongsToMany{
        return $this->belongsToMany(Profile::class, 'inscrits')->withPivot('type_inscription_id');
    }

    public function inscritsPrenantUnePlace() : BelongsToMany{
        return $this->inscrits()->join('type_inscriptions', 'type_inscriptions.id', '=', 'inscrits.type_inscription_id')
            ->where('type_inscriptions.prend_une_place', '=', true);
    }

    public function inscriptions() : HasMany{
        return $this->hasMany(Inscrit::class, 'table_id');
    }

    public function inscriptionsPrenantUnePlaces() : HasMany{
        return $this->hasMany(Inscrit::class, 'table_id')->join('type_inscriptions', 'type_inscriptions.id', '=', 'inscrits.type_inscription_id')
            ->where('type_inscriptions.prend_une_place', '=', true);
    }

    /**
     * @return int
     */
    public function nb_inscrits() : int {
        //return $this->inscrits()->wherePivot('prend_une_place', '=', true)->count();
        return $this->inscritsPrenantUnePlace()->count();
    }
    public function tags(): MorphToMany
    {
        //return $this->belongsToMany(Tag::class);
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function triggerwarnings(): MorphToMany
    {
        //return $this->belongsToMany(Tag::class);
        return $this->morphToMany(Tag::class, 'taggable')->where('type_tag_code', 'TW');
    }

    public function types(): MorphToMany
    {
        //return $this->belongsToMany(Tag::class);
        return $this->morphToMany(Tag::class, 'taggable')->wherePivot('type_tag_code', 'TYPE');
    }
}
