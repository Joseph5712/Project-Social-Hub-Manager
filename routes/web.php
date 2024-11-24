<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use Laravel\Socialite\Facades\Socialite;

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

    //Route::get('auth/linkedin', [SocialAuthController::class, 'redirectToLinkedIn'])->name('auth.linkedin');
    //Route::get('auth/linkedin/callback', [SocialAuthController::class, 'handleLinkedInCallback']);


// Ruta para redirigir al usuario a LinkedIn
Route::get('/auth/linkedin/redirect', function () {
    return Socialite::driver('linkedin')->redirect();
})->name('linkedin.redirect');

// Ruta para manejar el callback de LinkedIn
Route::get('/auth/linkedin/callback', function () {
    $user = Socialite::driver('linkedin')->user();
    // Aquí puedes manejar los datos del usuario, como almacenarlos en la base de datos o iniciar sesión
    dd($user);
})->name('linkedin.callback');







