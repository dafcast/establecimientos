<?php

namespace App\Http\Middleware;

use Closure;

class RevisarEstablecimiento
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
        if( auth()->user()->establecimiento){
            // return redirect()->action('EstablecimientoController@edit', ['establecimiento' => auth()->user()->establecimiento]);
            return redirect()->route('establecimientos.edit', ['establecimiento' => auth()->user()->establecimiento]);
        }
        return $next($request);
    }
}
