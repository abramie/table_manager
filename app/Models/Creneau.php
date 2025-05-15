<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creneau extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'creneaux';
    protected $fillable = [
        'nom',
        'duree',
        'max_tables',
        'nb_inscription_online_max',
        'sans_table',
        'debut_creneau'
    ];

    protected static function booted(): void
    {
        static::restoring(function (Creneau $creneau) {
            // ...

            $creneau->tables()->onlyTrashed()->get()->each(function(Table $tables){
                $tables->restore();
            });
        });

        static::forceDeleting(function(Creneau $creneau){
            $creneau->tables()->onlyTrashed()->get()->each(function(Table $tables){
                $tables->forceDelete();
            });
        });
    }




    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'debut_creneau' => 'datetime:Y-m-d',
    ];
    public function evenement(): BelongsTo {
        return $this->belongsTo(Evenement::class);
    }

    public function tables() : HasMany{
        return $this->hasMany(Table::class);
    }

    public function tables_normal() : HasMany{
        return $this->hasMany(Table::class)->where('sans_table', false);
    }

    public function inscrits(){
        //return $this->through('tables')->has('inscrits');
        $list_inscrits = collect();
        foreach ($this->tables as $table){
            $list_inscrits = $list_inscrits->concat($table->inscrits);
        }
        return $list_inscrits;
    }

    public function desinscrit_user($profile){
        //return $this->through('tables')->has('inscrits');
        $values = 0;
        foreach ($this->tables as $table) {
            if($table->inscription_restrainte || $table->sans_table)
                $values += $table->inscrits()->detach($profile);
        }

        return $values;
    }


    public function delete(){
        $res=parent::delete();
        if($res==true)
        {

            $this->tables->each(function(Table $tables){
                $tables->delete();
            });

        }
    }



    public function peutInscrire(Profile|null $profile = null, Table $table){

        $ouverture_inscription =$table->creneaus->evenement->ouverture_inscription;
        $inscription_ouverte = $ouverture_inscription->isPast();
        $fermeture_inscription =$table->creneaus->evenement->fermeture_inscription;
        $inscription_fermee = $fermeture_inscription->isPast();

        if($inscription_ouverte &&
            !$inscription_fermee &&
            ($table->sans_table || $table->max_preinscription > $table->nb_inscrits()) &&
            $table->nb_joueur_max > $table->nb_inscrits()){
            return 1;
        }else{
            if($inscription_fermee){
                $status_inscription = -1;
            }
            elseif(!$inscription_ouverte){
                $status_inscription = -2;
            }elseif(!$table->sans_table &&  $table->max_preinscription <= $table->nb_inscrits() ){
                $status_inscription = -3;
            }elseif($table->nb_joueur_max <=$table->nb_inscrits() ){
                $status_inscription = -4;
            }

            return $status_inscription;
        }
    }


}
