<?php

namespace App\Models\types;

use Illuminate\Database\Eloquent\Model;

class TypeTag extends Model
{
    //

    protected $fillable = [
        'name',
        'code',
        'bs_class',
    ];

    static public function findCode($code){
        return TypeTag::where('code', '=', $code)->firstOrFail();
    }
}
