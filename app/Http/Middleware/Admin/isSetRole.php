<?php

namespace App\Http\Middleware\Admin;

use Closure;

class isSetRole
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
        if (!session()->has('currentRoleId') || session()->get('currentRoleId') == 0)
            return Response::Handle(false, '', 1, 40031);
        return $next($request);
    }
}
