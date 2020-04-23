<?php

namespace App\Http\Middleware;

use Closure;


class IsPanitia
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
        if (session('id_user')==session('id_member')) {
            return $next($request);
        } else {
            return redirect()->back()->with('alert', 'Anda tidak memiliki hah untuk akun event organizer ini');
        }
    }
}
