<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        /**
         * @var \App\Models\User $user
         */
        if (Auth::check() && method_exists(Auth::user(), 'update')) {
            Auth::user()->update(['last_activity' => now()]);
        }

        return $next($request);
    }
}
