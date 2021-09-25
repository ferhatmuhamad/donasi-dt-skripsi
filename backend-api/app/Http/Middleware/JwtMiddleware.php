<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                // return response()->json(['status' => 'Token is Invalid']);
                return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'Token is invalid', null);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                // return response()->json(['status' => 'Token is Expired']);
                return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'Token is expired', null);
            } else {
                // return response()->json(['status' => 'Authorization Token not found']);
                return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'Authorization token not found!', null);
            }
        }
        return $next($request);
        // return response()->json(['status' => 'User not authenticated']);
        // return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'User not authenticated', null);
    }
}
