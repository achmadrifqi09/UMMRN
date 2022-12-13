<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsStatus
{

    public function handle(Request $request, Closure $next)
    {
       if(auth()->user()->status == "Non Active"){
           return back();
        }
        return $next($request);
    }
}
