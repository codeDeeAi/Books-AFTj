<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         // Check If user is authenticated
         if(!Auth::check()){
            return response()->json([
                'msg' => 'You are not allowed to access this route... ' , 
                'url' => $request->path()
            ], 403);
        }
        return $next($request);
    }
}
