<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class isGerirUsuarios
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
        if(    Auth::user()->funcionario->role == "Gerir Usuarios" 
            || Auth::user()->funcionario->role == "Adm Sistema" 
            || Auth::user()->funcionario->role == "Adm Secretaria" 
          )
        {
            //dd(Auth::user()->funcionario->role);
            return $next($request);
        }

        return redirect("/");
    }
}
