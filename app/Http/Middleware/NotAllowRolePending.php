<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotAllowRolePending
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
//                auth()->logout();
                return \response(view('Error.ErrorMessage', [
                    'message' => "ผู้ใช้งาน " . auth()->user()->email . " ยังไม่ได้รับอนุมัติให้ใช้งาน",
                    'des' => 'ระบบได้บันทึกบัญชีผู้ใช้งานแล้ว ท่านจะสมารถเข้าสู่ระบบได้เมื่อรับการยืนยันตัวตนจากผู้ดูแลระบบ',
                    'bt_label' => 'ลองอีกครั้ง',
                    'bt_link' => route('filament.app.pages.home')
                ]));
            }
        };
        return $next($request);
    }
}
