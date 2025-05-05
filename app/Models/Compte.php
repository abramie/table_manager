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
    // The User model requires this trait
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


    public function users() : HasMany{
        return $this->hasMany(User::class);
    }

    public function mainUser() : HasOne{
        return $this->hasOne(User::class)->ofMany('order', 'min');
    }

    public function currentUser() : HasOne{
        $currentUser = \Session::get('currentUser',$this->mainUser()->select('name')->first()->name);

        return $this->users()->one()->ofMany( [],function (Builder $query) use($currentUser){
            $query->where('name', '=', $currentUser);
        });
    }
}

