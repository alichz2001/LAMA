<?php

namespace App\Http\Middleware\Admin;

use App\Http\Controllers\LAMA\Handler\Response;
use Closure;
use Illuminate\Support\Facades\Auth;

class isLogin
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

        if (Auth::check() == false)
            return Response::Handle(false, '', 2, 40000);
        return $next($request);
    }
}
