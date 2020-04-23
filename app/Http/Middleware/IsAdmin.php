<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (session('username')=="admin") {
            return $next($request);
        } else {
            return redirect()->back()->with('alert', 'Anda bukan admin');
        }
    }
}
