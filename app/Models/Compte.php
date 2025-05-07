<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Compte extends Authenticatable
{
    use HasApiTokens, Notifiable;
    // The Profile model requires this trait
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'updated_at',
        'created_at',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function profiles() : HasMany{
        return $this->hasMany(Profile::class);
    }

    public function mainProfile() : HasOne{
        return $this->hasOne(Profile::class)->ofMany('order', 'min');
    }

    public function currentProfile() : HasOne{
        $currentProfile = \Session::get('currentProfile',$this->mainProfile()->select('name')->first()->name);
        $relation = $this->profiles()->one()->ofMany( [],function (Builder $query) use($currentProfile){
            $query->where('name', '=', $currentProfile);
        });

        return $relation->exists() ? $relation : $this->mainProfile();
    }
}

