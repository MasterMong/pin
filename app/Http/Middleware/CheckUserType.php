<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd($request);
        if($request->user()) {
            if (auth()->user()->role == 'pending') {
                auth()->logout();
                return \response(view('Error.verify_user'));
            }
        };
        return $next($request);
    }
}
