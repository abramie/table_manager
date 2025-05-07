<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormUpdateRoleRequest;
use App\Http\Requests\ProfilRequest;
use App\Models\Compte;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{


    public function show(Compte $compte){

        $profile = $compte->currentProfile;
        return view('compte.profile.index', ['compte' =>$compte, 'profile'=> $profile ,'profiles' => $compte->profiles]);
    }


    public function update(ProfilRequest $request, Compte $compte, Profile $profile){


        if($request->validated('name') != $profile->name && $profile->name == Session::get('currentProfile')){
            $request->session()->put('currentProfile', $request->validated('name'));
        }
        $profile->update($request->validated());
        return redirect()->route('profile.show', ['compte' => $compte]);
    }

    public function store(ProfilRequest $request, Compte $compte){

        $compte->profiles()->create($request->validated());
        return redirect()->route('profile.show', ['compte' => $compte]);
    }


}
