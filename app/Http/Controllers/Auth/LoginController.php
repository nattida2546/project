<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('employees')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('employees')->user();

            // ตรวจสอบ role แล้วส่งไปหน้า dashboard ที่ถูกต้อง
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'dean') {
                return redirect()->intended(route('dean.dashboard'));
            }

            // ถ้าเป็น role อื่นๆ ให้ logout ออกไปก่อน
            Auth::guard('employees')->logout();
        }

        return back()->withErrors(['email' => 'ข้อมูลการเข้าสู่ระบบไม่ถูกต้อง'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('employees')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
