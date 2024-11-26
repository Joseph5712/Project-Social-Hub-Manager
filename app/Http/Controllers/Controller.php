<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
abstract class Controller
{
    function getSocialTokens($provider)
{
    return DB::table('social_tokens')
        ->where('user_id', Auth::id())
        ->where('provider', $provider)
        ->first();
}

}
