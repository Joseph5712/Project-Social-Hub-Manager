<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    // Verificar si el usuario está autenticado
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirigir al login si el usuario no está autenticado
    }

    // Verificar que 2FA ha sido completado
    if (!session('2fa_verified')) {
        return redirect('/2fa');  // Redirigir al formulario de verificación de 2FA
    }

    // Si todo está bien, mostrar el Dashboard
    return view('auth.dashboard');
}
}
