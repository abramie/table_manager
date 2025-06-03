<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Compte::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            "name" =>['required', 'string'],
        ]);

        $user = Compte::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('joueur');

        $profile = $user->mainProfile()->create(["name" => $request->name, "email" => $user->email, "order" => 1 ]);
        event(new Registered($user));

        Auth::login($user);
        $request->session()->put('currentProfile', $profile);
        return redirect(RouteServiceProvider::HOME);
    }
}
