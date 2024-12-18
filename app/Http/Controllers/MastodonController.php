<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MastodonController extends Controller
{
    // Redirige al usuario a la autorización de Mastodon
    public function redirect()
{
    DB::table('social_tokens')
        ->where('user_id', Auth::id())
        ->where('provider', 'mastodon')
        ->delete();
    // Redirigir al flujo de autorización
    $url = env('MASTODON_INSTANCE_URL') . '/oauth/authorize?' . http_build_query([
        'client_id' => env('MASTODON_CLIENT_ID'),
        'redirect_uri' => env('MASTODON_REDIRECT_URI'),
        'response_type' => 'code',
        'scope' => 'read write follow',
        'force_login' => 'true', // Si tu instancia de Mastodon soporta este parámetro
    ]);

    return redirect($url);
}

    // Maneja el callback y obtiene el token de acceso
    public function callback(Request $request)
    {
        // Intercambiar el código de autorización por un token de acceso
        $response = Http::asForm()->post(env('MASTODON_INSTANCE_URL') . '/oauth/token', [
            'client_id' => env('MASTODON_CLIENT_ID'),
            'client_secret' => env('MASTODON_CLIENT_SECRET'),
            'redirect_uri' => env('MASTODON_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
            'code' => $request->query('code'),
        ]);

        $data = $response->json();

        if ($response->ok() && isset($data['access_token'])) {
            // Guardar el token en la base de datos
            DB::table('social_tokens')->updateOrInsert(
                ['user_id' => Auth::id(), 'provider' => 'mastodon'],
                [
                    'access_token' => $data['access_token'],
                    'token_secret' => null, // Mastodon no utiliza token secreto
                    'updated_at' => now(),
                ]
            );

            return redirect()->route('dashboard')->with('success', 'Conectado a Mastodon con éxito.');
        }

        return redirect()->route('dashboard')->withErrors(['error' => 'Error al conectar con Mastodon.']);
    }

    // Publica en Mastodon
    public function publish(Request $request)
    {
        // Validar el contenido del estado
        $request->validate(['content' => 'required|max:500']); // Mastodon permite hasta 500 caracteres

        // Obtener los tokens desde la base de datos
        $tokens = DB::table('social_tokens')
            ->where('user_id', Auth::id())
            ->where('provider', 'mastodon')
            ->first();

        if ($tokens) {
            // Publicar el estado en Mastodon
            $response = Http::withToken($tokens->access_token)->post(
                env('MASTODON_INSTANCE_URL') . '/api/v1/statuses',
                ['status' => $request->input('content')]
            );

            if ($response->ok()) {
                return back()->with('success', '¡Publicado en Mastodon con éxito!');
            } else {
                return back()->withErrors(['error' => 'No se pudo publicar en Mastodon.']);
            }
        } else {
            return back()->withErrors(['error' => 'No estás conectado a Mastodon.']);
        }
    }
}
