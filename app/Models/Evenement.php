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
        'slug',
        'max_tables',
        'nb_inscription_online_max',
        'date_debut'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_debut' => 'datetime:Y-m-d',
    ];

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
}
