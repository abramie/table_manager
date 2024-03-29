<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evenement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nom_evenement',
        'slug',
        'max_tables',
        'nb_inscription_online_max',
        'date_debut',
        'ouverture_inscription',
        'affichage_evenement',
        'archivage',
        'fermeture_inscription',
        'description',
    ];


    /**
     * The attributes that should be cast.
     * Sans ça, les dates sont cast en string ce qui est pas tip top pour faire quoi que ce soit
     * @var array
     */
    protected $casts = [
        'date_debut' => 'datetime:Y-m-d',
        'ouverture_inscription' => 'datetime:Y-m-d',
        'fermeture_inscription' => 'datetime:Y-m-d',
        'affichage_evenement' => 'datetime:Y-m-d',
        'archivage' => 'datetime:Y-m-d',
    ];

    protected static function booted(): void
    {

        static::restoring(function (Evenement $evenement) {
            // ...
            $evenement->creneaus()->onlyTrashed()->get()->each(function(Creneau $creneau){

                $creneau->restore();
            });
        });

        static::forceDeleting(function (Evenement $evenement) {
            // ...
            $relations=$evenement->image; // here get the relation data
            if($relations){

                $relations->forceDelete();// delete Here
            }
            $evenement->creneaus()->onlyTrashed()->get()->each(function(Creneau $creneau){

                $creneau->forceDelete();
            });
        });
    }

    public function showDate(){
        $date = $this->date_debut;
        $date_string = "Le ".$date->dayName. " ". $date->day. " " .$date->monthName;
        if($date->year != now()->year)
            $date_string =  $date_string . " " . $date->year;

        return $date_string;
    }
    public function creneaus() : HasMany{
        return $this->hasMany(Creneau::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function delete(){
        $res=parent::delete();
        if($res==true)
        {

             $this->creneaus->each(function(Creneau $creneau){
                 $creneau->delete();
             });

        }
    }






}
