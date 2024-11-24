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
        //$this->storeSocialData($linkedinUser, 'linkedin');
        dd($linkedinUser);
        
    }

    public function redirectToMastodon(){
        return Socialite::driver('mastodon')->redirect();
    }

    public function handleMastodonCallback(){
        $mastodonUser = Socialite::driver('mastodon')->user();
        dd($mastodonUser);
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