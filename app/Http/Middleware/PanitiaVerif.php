<?php

namespace App\Http\Middleware;

use Closure;
use App\Panitia;

class PanitiaVerif
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
        $panitia = Panitia::where('nama_panitia',session('nama_panitia'))->first();
        if ($panitia->status==1) {
            return $next($request);
        } else {
            return redirect()->back()->with('alert', 'Anda belum diverifikasi oleh admin');
        }
    }
}
