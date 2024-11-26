<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SocialAccountController extends Controller
{
    public function index()
    {
        // Obtener las cuentas conectadas del usuario autenticado
        $connectedAccounts = DB::table('social_tokens')
            ->where('user_id', Auth::id())
            ->get();

        return view('auth.social_accounts', compact('connectedAccounts'));
    }

    public function disconnect($id)
    {
        // Eliminar la cuenta conectada
        DB::table('social_tokens')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('social.index')->with('success', 'Cuenta desconectada con éxito.');
    }
}
