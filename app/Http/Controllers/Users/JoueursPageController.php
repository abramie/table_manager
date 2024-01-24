<?php

namespace App\Http\Controllers\Users;

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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoueursPageController extends Controller
{
    //
    public function show() {

        $user = Auth::user();

        $tables = $user->inscriptions;
        return view('profile.joueur', [
            'tables' => $tables,
        ]);
    }

}
