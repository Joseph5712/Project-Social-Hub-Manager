<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function publish(Request $request)
    {
        // Valida el contenido del tweet
        $request->validate(['content' => 'required|max:280']);

        // Configura la conexión con Twitter
        $connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
        $connection->setApiVersion('2');

        // Publica el tweet
        $result = $connection->post('tweets', [
            'text' => $request->input('content'),
        ]);

        // Verifica el estado de la respuesta
        $httpCode = $connection->getLastHttpCode();

        if ($httpCode == 201) { // Código HTTP 201 significa "Creado" (Tweet publicado)
            return back()->with('success', '¡Tweet publicado con éxito!');
        } else {
            $error = $connection->getLastBody(); // Obtén el mensaje de error si existe
            return back()->withErrors(['error' => 'No se pudo publicar el tweet. Inténtalo de nuevo.']);
        }
    }
}


