<?php

namespace App\Http\Middleware;

use Closure;

class MustBeSupervisor
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
        $user = $request->user();

        if (($user && $user->role == "admin") || ($user && $user->role == "supervisor")) {
           
            return $next($request);
        }

        return redirect('access_denied');
    }
}
