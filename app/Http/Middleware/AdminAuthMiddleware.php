<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = $request->user();
        $role = $user->roles()->where('slug', 'admin')->wherePivot('expires_at', null)->first();

        if (!$role) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
