<?php

namespace App\Http\Middleware;

use App\PolicyChecker;
use Closure;
use Illuminate\Support\Facades\Auth;

class PolicyMiddleware
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
        $policy = new PolicyChecker();

        if (!$policy->moment(Auth::user()->policy))
            redirect(null,401)->route('login')->withErrors('Des restrictions sur votre profil ne vous permettent pas de continuer vos actions');

        echo
        dd(Auth::user());
        return $next($request);
    }
}
