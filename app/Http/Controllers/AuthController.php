<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:m_user,username',
            'password' => 'required',
            'nama' => 'required',
            'level_id' => 'required'
        ]);

        UserModel::create([
            'username'   => $validated['username'],
            'password'   => Hash::make($validated['password']),
            'nama'       => $validated['nama'],
            'level_id'   => $validated['level_id'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/login');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Login berhasil'], 200);
            }

            return redirect('/dashboard');
        }

        // Jika login gagal
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Username atau password salah.'
            ], 401);
        }

        return redirect('login')->withErrors([
            'username' => 'Username atau password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
