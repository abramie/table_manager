<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom'
    ];

    public function tables(): MorphToMany
    {
        //return $this->belongsToMany(Table::class);
        return $this->morphedByMany(Table::class, 'taggable');
    }
}
