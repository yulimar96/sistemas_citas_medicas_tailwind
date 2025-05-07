<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Verifica si la sesión ha expirado
            if (session()->has('lastActivity') && (time() - session('lastActivity') > config('session.lifetime') * 60)) {
                Auth::logout(); // Cierra la sesión
                return redirect('/login')->with('message', 'Tu sesión ha expirado.'); // Redirige al login
            }
            // Actualiza el tiempo de la última actividad
            session(['lastActivity' => time()]);
        }

        return $next($request);
    }
}
