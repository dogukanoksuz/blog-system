<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, ?string $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/admin');
        }

        return $next($request);
    }
}
