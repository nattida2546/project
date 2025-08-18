<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsDean
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าผู้ใช้ login และมี role เป็น 'dean' หรือไม่
        if (Auth::check() && Auth::user()->role === 'dean') {
            return $next($request);
        }

        // ถ้าไม่ใช่ ให้ส่งกลับไปหน้าแรก พร้อมข้อความแจ้งเตือน
        return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้');
    }
}
