<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Authenticate
{
    /*protected function redirectTo($request)
    {
        return route('desktop');
    }*/

    public function handle($request, Closure $next)
    {
        if(Auth::user()){
            return $next($request);
        }
        return redirect('login')->with('error', "No logged user.");
    }
}
