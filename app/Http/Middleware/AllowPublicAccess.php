<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowPublicAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $allowedDir = ['home'];
        // if(!$request->session()->has('auth') && !in_array($request->route()->getName(), $allowedDir)){
        //     return redirect()->guest('/login');
        // }

        return $next($request);
    }
}
