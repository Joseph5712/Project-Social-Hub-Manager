<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TwitterController extends Controller
{
    public function publish(Request $request)
    {
        // Validar el contenido del tweet
        $request->validate(['content' => 'required|max:280']);

        // Obtener los tokens desde la base de datos
        $tokens = DB::table('social_tokens')
            ->where('user_id', Auth::id())
            ->where('provider', 'twitter')
            ->first();

        if ($tokens) {
            // Configurar la conexión con Twitter
            $connection = new TwitterOAuth(
                env('TWITTER_API_KEY'),
                env('TWITTER_API_SECRET'),
                $tokens->access_token,
                $tokens->token_secret
            );

            // Publicar el tweet
            $result = $connection->post('tweets', [
                'text' => $request->input('content'),
            ]);

            // Verificar el estado de la respuesta
            if ($connection->getLastHttpCode() == 201) { // Código HTTP 201: Creado
                return back()->with('success', '¡Tweet publicado con éxito!');
            } else {
                return back()->withErrors(['error' => 'No se pudo publicar el tweet.']);
            }
        } else {
            return back()->withErrors(['error' => 'No estás conectado a Twitter.']);
        }
    }
}


