<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creneau extends Model
{
    use HasFactory;
    protected $table = 'creneaux';
    protected $fillable = [
        'nom',
        'duree'
    ];

    public function evenement(): BelongsTo {
        return $this->belongsTo(Evenement::class);
    }
}
