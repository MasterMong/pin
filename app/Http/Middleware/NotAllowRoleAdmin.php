<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotAllowRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()) {
            if (auth()->user()->role == 'admin') {
                auth()->logout();
                return \response(view('Error.ErrorMessage', ['message' => "ไม่อนุญาตให้ Admin เข้าถึหน้านี้"]));
            }
        };
        return $next($request);
    }
}
