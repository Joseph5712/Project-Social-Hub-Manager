<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Services\MastodonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\PublishController;

Route::get('/', function () {
    return redirect()-> route('login');
});


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('auth/dashboard');
    })->name('dashboard');
});

Route::get('/publish', [PublishController::class, 'index'])->middleware('auth')->name('publish');

    //Route::get('auth/linkedin', [SocialAuthController::class, 'redirectToLinkedIn'])->name('auth.linkedin');
    //Route::get('auth/linkedin/callback', [SocialAuthController::class, 'handleLinkedInCallback']);


// Ruta para redirigir al usuario a LinkedIn
Route::get('/auth/linkedin/redirect', function () {
    return Socialite::driver('linkedin')->redirect();
})->name('linkedin.redirect');

// Ruta para manejar el callback de LinkedIn
Route::get('/auth/linkedin/callback', function () {
    
    $user = Socialite::driver('linkedin')->user();
    
    dd($user);
})->name('linkedin.callback');



Route::get('/auth/mastodon/redirect', function (MastodonService $mastodon) {
    return redirect($mastodon->getAuthorizationUrl());
})->name('mastodon.redirect');

Route::get('/auth/mastodon/callback', function (MastodonService $mastodon, Illuminate\Http\Request $request) {
    $accessToken = $mastodon->getAccessToken($request->get('code'));
    $user = $mastodon->getResourceOwner($accessToken);

    // Manejar los datos del usuario
    dd($user);
})->name('mastodon.callback');




Route::get('/auth/twitter/redirect', function () {
    return Socialite::driver('twitter')->redirect();
})->name('twitter.redirect');

Route::get('/auth/twitter/callback', function () {
    $user = Socialite::driver('twitter')->user();

    // Guarda los tokens en la base de datos
    DB::table('social_tokens')->updateOrInsert(
        ['user_id' => Auth::id(), 'provider' => 'twitter'],
        [
            'access_token' => $user->token,
            'token_secret' => $user->tokenSecret,
            'updated_at' => now(),
        ]
    );

    return redirect()->route('dashboard')->with('success', 'Conectado a Twitter con éxito.');
});

Route::post('/twitter/publish', [TwitterController::class, 'publish'])
    ->middleware('auth')
    ->name('twitter.publish');


