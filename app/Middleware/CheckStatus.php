<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->status) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akaun anda telah dihapuskan.');
        }
        return $next($request);
    }
}