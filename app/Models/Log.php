<?php

namespace App\Models;

use App\Models\types\TypeLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    //
    public function loggable() :  MorphTo
    {
        return $this->morphTo();
    }

    public function type_log() : BelongsTo{
        return $this->belongsTo(TypeLog::class);
    }
    public function profile(): BelongsTo{
        return $this->belongsTo(Profile::class);
    }

    /**
     * @param Profile|null $profile : Le profil actif associé au log (par default l'utilisateur connecté)
     * @param $code : Le code du Log pour l'identifier
     * @param $detail : Information completementaire (optionnel)
     * @param $save : Si le log est sauvegarder dans la base de donnée ou non
     * @return Log
     */
    static public function log(Profile|null $profile = null,string $code = 'DEFAULT', Tag|Triggerwarning|Table|null $objet = null, string $detail = "", bool $save = true) : Log{

        $log = new Log();
        $log->details = $detail;
        if($profile){
            $log->profile()->associate($profile);
        }else{
            $log->profile()->associate(Auth::user()->currentProfile());
        }
        $log->loggable()->associate($objet);
        $log->type_log()->associate(TypeLog::findCode($code));
        //Ajouter type log
        if($save)$log->save();
        return $log;

    }
}
