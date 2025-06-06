<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // The Profile model requires this trait


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'order'
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Les tables où l'utilisateur est MJ
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tables() :HasMany{
        return $this->hasMany(Table::class,'mj');
    }

    public function inscriptions() : BelongsToMany{
        return $this->BelongsToMany(Table::class, 'inscrits');
    }

    public function tokensPassword(){
        return $this->hasMany(TokenResetPassword::class);
    }

    public function compte() :BelongsTo{

        return $this->belongsTo(Compte::class);
    }


}
