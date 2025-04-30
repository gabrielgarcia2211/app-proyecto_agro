<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol)
    {

        if(auth()->user()->rol==1){
            if($rol == 2 || $rol == 3){
                return back();
            }
        }

        if(auth()->user()->rol==2){
            if($rol == 1 || $rol == 3){
                return back();
            }
        }

        if(auth()->user()->rol==3){
            if($rol == 1 || $rol == 2){
                return back();
            }
        }


        return $next($request);
    }
}
