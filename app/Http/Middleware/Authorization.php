<?php

namespace App\Http\Middleware;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authorization
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token') ?? $request->query('token');
        if (!$token) {
            return new Response('Token required!', 401);
        }

        $user = Pengguna::where('token', $token)->first();
        if (!$user) {
            return new Response('Token not valid!', 401);
        }

        $request->user = $user;
        return $next($request);
    }
}
