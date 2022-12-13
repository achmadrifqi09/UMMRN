<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsResearcher
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role === 'Super Researcher' || auth()->user()->role == 'Researcher' ){
            return $next($request);
        }else{
            abort(403);

        }
    }
}
