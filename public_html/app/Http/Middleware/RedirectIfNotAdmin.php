<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin {

    public function handle($request, Closure $next)
    {
        //print_r(Auth::user());exit();
        if (Auth::user()->role != 'Admin'){
            // return whatever you want here, I'd redirect to homepage for example or some 401 page
            return response()->json(['message'=>'Forbbiden.'], 403);
        }

        return $next($request);
    }

}