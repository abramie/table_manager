<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUpdateRoleRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Compte;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CompteController extends Controller
{
    //
    /**
     * Display the user's compte form.
     */
    public function edit(Request $request, Compte $compte): View
    {
        return view('compte.edit', [
            "compte" => $compte,
        ]);
    }

    /**
     * Update the user's compte information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('compte.edit')->with('status', 'compte-updated');
    }

    /**
     * Delete the Compte.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $compte = $request->compte();

        Auth::logout();

        $compte->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function update_role(Compte $compte, FormUpdateRoleRequest $request){
        if(Auth::user()->hasPermissionTo('manage_roles') || $compte == Auth::user()){
            $compte->syncRoles($request->validated());
            return Redirect::route('admin.users');
        }else{
            return Redirect::route('admin.users');
        }


    }

    public function toggleMJ(){
        $compte = Auth::user();
        if($compte->hasRole('mj')){
            $compte->removeRole('mj');
        }else{
            $compte->assignRole('mj');;
        }
        return back();
    }
}
