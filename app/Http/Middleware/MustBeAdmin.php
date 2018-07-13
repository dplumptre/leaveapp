<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdmin
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

        if ($user && $user->role == "admin"  || $user->loan_roles_id > 0) {
           
            return $next($request);
        }

        return redirect('access_denied');
    }
}
