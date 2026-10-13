<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Si ya existe una sesión 'locale', úsala
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Detecta el idioma preferido del navegador (ej: 'es', 'en')
            // $locale = $request->getPreferredLanguage(['es', 'en', 'fr']); // idiomas soportados

            // O usa un valor por defecto fijo
            $locale = 'es';

            // Guarda en sesión
            Session::put('locale', $locale);
        }

        // Aplica el idioma a la aplicación
        App::setLocale($locale);

        return $next($request);
    }
}
