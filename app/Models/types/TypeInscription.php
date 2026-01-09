<?php

namespace App\Models\types;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class TypeInscription extends Pivot
{

    /**
 *
* TypeInscription::create(['name' => 'Inscrit', 'code' => 'INS', 'bs_class' => '', 'prend_une_place' => true]);
     * TypeInscription::create(['name' => 'Pré-Inscrit', 'code' => 'PRE-INS', 'bs_class' => 'fst-italic', 'prend_une_place' => true]);
     * TypeInscription::create(['name' => 'Désinscrit', 'code' => 'DES-INS', 'bs_class' => 'text-decoration-line-through', 'prend_une_place' => false]);
     */
    //
    protected $table = 'type_inscriptions';
    protected $fillable = [
        'name',
        'code',
        'bs_class',
        'prend_une_place',
    ];

    static public function findCode($code){
        return TypeInscription::where('code', '=', $code)->firstOrFail();
    }
}
