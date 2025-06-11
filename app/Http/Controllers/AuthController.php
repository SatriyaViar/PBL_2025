<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewLogin()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }
        return redirect('/dashboard');
    }

    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if ($request->ajax() || $request->wantsJson()) {
        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url('/dashboard')
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Login Gagal'
        ]);
    }

    // Login biasa (non-AJAX)
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ])->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'Logged out successfully!');
    }
}