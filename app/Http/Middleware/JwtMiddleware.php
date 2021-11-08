<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use App\Models\Pengguna;
use Exception;


class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     // return $next($request);
    //     if ($request->age > 16)
    //     return redirect('/fail');
    //     return $next($request);
    // }
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->get('token');
        if(!$token) {
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } 
        catch(ExpiredException $e){
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        }
        catch(Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }
        $pengguna = Pengguna::find($credentials->sub);

        $request->auth = $pengguna;
        return $next($request);


    }
}
