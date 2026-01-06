<?php

namespace App\Models\types;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class TypeInscription extends Pivot
{
    //
    protected $table = 'type_inscriptions';
    protected $fillable = [
        'name',
        'code',
        'bs_class',
    ];

    static public function findCode($code){
        return TypeInscription::where('code', '=', $code)->firstOrFail();
    }
}
