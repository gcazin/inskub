<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenVerifier
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->access_token) {
            return $next($request);
        }

        return response()->json(['message' => 'Aucun jeton de sécurité renseigné.'], 403);
    }
}
