<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormTableRequest;
use App\Http\Requests\InscriptionTableRequest;
use App\Models\Compte;
use App\Models\Creneau;
use App\Models\Description;
use App\Models\Evenement;
use App\Models\Settings;
use App\Models\Table;
use App\Models\Tag;
use App\Models\Triggerwarning;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MJPageController extends Controller
{
    //
    public function show(Compte $compte, Profile|null $profile = null) {

        if($profile == null) {
            $profile = Auth::user()->currentProfile;
        }


        $tables = $profile->tables;
        $settings = Settings::whereIn('name',  ['nom_trigger'])->get();
        return view('compte.profile.mj', [
            'tables' => $tables,
            'profile' => $profile,
            'compte' => $compte,
            'settings' => $settings,
        ]);
    }

}
