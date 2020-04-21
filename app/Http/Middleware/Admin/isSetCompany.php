<?php

namespace App\Http\Middleware\Admin;

use App\Http\Controllers\Admin\Objects\AdminDetails;
use Closure;
use Illuminate\Support\Facades\Auth;

class isSetCompany
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
        $adminDetails = new AdminDetails(Auth::id());
        return $next($request);
    }
}
