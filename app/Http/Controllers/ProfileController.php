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


    public function update_role(User $user, FormUpdateRoleRequest $request){
        if(Auth::user()->currentUser->hasPermissionTo('manage_roles') || $user == Auth::user()->currentUser){
            $user->syncRoles($request->validated());
            return Redirect::route('admin.users');
        }else{
            return Redirect::route('admin.users');
        }


    }

    public function toggleMJ(){
        $user = Auth::user()->currentUser;
        if($user->hasRole('mj')){
            $user->removeRole('mj');
        }else{
            $user->assignRole('mj');;
        }
        return back();
    }
}
