<?php

namespace App\Models;

use App\Models\types\TypeInscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscrit extends Model
{
    //


    public function type_inscription() : BelongsTo{
        return $this->belongsTo(TypeInscription::class);
    }
}
