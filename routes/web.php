<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\MastodonController;
use App\Http\Controllers\SocialAccountController;
use App\Http\Middleware\Ensure2FAIsVerified;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Middleware;

/*
|----------------------------------------------------------------------
| Rutas de autenticación
|----------------------------------------------------------------------
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

// Rutas protegidas (middleware auth y 2fa)

Route::get('/2fa', [AuthController::class, 'enable2FA'])->name('enablefa');
Route::post('/verify-2fa', [AuthController::class, 'verify2FA'])->name('verify2fa');

Route::middleware(['auth', Ensure2FAIsVerified::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*
|----------------------------------------------------------------------
| Rutas de redes sociales (Twitter y Mastodon)
|----------------------------------------------------------------------
*/

// Twitter: Redirigir a la autenticación
Route::get('/auth/twitter/redirect', function () {
    DB::table('social_tokens')->where('user_id', Auth::id())->where('provider', 'twitter')->delete();
    
    // Redirigir a Twitter para reautenticarse
    $url = Socialite::driver('twitter')->redirect()->getTargetUrl();
    $url .= '&auth_type=reauthenticate';  // Añadir el parámetro para forzar reautenticación
    return redirect($url);
})->name('twitter.redirect');

// Twitter: Callback de autenticación
Route::get('/auth/twitter/callback', function () {
    $user = Socialite::driver('twitter')->user();

    // Guardar los tokens en la base de datos
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

// Mastodon: Redirigir a la autenticación
Route::get('/auth/mastodon/redirect', [MastodonController::class, 'redirect'])->name('mastodon.redirect');

// Mastodon: Callback de autenticación
Route::get('/auth/mastodon/callback', [MastodonController::class, 'callback'])->name('mastodon.callback');

// Mastodon: Publicar contenido
Route::post('/mastodon/publish', [MastodonController::class, 'publish'])->name('mastodon.publish');

// Twitter: Publicar contenido
Route::post('/twitter/publish', [TwitterController::class, 'publish'])
    ->middleware('auth')
    ->name('twitter.publish');

/*
|----------------------------------------------------------------------
| Rutas para publicación en redes sociales
|----------------------------------------------------------------------
*/

// Publicar en Twitter
Route::get('/publish/twitter', function () {
    return view('publish.twitter');
})->middleware('auth')->name('publish.twitter');

// Publicar en Mastodon
Route::get('/publish/mastodon', function () {
    return view('publish.mastodon');
})->middleware('auth')->name('publish.mastodon');

/*
|----------------------------------------------------------------------
| Rutas de gestión de cuentas sociales
|----------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Ruta para ver las cuentas conectadas
    Route::get('/social-accounts', [SocialAccountController::class, 'index'])->name('social.index');

    // Ruta para desconectar una cuenta
    Route::delete('/social-accounts/{id}/disconnect', [SocialAccountController::class, 'disconnect'])->name('social.disconnect');
});

/*
|----------------------------------------------------------------------
| Rutas de publicación programada
|----------------------------------------------------------------------
*/

Route::get('/schedule/calendar', function () {
    return view('schedule.select_publication_type');
});

Route::get('/publish/publications/type-selection', function () {
    return view('schedule.select_publication_type');
})->middleware('auth')->name('schedule.select_publication_type');


/*use App\Http\Controllers\PublicationScheduleController;

Route::middleware('auth')->group(function () {
    Route::resource('schedules', PublicationScheduleController::class);
});
*/