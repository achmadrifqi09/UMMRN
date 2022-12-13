<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuperResearcher
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role !== 'Super Researcher'){
           return redirect('/error-page');
        }
        return $next($request);
    }
}
