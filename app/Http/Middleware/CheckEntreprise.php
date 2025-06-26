<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEntreprise
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $document = $request->route('document');
    
        if ($document && $document->entreprise_id !== auth()->user()->entreprise_id) {
            abort(403, 'Accès non autorisé.');
        }
    
        return $next($request);
    }
}
