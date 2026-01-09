<?php

namespace App\Models;

use App\Models\types\TypeInscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscrit extends Model
{
    //

    protected $table = 'inscrits';
    public function type_inscription() : BelongsTo{
        return $this->belongsTo(TypeInscription::class);
    }

    public function profile() : BelongsTo{
        return $this->belongsTo(Profile::class);
    }

    public function table() : BelongsTo{
        return $this->belongsTo(Table::class);
    }
}
