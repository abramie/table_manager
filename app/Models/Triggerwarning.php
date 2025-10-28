<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

//Remplacer en content warning peut etre ?
class Triggerwarning extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom'
    ];



    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class);
    }
}
