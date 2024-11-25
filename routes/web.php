<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\PublishController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    // Publicar entradas
    Route::get('/publish', [PublishController::class, 'index'])->name('publish');
    Route::post('/twitter/publish', [TwitterController::class, 'publish'])->name('twitter.publish');
});

/*
|--------------------------------------------------------------------------
| Rutas para LinkedIn
|--------------------------------------------------------------------------
*/

Route::get('/auth/linkedin/redirect', function () {
    return Socialite::driver('linkedin')->redirect();
})->name('linkedin.redirect');

Route::get('/auth/linkedin/callback', function () {
    $user = Socialite::driver('linkedin')->user();
    dd($user); // Depuración: Muestra los datos del usuario autenticado
})->name('linkedin.callback');

/*
|--------------------------------------------------------------------------
| Rutas para Twitter
|--------------------------------------------------------------------------
*/

// Redirigir al usuario para iniciar sesión con Twitter
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
