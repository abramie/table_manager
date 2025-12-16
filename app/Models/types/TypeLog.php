<?php

namespace App\Models\types;

use Illuminate\Database\Eloquent\Model;

class TypeLog extends Model
{
    //
    protected $fillable = [
        'name',
        'code',

    ];

    static public function findCode($code){
        return TypeLog::where('code', '=', $code)->firstOrFail();
    }
}
