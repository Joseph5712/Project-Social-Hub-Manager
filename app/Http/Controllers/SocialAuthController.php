<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialAccount;

use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{

    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback()
    {
        $linkedinUser = Socialite::driver('linkedin')->user();
        $this->storeSocialData($linkedinUser, 'linkedin');
        return redirect('/dashboard');
    }


    public function redirectToPinterest()
    {
        return Socialite::driver('pinterest')->redirect();
    }


    public function handlePinterestCallback()
{
    try {
        $pinterestUser = Socialite::driver('pinterest')->user();
        $this->storeSocialData($pinterestUser, 'pinterest');
        return redirect('/dashboard');
    } catch (\Exception $e) {
        return redirect('/login')->withErrors('Error autenticando con Pinterest');
    }
}



    private function storeSocialData($socialUser, $provider)
    {
        // Busca el registro de la cuenta social o lo crea si no existe
        SocialAccount::updateOrCreate(
        [
            'user_id' => Auth::id(), // Relación con el usuario autenticado
            'provider' => $provider, // Proveedor (linkedin, facebook, etc.)
        ],
        [
            'provider_id' => $socialUser->getId(), // ID del usuario en la red social
            'token' => $socialUser->token,        // Token de acceso
            'refresh_token' => $socialUser->refreshToken ?? null, // Token de actualización, si está disponible
        ]
    );
    }
}