<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\PublishController;
use Laravel\Socialite\Facades\Socialite;
use App\Services\MastodonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MastodonController;
use App\Http\Controllers\SocialAccountController;

/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Registro y login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (middleware auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('auth/dashboard');
    })->name('dashboard');
});

//Route::get('/publish', [PublishController::class, 'index'])->middleware('auth')->name('publish');

    //Route::get('auth/linkedin', [SocialAuthController::class, 'redirectToLinkedIn'])->name('auth.linkedin');
    //Route::get('auth/linkedin/callback', [SocialAuthController::class, 'handleLinkedInCallback']);


/*
Route::get('/auth/mastodon/redirect', function (MastodonService $mastodon) {
    return redirect($mastodon->getAuthorizationUrl());
})->name('mastodon.redirect');

Route::get('/auth/mastodon/callback', function (MastodonService $mastodon, Illuminate\Http\Request $request) {
    $accessToken = $mastodon->getAccessToken($request->get('code'));
    $user = $mastodon->getResourceOwner($accessToken);

    // Manejar los datos del usuario
    dd($user);
})->name('mastodon.callback');
*/




// Redirigir al usuario a la autorización de Mastodon
Route::get('/auth/mastodon/redirect', [MastodonController::class, 'redirect'])->name('mastodon.redirect');
Route::get('/auth/mastodon/callback', [MastodonController::class, 'callback'])->name('mastodon.callback');
Route::post('/mastodon/publish', [MastodonController::class, 'publish'])->name('mastodon.publish');





Route::get('/auth/twitter/redirect', function () {
    return Socialite::driver('twitter')->redirect();
})->name('twitter.redirect');

// Callback después de la autenticación con Twitter
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




    Route::get('/publish/select', function () {
        return view('publish.select');
    })->middleware('auth')->name('publish.select');

    // Publicar en Twitter
Route::get('/publish/twitter', function () {
    return view('publish.twitter');
})->middleware('auth')->name('publish.twitter');

// Publicar en Mastodon
Route::get('/publish/mastodon', function () {
    return view('publish.mastodon');
})->middleware('auth')->name('publish.mastodon');


Route::middleware('auth')->group(function () {
    // Ruta para ver las cuentas conectadas
    Route::get('/social-accounts', [SocialAccountController::class, 'index'])->name('social.index');

    // Ruta para desconectar una cuenta
    Route::delete('/social-accounts/{id}/disconnect', [SocialAccountController::class, 'disconnect'])->name('social.disconnect');
});