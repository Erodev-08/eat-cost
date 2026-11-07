<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        // return Socialite::driver('google')->stateless()->redirect();
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // $googleUser = Socialite::driver('google')->stateless()->user();
        $googleUser = Socialite::driver('google')->user();
        
        //dd($user_google);
        $user = User::updateOrCreate(
            [
                'email' => $googleUser->getEmail(),
            ],
            [
                'google_id' => $googleUser->getId(),
                'nombre' => $googleUser->getName() ?? 'Usuario de Google',
                'email_verified_at' => now(),
            ]
        );
        Auth::login($user, remember: true);
        request()->session()->regenerate();
        return redirect()->intended('/dashboard');
    }
}
