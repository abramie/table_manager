<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUpdateRoleRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function update_role(User $user, FormUpdateRoleRequest $request){
        if(Auth::user()->can('manage_roles') || $user == Auth::user()){
            $user->syncRoles($request->validated());
            return Redirect::route('admin.users');
        }else{
            return Redirect::route('admin.users');
        }
        dd("test");


    }

    public function toggleMJ(){
        $user = Auth::user();
        if($user->hasRole('mj')){
            $user->removeRole('mj');
        }else{
            $user->assignRole('mj');;
        }
        return back();
    }
}
