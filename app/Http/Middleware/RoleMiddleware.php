<?php

namespace App\Http\Middleware;

use App\Autorisation;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        //suppression du "/" en début du préfixe
        $prefix = substr($request->route()->getPrefix(),1);

        if(!Autorisation::isAllowed(Auth::user(),$prefix))
        {
            $authoriz = json_decode(Auth::user()->autorisation);
            return redirect()->route(Autorisation::routing($authoriz))
                ->withErrors('Votre profil ne vous le permet pas d\'avoir accès à cette ressource. Veuillez contacter votre administrateur pour plus de détails');
        }

        return $next($request);
    }
}