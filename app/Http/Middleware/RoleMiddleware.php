<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        dd('Role middleware is triggered', Auth::user(), $roles);
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        if (!in_array($userRole, $roles)) {
            dd("Unauthorized role: $userRole");
        }

        return $next($request);
    }

}
