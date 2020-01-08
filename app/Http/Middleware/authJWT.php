<?php

namespace App\Http\Middleware;
use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
class authJWT
{
    public function handle($request, Closure $next)
    {
        if(JWTAuth::attempt([$_SERVER['HTTP_AUTHORIZATION']])){
            return $next($request);
        } else {
            return response()->json(['error'=>'Token is Expired']);
        }
//        try {
//            $user = JWTAuth::toUser($request->input('token'));
//        } catch (Exception $e) {
//            if ($e instanceof TokenInvalidException){
//                return response()->json(['error'=>'Token is Invalid']);
//            }else if ($e instanceof TokenExpiredException){
//                return response()->json(['error'=>'Token is Expired']);
//            }else{
//                return response()->json(['error'=>'Something is wrong']);
//            }
//        }
    }
}
