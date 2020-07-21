<?php

namespace App\Http\Middleware;

use Closure;

class IsPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && ! $request->user()->subscribed('default')) {
            return redirect('billing');
        }

        return $next($request);
    }
}
