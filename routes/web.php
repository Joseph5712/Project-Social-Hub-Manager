<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;

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

Route::middleware('auth')->group(function () {
    Route::get('auth/linkedin', [SocialAuthController::class, 'redirectToLinkedIn'])->name('auth.linkedin');
    Route::get('auth/linkedin/callback', [SocialAuthController::class, 'handleLinkedInCallback']);
});


Route::get('/auth/pinterest', [SocialAuthController::class, 'redirectToPinterest'])->name('auth.pinterest');
Route::get('/auth/pinterest/callback', [SocialAuthController::class, 'handlePinterestCallback']);

