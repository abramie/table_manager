<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormTableRequest;
use App\Http\Requests\InscriptionTableRequest;
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

class JoueursPageController extends Controller
{
    //
    public function show() {

        $profile = Auth::user()->currentProfile;

        $tables = $profile->inscriptions;
        return view('compte.profile.joueur', [
            'tables' => $tables,
        ]);
    }

}
