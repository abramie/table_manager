<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenResetPassword extends Model
{

    protected $table = 'password_resets';
    public function user(){
        return $this->belongsTo(Profile::class);
    }
}
