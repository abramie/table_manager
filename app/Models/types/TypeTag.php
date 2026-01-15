<?php

namespace App\Models\types;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeTag extends Model
{
    //

    protected $fillable = [
        'name',
        'code',
        'bs_class',
        'order'
    ];

    static public function findCode($code){
        return TypeTag::where('code', '=', $code)->firstOrFail();
    }

    public function tags(): HasMany{
        return $this->hasMany(Tag::class, 'type_tag_code','code' );
    }
}
