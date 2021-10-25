<?php

namespace App\Http\Middleware;

use Closure;

class UmurMiddleware
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
        // return $next($request);
        if ($request->umur < 18) {
            return "Umur anda masih bocil, blm bisa masuk ya (18+)";
        }
                return $next($request);
    }
}
