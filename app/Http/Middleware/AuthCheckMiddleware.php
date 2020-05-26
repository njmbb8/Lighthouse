<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheckMiddleware
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
        if($request->user()->role_id < 0){
            abort(404);
        }
        else{
            return $next($request);
        }
    }
}
