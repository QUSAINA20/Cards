<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
    {

        if (Auth::check() && Auth::user()->hasPermissionTo($permission)) {
            return $next($request);
        }

        return response()->json(['error' => 'The user does not have permission'], 403);
    }
}
